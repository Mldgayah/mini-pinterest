# Application mini-Pinterest
Vous pouvez accéder directement à l'application via ce lien: http://guide-scientific.fr/
## Réalisée par DIALLO Mamadou Lamarana P1714158


Bonjour et bienvenue, vous retrouvez ci-dessous les informations necessaires pour que vous pourriez utiliser l'application, ainsi que toutes les fonctionnalités implémentées.

### Mise en place de l'environnement
Vous trouvez dans le fichier ./config/configuration tous les paramètres de configuration du site. Modifier les paramètres d'accès à la base de données selon votre architecture.

### Connexion 
- Pour vous connecter au profil administrateur, veuillez saisir ```pseudo:"admin" et mot de passe="admin```.
- Pour vous connecter en tant que utilisateur, veuillez utiliser l'un des deux profils utilisateur présent: 
1. ```pseudo:"alice12" et mot de passe="alice12```.
2. ```pseudo:"user1" et mot de passe="user1```.
2. ```pseudo:"tigao17" et mot de passe="tigao17```.
 

### les fonctionnalités 
1. La page d'acceuil permet à l’internaute de visualiser l’ensemble des photos référencées dans la base de données. Il peut aussi choisir de visualiser les photos d'une catégorie donnée
2. Pour chaque photo, l'internaute peut afficher le détail de la photo en cliquant dessus.
3. Pour qu'un internaute puisse modifier et téléverser des photos, il doit être connecteur. Pour cela, un formulaire de connexion est présent dans le menu. On distinguera dans la suite deux profils.
3.  Le profil « administrateur »  avec un lien d’accès dédié correspondant à un membre responsable de l’association qui a la possibilité:

    · de gérer(ajouter/modifier/supprimer) des photos de tous les utilisateurs.
    · d’avoir une page de statistique(nombre d’utilisateurs, nombre de photos de chaque utilisateur et de chaque catégorie…  )  

5.   Le profil « utilisateur » correspondant qui a la possibilité :

    · de gérer ses données personnelles.
    · de visualiser ses photos, d’ajouter/modifier/supprimer/cacher ses photos.

6. Dans ce cas, s'il est admin, il peut modifier toutes les images, voir les statistiques de la base de donnée, ainsi que toutes les fonctionnalités du profil utilisateur. S'il n'est qu'un simple utilisateur, alors il peut ajouter une photo ou téléverser une photo.

