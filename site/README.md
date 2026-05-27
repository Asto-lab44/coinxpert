# Site statique CoinXpert

Site vitrine HTML/CSS pur — pas de framework, pas de build obligatoire pour modifier le contenu.

## Structure

```
site/
├── index.html              ← Accueil
├── cabinet.html            ← Le cabinet
├── metiers.html            ← Nos 12 métiers
├── ressources.html         ← Sélection d'articles cryptos (SEO)
├── contact.html            ← Formulaire + coordonnées + 4 implantations
├── mentions-legales.html
├── politique-rgpd.html
├── articles/               ← 8 articles individuels
├── assets/
│   ├── css/style.css       ← Toute la charte
│   ├── img/                ← Logos, hero, about
│   └── js/                 ← (réservé pour ajouts futurs)
├── sitemap.xml
├── robots.txt
├── _layout/                ← Fragments réutilisables (head, header, footer)
└── _pages/                 ← Sources des pages (front matter + body)
```

## Modifier le contenu

**Deux options :**

### A. Édition directe (rapide, pour des retouches)
Modifier directement les fichiers `.html` à la racine de `site/`. Aucun build nécessaire.

### B. Édition via les sources + rebuild (plus propre)
1. Modifier les fragments dans `site/_pages/*.html` et `site/_layout/*.html`
2. Relancer le build : `python3 scripts/build_site.py && python3 scripts/build_articles.py`
3. Les pages finales sont régénérées à la racine de `site/`

> Les fichiers `_layout/` et `_pages/` ne servent **pas** en production — robots.txt les masque. Ils peuvent être supprimés du déploiement si vous voulez.

## Tester localement

```bash
cd site
python3 -m http.server 8000
# Ouvrir http://localhost:8000 dans votre navigateur
```

## Déploiement sur OVH

### Sauvegarde préalable (impératif)
Avant de remplacer l'ancien Joomla, **téléchargez une dernière sauvegarde complète** de `www/` via FTP pour pouvoir revenir en arrière en cas de problème.

### Étapes
1. Connectez-vous en FTP avec FileZilla (cf. README racine)
2. Côté serveur, dans `www/`, **renommez** l'ancien dossier (ex : créez `_old/` et déplacez-y tous les fichiers existants). Ne supprimez rien tant que le nouveau site ne tourne pas.
3. Côté local, sélectionnez **tout le contenu du dossier `site/`** (PAS le dossier lui-même)
4. Glissez-déposez dans `www/` côté serveur
5. Testez en ouvrant <https://www.coinxpert.fr/> dans un onglet privé (pour éviter le cache)
6. Si tout est OK, vous pouvez supprimer `_old/` quelques jours plus tard

### Formulaire de contact

Le formulaire utilise [Formspree](https://formspree.io/) (gratuit jusqu'à 50 envois/mois). À configurer :
1. Créez un compte sur formspree.io
2. Créez un formulaire pointant vers `contact@coinxpert.fr`
3. Dans `site/contact.html` (ou `_pages/contact.html` + rebuild), remplacez `https://formspree.io/f/REPLACE_ME` par votre URL Formspree

**Alternative PHP OVH** : si vous préférez un script PHP hébergé chez OVH, dites-le, on remplace Formspree par un `contact.php` simple.

## Points à compléter avant publication

- [ ] **Mentions légales** : SIRET, RCS, numéro TVA, n° Ordre des Experts-Comptables, directeur de la publication (cf. `mentions-legales.html`)
- [ ] **Formulaire** : remplacer l'URL Formspree (cf. ci-dessus)
- [ ] **Photos équipe** : remplacer `assets/img/about.jpg` par une vraie photo du cabinet/équipe
- [ ] **Coordonnées** : revérifier le téléphone (02 41 vs 02 40 ?) et les 4 adresses
