#!/usr/bin/env python3
"""Extrait articles/catégories/menus/modules du dump mysqldump Joomla."""
import re
import json
from pathlib import Path

SQL_PATH = Path("_backup_local/joomla-original/coinxpert.sql")
OUT = Path("content")
PREFIX = "m0v7s_"

src = SQL_PATH.read_text(encoding="utf-8", errors="replace")


def find_inserts(table):
    """Itère sur (cols, values_block) pour chaque INSERT visant `table`."""
    needle = f"INSERT INTO `{table}` ("
    pos = 0
    while True:
        i = src.find(needle, pos)
        if i < 0:
            break
        close = src.find(")", i)
        cols = [c.strip(" `") for c in src[i + len(needle):close].split(",")]
        vstart = src.find("VALUES", close)
        body_start = vstart + len("VALUES")
        end = find_statement_end(body_start)
        yield cols, src[body_start:end]
        pos = end + 1


def find_statement_end(start):
    """Retourne l'index du `;` final, en sautant ceux dans les strings."""
    i = start
    in_str = False
    while i < len(src):
        c = src[i]
        if in_str:
            if c == "\\":
                i += 2
                continue
            if c == "'":
                in_str = False
        else:
            if c == "'":
                in_str = True
            elif c == ";":
                return i
        i += 1
    return len(src)


def parse_rows(block):
    """block = '(...),(...),(...);' → liste de listes."""
    rows = []
    i = 0
    n = len(block)
    while i < n:
        while i < n and block[i] in " \n\t,;":
            i += 1
        if i >= n or block[i] != "(":
            break
        i += 1  # skip (
        row = []
        cur_token = []
        in_str = False
        token_kind = "RAW"
        while i < n:
            c = block[i]
            if in_str:
                if c == "\\" and i + 1 < n:
                    nxt = block[i + 1]
                    cur_token.append(
                        {"n": "\n", "t": "\t", "r": "\r", "0": "\0"}.get(nxt, nxt)
                    )
                    i += 2
                    continue
                if c == "'":
                    in_str = False
                    i += 1
                    continue
                cur_token.append(c)
                i += 1
                continue
            if c == "'":
                in_str = True
                token_kind = "STR"
                cur_token = []
                i += 1
                continue
            if c == ",":
                row.append((token_kind, "".join(cur_token)))
                cur_token = []
                token_kind = "RAW"
                i += 1
                continue
            if c == ")":
                row.append((token_kind, "".join(cur_token)))
                i += 1
                break
            cur_token.append(c)
            token_kind = "RAW"
            i += 1
        # convert
        out = []
        for kind, v in row:
            if kind == "STR":
                out.append(v)
            else:
                vs = v.strip()
                if vs.upper() == "NULL" or vs == "":
                    out.append(None)
                else:
                    out.append(vs)
        rows.append(out)
    return rows


def fetch_table(table):
    all_rows = []
    cols_final = None
    for cols, block in find_inserts(table):
        cols_final = cols
        all_rows.extend(parse_rows(block))
    if cols_final is None:
        return []
    return [dict(zip(cols_final, r)) for r in all_rows]


# === Categories ===
cats = [c for c in fetch_table(PREFIX + "categories") if c.get("extension") == "com_content"]
print(f"Catégories com_content : {len(cats)}")

# === Articles ===
arts = fetch_table(PREFIX + "content")
print(f"Articles : {len(arts)}")
published = sum(1 for a in arts if a.get("state") == "1")
print(f"  → publiés : {published}")

# === Menus (frontend) ===
menus = [m for m in fetch_table(PREFIX + "menu") if m.get("client_id") == "0"]
print(f"Items de menu front : {len(menus)}")

# === Modules ===
mods = [m for m in fetch_table(PREFIX + "modules") if m.get("client_id") == "0"]
print(f"Modules front : {len(mods)}")

# === Sauvegarde ===
OUT.mkdir(exist_ok=True)
(OUT / "articles").mkdir(exist_ok=True)

(OUT / "categories.json").write_text(
    json.dumps(cats, ensure_ascii=False, indent=2), encoding="utf-8"
)
(OUT / "menus.json").write_text(
    json.dumps(menus, ensure_ascii=False, indent=2), encoding="utf-8"
)
(OUT / "modules.json").write_text(
    json.dumps(mods, ensure_ascii=False, indent=2), encoding="utf-8"
)

index = []
for a in arts:
    aid = a.get("id") or "0"
    alias = a.get("alias") or "untitled"
    title = a.get("title") or ""
    fname = re.sub(r"[^a-zA-Z0-9._-]", "-", f"{aid}-{alias}")[:120] + ".md"
    if a.get("state") != "1":
        fname = "_unpublished_" + fname
    md = f"""---
id: {aid}
title: {json.dumps(title, ensure_ascii=False)}
alias: {alias}
catid: {a.get("catid")}
state: {a.get("state")}
created: {a.get("created")}
metadesc: {json.dumps(a.get("metadesc") or "", ensure_ascii=False)}
---

# {title}

{a.get("introtext") or ""}

{a.get("fulltext") or ""}
"""
    (OUT / "articles" / fname).write_text(md, encoding="utf-8")
    index.append({
        "id": aid, "title": title, "alias": alias,
        "catid": a.get("catid"), "state": a.get("state"),
        "created": a.get("created"), "file": f"articles/{fname}",
    })

(OUT / "articles-index.json").write_text(
    json.dumps(index, ensure_ascii=False, indent=2), encoding="utf-8"
)
print("OK")
