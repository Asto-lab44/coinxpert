# Inventaire de la sauvegarde CoinXpert

> Document généré à partir de la sauvegarde Joomla 3.10 fournie le 2026-05-27.

## Identité du site

- **Nom commercial** : CoinXpert
- **Slogan** : *expert-comptable & cryptomonnaies*
- **Activité** : Cabinet d'expertise comptable indépendant spécialisé dans les cryptomonnaies, basé en Loire-Atlantique
- **Date de création (Joomla)** : Mai 2021
- **Admin technique** : guillaume (`sourisseauguillaume@gmail.com`)

## Coordonnées

- **Téléphone** : +33 2 41 00 11 33
- **Email** : contact@coinxpert.fr
- **Horaires** : Lundi au vendredi, 9h00 – 12h30 / 14h – 18h

### Implantations annoncées

| Cabinet | Adresse |
|---|---|
| CoinXpert Nantes Est | 3, Impasse des Tourmalines, Technoparc de l'Aubinière, 44338 NANTES CEDEX 3 |
| CoinXpert Sud Loire | 18, rue Ordonneau, 44406 REZE CEDEX |
| CoinXpert Ancenis | 1 Rue Pierre Dautel, 44150 ANCENIS |
| CoinXpert Nantes | 9 Rue du Petit Châtelier, 44300 Nantes |

> ⚠️ **À vérifier** : ces adresses et le téléphone (indicatif 02 41 = Maine-et-Loire alors que les cabinets sont annoncés à Nantes 02 40) datent de 2021. À confirmer / corriger avant publication du nouveau site.

## Charte graphique

- **Bleu primaire** : `#4447ea`
- **Bleu marine** : `#012970`
- **Texte** : `#444444`
- **Accent corail** : `#fe8278` / `#de4f43`
- **Logos** : `assets/template-original/img/logo.png` (sombre), `logo-w.png` (clair), versions home v1/v2

## Contenu extrait

- **71 articles** (70 publiés, 1 brouillon) — voir `content/articles/*.md`
- **16 catégories** com_content — voir `content/categories.json`
- **95 items de menu** front — voir `content/menus.json`
- **15 modules** front (footer, sidebar contact, etc.) — voir `content/modules.json`
- **49 images** racine + 21 images du template — voir `assets/images/` et `assets/template-original/`

### Catégories principales

- Le Cabinet
- Nos métiers (12 services : expertise comptable, audit, gestion de patrimoine, paie, création d'entreprise, accompagnement sociétés innovantes…)
- Cryptomonnaies (50+ articles pédagogiques : Bitcoin, Ethereum, ICO, NFT, DeFi, fiscalité, stablecoin…)
- Blog (NFT, fiscalité crypto, blockchain & comptabilité)
- Actualités
- Mentions légales / Politique RGPD

## État du contenu

À l'analyse, le site présente plusieurs signes d'**inachèvement** :

- L'article « Le Cabinet » contient un trou : *« trois valeurs fortes et complémentaires : l'innovation, le xx et xx »*
- L'article « Contactez-nous » est vide (juste un titre)
- Plusieurs articles du sitemap s'intitulent `lorem-ipsum-dolor-sit-amet`
- L'incohérence d'indicatif téléphonique

Le projet semble être resté à l'état de **maquette / pilote** plutôt que d'avoir été pleinement exploité.

## Architecture cible (proposition)

Vu l'objectif déclaré (vitrine simple générant des contacts entrants), je recommande un **site statique** avec ces pages :

1. **Accueil** — pitch + 3 services phares + CTA contact
2. **Le cabinet** — présentation, valeurs, équipe
3. **Nos métiers** — liste des 12 services en grille
4. **Ressources** *(optionnel)* — sélection des meilleurs articles cryptos
5. **Contact** — formulaire + téléphone + adresses + map

Tech recommandée : HTML/CSS pur ou Astro (selon volonté d'avoir un blog actif ou non).
Hébergement cible : OVH actuel conservé (FTP), ou bascule sur Cloudflare Pages.

## Fichiers de sauvegarde

- Sauvegarde complète (Joomla + SQL) : `_backup_local/` (ignoré par Git, reste local)
- Template original : `assets/template-original/`
- Images : `assets/images/`
- Contenus extraits : `content/`
- Script d'extraction : `scripts/extract_content.py`
