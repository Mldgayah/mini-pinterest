<?php
$status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    session_start();
  }

/*
 * DS PHP
 * Controller page accueil
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */







//appel model (on gere le upload et database submission en sql ici)
if ( isset($_SESSION['logged'])){

    if (isset($_POST['submituploadform']))
    {
      //$nom =  htmlspecialchars($_POST['nom']);
      //echo "Submisssion!";
      //Appel du modèle
      require_once(PATH_MODELS.$page.'.php');// qui fait la connexion a la base de données
      
      if(isset($erreur)) // affichage des erreurs de login
      {
        header('Location: index.php?message='.$erreur.'&nom='.$nom);
      }
    
    }
    
    require_once(PATH_VIEWS.$page.'.php');
    
  

}else {
  $erreur= "403unauthorized";
  header('Location: index.php?message='.$erreur);
}
