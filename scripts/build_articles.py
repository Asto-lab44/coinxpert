#!/usr/bin/env python3
"""Génère les pages d'articles sélectionnés (site/articles/*.html)
et la page de listing (site/_pages/ressources.html) à partir de content/articles/.
"""
import re
import json
from pathlib import Path

ROOT = Path("site")
LAY = ROOT / "_layout"
ART_OUT = ROOT / "articles"
ART_OUT.mkdir(exist_ok=True)

HEAD = (LAY / "head.html").read_text(encoding="utf-8")
HEADER = (LAY / "header.html").read_text(encoding="utf-8")
FOOTER = (LAY / "footer.html").read_text(encoding="utf-8")

# Sélection d'articles (id + label catégorie pour le tag)
SELECTED = [
    (2,  "Blockchain", "La Blockchain : la techno de base de la crypto"),
    (32, "Bitcoin", "Qu'est-ce que le Bitcoin ?"),
    (38, "Ethereum", "Qu'est-ce que la blockchain d'Ethereum ?"),
    (18, "Notions", "Différence entre monnaie fiduciaire et cryptomonnaie"),
    (14, "Fiscalité", "Calculer ses gains en cryptomonnaies pour les impôts"),
    (21, "DeFi", "Quels sont les cas d'utilisation de la DeFi ?"),
    (41, "Stablecoin", "Qu'est-ce qu'un stablecoin ?"),
    (25, "ICO", "Comment fonctionne une ICO ?"),
]


def parse_front_matter(text):
    m = re.match(r"^---\s*\n(.*?)\n---\s*\n(.*)$", text, re.DOTALL)
    if not m:
        return {}, text
    meta = {}
    for line in m.group(1).splitlines():
        if ":" in line:
            k, v = line.split(":", 1)
            meta[k.strip()] = v.strip().strip('"')
    return meta, m.group(2)


def clean_body(html):
    """Nettoyage léger du HTML Joomla : retire styles inline, classes, scripts, etc."""
    html = re.sub(r"<script\b.*?</script>", "", html, flags=re.DOTALL | re.IGNORECASE)
    html = re.sub(r"<style\b.*?</style>", "", html, flags=re.DOTALL | re.IGNORECASE)
    html = re.sub(r'\s(?:style|class|id|align|border|width|height|cellpadding|cellspacing|valign|bgcolor|target)="[^"]*"', "", html, flags=re.IGNORECASE)
    html = re.sub(r"<o:p\s*/?>", "", html)
    html = re.sub(r"</o:p>", "", html)
    html = re.sub(r"<span>\s*</span>", "", html)
    html = re.sub(r"<p>\s*</p>", "", html)
    html = re.sub(r"<p>(\s*<br\s*/?>)+\s*</p>", "", html)
    html = re.sub(r"\n{3,}", "\n\n", html)
    return html.strip()


def first_paragraph_text(html):
    m = re.search(r"<p[^>]*>(.*?)</p>", html, re.DOTALL)
    if not m:
        return ""
    return re.sub(r"<[^>]+>", "", m.group(1)).strip()[:200]


def render(title, description, slug, body_html, tag, date):
    head = HEAD
    head = head.replace("{{TITLE}}", title)
    head = head.replace("{{DESCRIPTION}}", description)
    head = head.replace("{{CANONICAL}}", f"articles/{slug}.html")
    # Fix relative paths for /articles/ subfolder
    head = head.replace('href="assets/', 'href="../assets/')
    head = head.replace('content="https://www.coinxpert.fr/assets/', 'content="https://www.coinxpert.fr/assets/')

    header = HEADER
    for k in ["home", "cabinet", "metiers", "ressources"]:
        header = header.replace(
            "{{ACTIVE_" + k + "}}",
            ' class="active"' if k == "ressources" else "",
        )
    header = header.replace('href="index.html"', 'href="../index.html"')
    header = header.replace('href="cabinet.html"', 'href="../cabinet.html"')
    header = header.replace('href="metiers.html"', 'href="../metiers.html"')
    header = header.replace('href="ressources.html"', 'href="../ressources.html"')
    header = header.replace('href="contact.html"', 'href="../contact.html"')
    header = header.replace('src="assets/', 'src="../assets/')

    footer = FOOTER
    footer = footer.replace('href="index.html"', 'href="../index.html"')
    footer = footer.replace('href="cabinet.html', 'href="../cabinet.html')
    footer = footer.replace('href="metiers.html', 'href="../metiers.html')
    footer = footer.replace('href="contact.html', 'href="../contact.html')
    footer = footer.replace('href="mentions-legales.html', 'href="../mentions-legales.html')
    footer = footer.replace('href="politique-rgpd.html', 'href="../politique-rgpd.html')
    footer = footer.replace('src="assets/', 'src="../assets/')

    return f"""<!doctype html>
<html lang="fr">
<head>
{head}
</head>
<body>

{header}

<div class="article">
  <a href="../ressources.html" class="back-link">← Toutes les ressources</a>
  <header>
    <span class="tag">{tag}</span>
    <h1>{title}</h1>
    <time>{date}</time>
  </header>
  <div class="body">
{body_html}
  </div>

  <div class="spacer"></div>
  <div style="background:#f6f9ff;border-radius:14px;padding:1.6rem;text-align:center">
    <h3 style="margin:0 0 .4rem">Une question fiscale sur vos crypto-actifs ?</h3>
    <p style="margin:0 0 1rem;color:#555">Un cabinet d'expertise comptable spécialisé répond à vos questions.</p>
    <a href="../contact.html" class="btn btn-primary">Prendre contact</a>
    <a href="tel:+33241001133" class="btn btn-outline">📞 02 41 00 11 33</a>
  </div>
</div>

{footer}
</body>
</html>
"""


