# BIENVENUE SUR MYVAL

> [!CAUTION]
> ⚠️ Lors de la connexion, une erreur va apparaître. Ceci est dû à un changement de données de l'API : ils n'envoient plus les cartes de l'utilisateur.
>
> Ceci est mon projet Symfony, MyVal, qui reprend les données de deux API afin d'obtenir les informations des agents. Voici celles-ci : [Valorant API](https://valorant-api.com) et celle pour récupérer les données des utilisateurs avec leur pseudo et tag : [Henrikdev API](https://api.henrikdev.xyz/).

## Installation locale

Pour exécuter ce projet en local, suivez les étapes ci-dessous :

### Prérequis
- **PHP 8.1 ou supérieur**
- **Composer** : [Installation de Composer](https://getcomposer.org/download/)
- **Symfony CLI** : [Installation de Symfony CLI](https://symfony.com/download)
- **Base de données MySQL**

### Étapes
1. **Clonez le dépôt :**
   ```bash
   git clone https://github.com/AnaelTech/MyVal-.git
   cd MyVal-
   ```
2. **Installez les dépendances :**
   ```bash
   composer install
   ```
3. **Configurez les variables d'environnement :**
   .env.local : 
   ```bash
    DATABASE_URL="mysql://username:password@127.0.0.1:3306/nom_de_la_base"
    ```
4. **Créer la base de données :**
   ```bash
   php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```
5. **Démarrer le serveur :**
   ```bash
   symfony server:start
   ```
6. **Accéder à l'interface :**
   http://localhost:8000


## CONFIGURATION ⚙️

Vous trouverez dans le dossier DataFixtures des données pré-configurés

Comme les images de maps, un user, ainsi que des images par défault

Si vous voulez avoir un aperçu sans vous inscrire voici les identifiants d'un utilisateur que j'ai créé : 

**_Email_**: test@test.com

**_MP_**: test1234

## UPDATE NECESSAIRES 🔜

- Mise en forme du Front 
- Possibilité de delete des membres en tant que Admin de team 
- Envoyer des demande par mail pour rejoindre une team 
- Meilleure gestion des erreurs
- Voir le profil d'un user après une recherche
- Refactoriser

## BARRE DE RECHERCHE 🔎
- [UserController.php: Traitement de la recherche](base.html.twig)
  
J'ai dû créer une barre de recherche accessible sur toutes les pages de mon site. J'ai donc décidé de créer un événement afin que la vue twig ne me renvoie pas d'erreur pour dire que le formulaire n'est pas connu. Avec cet eventsubscriber je renvoie le formulaire à toutes les vues, j'ai trouvé cela plutôt complexe et j'ai dû réaliser beaucoup de recherche sur celle-ci.

## RECUPERATION DES DONNÉES DE L'API ✉️
- [Service/CallApiService.php: Appel à l'api](index.html.twig)
  
Pour la récupération des données par l'API cela s'est plutôt bien passé ce qui a été plus compliqué c'était de transformer ces données en une entité malgré de nombreuses recherches je n'ai pas pu accomplir cela seul, avec l'aide de mon formateur ( Merci Lucas 😂 ) j'ai pu voir par quel procédé passer et comprendre le principe de désérialisation.
 
## SATISFAIT DU RESULTAT 😊

Je reste quand même satisfait de mon projet et pense le continuer en ajoutant du javascript par la suite ainsi que d'ameliorer la sécurité et le front.


## VISUEL DU SITE

![Capture Home MyVal](./public/picture/home-capture.png)
![Capture Agents](./public/picture/agents-capture.png)
![Capture User](./public/picture/user-capture.png)

## OUTILS 💻

Voilà ce que j'ai utilisé pour ce projet : 

![mysql](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white) 

![Symfony](https://img.shields.io/badge/symfony-%23000000.svg?style=for-the-badge&logo=symfony&logoColor=white)

![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)

![Markdown](https://img.shields.io/badge/Markdown-000000?style=for-the-badge&logo=markdown&logoColor=white)

![VsCode](https://img.shields.io/badge/VSCode-0078D4?style=for-the-badge&logo=visual%20studio%20code&logoColor=white)




