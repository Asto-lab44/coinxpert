#!/usr/bin/env python3
"""Compose les pages statiques à partir de fragments _layout/ + _pages/.

Sortie : fichiers HTML autonomes à la racine de site/.
"""
import re
from pathlib import Path

ROOT = Path("site")
LAY = ROOT / "_layout"
PAGES = ROOT / "_pages"

HEAD = (LAY / "head.html").read_text(encoding="utf-8")
HEADER = (LAY / "header.html").read_text(encoding="utf-8")
FOOTER = (LAY / "footer.html").read_text(encoding="utf-8")


def parse_front_matter(text):
    """Sépare un YAML-like front matter ---...--- du body."""
    m = re.match(r"^---\s*\n(.*?)\n---\s*\n(.*)$", text, re.DOTALL)
    if not m:
        return {}, text
    meta = {}
    for line in m.group(1).splitlines():
        if ":" in line:
            k, v = line.split(":", 1)
            meta[k.strip()] = v.strip()
    return meta, m.group(2)


def build_page(page_path):
    raw = page_path.read_text(encoding="utf-8")
    meta, body = parse_front_matter(raw)
    name = page_path.stem  # e.g. "index"
    slug = "" if name == "index" else f"{name}.html"

    head = HEAD
    head = head.replace("{{TITLE}}", meta.get("title", "CoinXpert"))
    head = head.replace("{{DESCRIPTION}}", meta.get("description", ""))
    head = head.replace("{{CANONICAL}}", slug)

    extra_head = meta.get("extra_head", "")

    active_key = meta.get("active", "")
    header = HEADER
    for k in ["home", "cabinet", "metiers", "ressources"]:
        header = header.replace(
            "{{ACTIVE_" + k + "}}",
            ' class="active"' if k == active_key else "",
        )

    html = f"""<!doctype html>
<html lang="fr">
<head>
{head}{extra_head}
</head>
<body>

{header}

{body.strip()}

{FOOTER}
</body>
</html>
"""
    out = ROOT / page_path.name
    if out.name.endswith(".md"):
        out = out.with_suffix(".html")
    out.write_text(html, encoding="utf-8")
    print(f"  → {out.relative_to(ROOT.parent)}")


if not PAGES.exists():
    print("Aucun dossier site/_pages/, rien à construire.")
else:
    print("Build en cours :")
    for p in sorted(PAGES.glob("*.html")):
        build_page(p)
    print("Terminé.")
