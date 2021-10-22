# Architecture de "Project name"

## Organisation des packages

## Descriptions des classes principales

décrire une classe = son rôle, ses attributs, ses méthodes publiques (une sorte de javadoc simplifié)

## Architecture back-end

des jolis schémas 

## Architecture de la BDD

des jolis schémas

## Architecture du front-end
   ### Connexion et Inscription
| La vue de connexion permettant de se connecter mais aussi de sauvegarder la session. De plus un lien y est pour se rendre à l'inscription, mais aussi un lien pour renitialiser le mot de passe si necessaire | La vue d'inscription permettant de s'inscrire en tant que nouveau degustateur, mais aussi un lien pour se connecter si on a deja un compte |
| ------ | ------ |
| ![login image](public/assets/img/DesignMd/CaptureSignIn.PNG "login") | ![register image](public/assets/img/DesignMd/CaptureSignUp.PNG "inscription") |
  #### Renitialiser le mot de passe
| Cette vue permet de verifier grace à l'email que l'utilisateur souhaitant renitialiser son de mot de passe, possède un compte.Si oui le ramener vers la page permettant de renitialiser ce mot de passe. | Cette vue permet de renitialiser le mot de passe. |
| ------ | ------ |
| ![forgot password image](public/assets/img/DesignMd/CaptureforgotPassword.PNG "login") | ![reset password image](public/assets/img/DesignMd/CaptureResetPassword.PNG "inscription") |