# === Génération des articles ===
articles_meta = []
for art_id, tag, label in SELECTED:
    # Trouver le fichier .md correspondant
    md_files = list(Path("content/articles").glob(f"{art_id}-*.md"))
    if not md_files:
        print(f"⚠ article {art_id} introuvable")
        continue
    md_path = md_files[0]
    meta, body_md = parse_front_matter(md_path.read_text(encoding="utf-8"))
    # Le corps markdown contient en fait du HTML brut (introtext + fulltext)
    # Extraire après le # titre
    body = re.sub(r"^#[^\n]+\n", "", body_md, count=1).strip()
    body_clean = clean_body(body)
    title = meta.get("title", label).strip().strip('"')
    description = first_paragraph_text(body_clean) or label
    slug = re.sub(r"[^a-z0-9-]", "-", label.lower())
    slug = re.sub(r"-+", "-", slug).strip("-")[:60]
    created = meta.get("created", "")
    date = created.split(" ")[0] if created else ""
    html = render(title, description, slug, body_clean, tag, date)
    (ART_OUT / f"{slug}.html").write_text(html, encoding="utf-8")
    articles_meta.append({
        "id": art_id, "title": title, "slug": slug,
        "tag": tag, "description": description, "date": date,
    })
    print(f"  → site/articles/{slug}.html")

# === Page de listing ressources.html ===
cards = ""
for a in articles_meta:
    cards += f"""      <div class="card">
        <div class="body">
          <span class="tag">{a['tag']}</span>
          <h3>{a['title']}</h3>
          <p>{a['description']}</p>
          <a href="articles/{a['slug']}.html" class="more">Lire l'article →</a>
        </div>
      </div>
"""

resources_page = f"""---
title: Ressources crypto
description: Sélection d'articles pour comprendre les cryptomonnaies, la blockchain, la fiscalité crypto, la DeFi et les NFT — par CoinXpert, expert-comptable spécialisé.
active: ressources
---

<section class="hero" style="padding-bottom:1rem">
  <div class="container">
    <p style="color:#4447ea;font-weight:600;text-transform:uppercase;letter-spacing:.08em;font-size:.85rem;margin:0 0 .6rem">Ressources crypto</p>
    <h1>Comprendre les crypto-actifs.</h1>
    <p class="lead" style="max-width:780px">Une sélection d'articles pour les particuliers et professionnels qui veulent maîtriser les bases — de la blockchain à la fiscalité crypto.</p>
  </div>
</section>

<section>
  <div class="container">
    <div class="cards">
{cards}    </div>
  </div>
</section>

<section class="bg-soft">
  <div class="container text-center">
    <h2>Une question précise ?</h2>
    <p class="lead" style="margin:0 auto 1.6rem;max-width:600px">Un cas particulier, un montage, une optimisation : passons en mode dialogue.</p>
    <a href="contact.html" class="btn btn-primary">Prendre contact</a>
  </div>
</section>
"""

(ROOT / "_pages" / "ressources.html").write_text(resources_page, encoding="utf-8")
print(f"  → site/_pages/ressources.html ({len(articles_meta)} articles)")
