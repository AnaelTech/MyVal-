
# BIENVENUE SUR MYVAL

Ceci est mon projet symfony, MyVal qui reprends les données de deux API afin d'avoir les données des agents voici celle-ci : https://valorant-api.com Et celle pour recupérer les données de utilisateurs avec leur Pseudo et tag voici l'autre : https://api.henrikdev.xyz/😁

## CONFIGURATION ⚙️
```
Vous trouverez dans le dossier DataFixtures des données pré-configurés

Comme les images de maps, un user, ainsi que des images par défault

Si vous voulez avoir un aperçu sans vous inscrire voici les identifiants d'un utilisateur que j'ai créé : 

**_Email_**: test@test.com

**_MP_**: test1234

## UPDATE NECESSAIRES 🔜

- Mise en forme du Front 
- Possibilité de delete des membres en tant que Admin de team 
- Envoyer des demande  pour rejoindre une team 
- Meilleure gestion des erreurs
- Refactoriser

## BARRE DE RECHERCHE 🔎
- [UseController.php: Traitement de la recherch](base.html.twig)
J'ai du créer une barre de recherche accessible sur toute les pages de mon site j'ai donc décider de créer un event afin que la vue twig ne me renvoie pas d'erreur pour dire que le formulaire n'est pas connue, avec cette eventsubscriber je renvoie le formulaire à toute les vues, j'ai trouvé cela plutôt complexe et j'ai du réaliser beaucoup de recherche sur celle-ci. 

## RECUPERATION DES DONNÉES DE L'API ✉️
- [Service/CallApiService.php: Appel à l'api](index.html.twig)
Pour la récupération des donnée par l'api cela c'est plutôt bien passé ce qui a été plus compliqué c'etait de transformer ses données en une entity malgrés de nombreuses recherche je n'ai pas pu accomplir cela seul, avec l'aide mon formateur ( Merci Lucas 😂 ) j'ai pu voir par quelle procécédé passer et comprendre le principe de deserialize. 

## SATISFAIT DU RESULTAT 😊
Je reste quand même satisfait de mon projet et pense le continuer en ajoutant du javascript par la suite ainsi que d'ameliorer la sécurité et le front 

## OUTILS 💻

Voilà ce que j'ai utilisé pour ce projet : 

![mysql](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

![symfony](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=symfony&logoColor=white)

![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)

![Markdown](https://img.shields.io/badge/Markdown-000000?style=for-the-badge&logo=markdown&logoColor=white)

![VsCode](https://img.shields.io/badge/VSCode-0078D4?style=for-the-badge&logo=visual%20studio%20code&logoColor=white)




