<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## À propos du Projet : Gestion de Stock

Ce projet est une application web de **Gestion de Stock** développée avec le framework Laravel. Elle permet une gestion centralisée des inventaires, incluant le suivi des produits et l'exportation de données.

- **Gestion des Produits :** CRUD complet pour l'inventaire.
- **Export Excel :** Intégration de PhpSpreadsheet pour générer des rapports.
- **Optimisation :** Interface fluide et gestion efficace des données.

---

## Guide d'Installation

Suivez ces étapes pour configurer le projet dans votre environnement local :

### 1. Installation des dépendances
Ouvrez votre terminal (Git Bash) dans le dossier du projet et exécutez :

```bash
composer install
npm install```

### 2. Configuration de l'extension Excel (GD)
Pour permettre l'exportation des fichiers Excel via **PhpSpreadsheet**, l'extension **GD** doit être activée sur votre serveur PHP.

**Sur Windows (XAMPP) :**

1.  Ouvrez le panneau de contrôle **XAMPP**.
2.  Cliquez sur le bouton **Config** en face d'Apache, puis choisissez `php.ini`.
3.  Recherchez la ligne `;extension=gd`.
4.  Supprimez le point-virgule (`;`) pour activer l'extension :

```ini
extension=gd```
5.   Redémarrez Apache depuis le panneau XAMPP.

Vérification de l'activation :
php -m | grep gd
