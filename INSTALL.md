# Installer TasteMyBeer en local

Ce document vous donne toutes les instructions pour installer TasteMyBeer avec toutes les dépendances nécessaires.

## Étapes

### 1. Installer Git

#### Utilisateur sous Linux

Voir ce [lien](http://git-scm.com/download/linux) pour avoir les différentes étapes en fonction de votre distribution Linux.

#### Utilisateur sous Windows

Télécharger la dernière version de Git à jour sur ce site : [Télécharger Git pour windows](http://git-scm.com/download/win)

### 2. Installer PHP, Apache et MySQL

#### Utilisateur sous Linux

Exécuter la commande suivante :

```
sudo apt install apache2 php libapache2-mod-php mysql-server php-mysql
```

#### Utilisateur sous Windows

Télécharger WampServer à l'adresse suivante :[Télécharger Wamp](https://www.wampserver.com/)

### 3. Créer un virtual host

### 4. Cloner le projet

1. Déplacer vous à la racine de votre virtual host
2. Exécuter la commande suivante :

```
git clone https://gitlab.istic.univ-rennes1.fr/pdl-g4/beer-tasting-app.git
```

### 5. Créer la base de données

#### Création manuellement

Importer le fichier [init.sql]() dans PhpMyAdmin.

#### Création via le terminal

1. Ouvrez un terminal
2. Déplacer vous dans le dosier `/database` du projet
3. Executer la commande suivante:

##### Utilisateur sous Linux

```
mysql -u user -p < init.sql
```

##### Utilisateur sous Windows

```
sqlcmd -U myLogin -P myPassword -S MyServerName -d MyDatabaseName -i init.sql
```

## Dépendences

Les librairies suivantes sont nécéssaires:

1. PhpMailer
