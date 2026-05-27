# coinxpert.fr

Site vitrine Joomla 3.10 hébergé chez OVH.

> ⚠️ **Joomla 3.10 est en fin de vie depuis août 2023.** Plus aucune mise à jour de sécurité n'est publiée. Une migration vers Joomla 5 (ou un autre socle) est à prévoir.

## Récupération du site existant

### 1. Sauvegarde des fichiers depuis OVH

**Option A — via SSH (recommandé si activé sur votre offre) :**

```bash
ssh LOGIN@ssh.clusterXXX.hosting.ovh.net
cd ~/www
tar --exclude='./cache' --exclude='./tmp' --exclude='./logs' \
    -czf ~/coinxpert-files.tar.gz .
exit
# Puis récupérer l'archive via SFTP :
sftp LOGIN@ssh.clusterXXX.hosting.ovh.net:coinxpert-files.tar.gz .
```

**Option B — via FTP (FileZilla) :**

1. Espace client OVH → Hébergements → onglet *FTP-SSH* pour récupérer les identifiants
2. Connexion à `ftp.clusterXXX.hosting.ovh.net`
3. Télécharger tout le contenu du dossier `www/` (ou du dossier lié à coinxpert.fr)

### 2. Sauvegarde de la base de données

1. Espace client OVH → Hébergements → *Bases de données* → cliquer sur la base → **phpMyAdmin**
2. Sélectionner la base dans la colonne de gauche
3. Onglet **Exporter** → méthode *Rapide*, format *SQL* → **Exécuter**
4. Conserver le fichier `.sql` obtenu **hors du repo** (il contient potentiellement des données privées)

### 3. Identifiants à conserver (hors Git)

Le fichier `configuration.php` à la racine contient les identifiants de la base.
Il est dans le `.gitignore` — **ne pas le forcer dans Git.**

Notez à part :
- Host DB (`$host`)
- Nom base (`$db`)
- Utilisateur (`$user`)
- Mot de passe (`$password`)
- Préfixe des tables (`$dbprefix`)

### 4. Import du code dans ce repo

Une fois l'archive `coinxpert-files.tar.gz` récupérée en local :

```bash
git clone <ce-repo> coinxpert
cd coinxpert
git checkout claude/nice-babbage-fCqge
tar -xzf ../coinxpert-files.tar.gz
git add .
git commit -m "Import du site Joomla depuis OVH"
git push -u origin claude/nice-babbage-fCqge
```

Le `.gitignore` exclut automatiquement `configuration.php`, le cache, les logs et les dumps SQL.

## Prochaines étapes (à décider)

- [ ] Récupérer les fichiers + la BDD depuis OVH
- [ ] Importer les fichiers dans ce repo
- [ ] Décider de la stratégie long terme :
  - Maintenir Joomla et migrer vers Joomla 5
  - Convertir en site statique (Astro / Hugo / HTML pur)
  - Passer sur un autre CMS (WordPress, Ghost…)
- [ ] Mettre en place un déploiement (FTP/SSH → OVH) depuis GitHub Actions
