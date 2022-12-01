<?php 
$status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    session_start();
  }

 
// Contrôle - Neutralisation du paramètre reçu
if (   isset( $_POST ["pEnvoyer"] , $_POST["loginUserpassword"],$_POST["loginUsername"] )   )
{
  $nom =  htmlspecialchars($_POST['loginUsername']);
  $pass=  htmlspecialchars($_POST['loginUserpassword']);

  //Appel du modèle
  require_once(PATH_MODELS.$page.'.php');// qui fait la connexion a la base de données
  if(isset($erreur)) // affichage des erreurs de login
  {
     header('Location: index.php?message='.$erreur.'&nom='.$nom);
  }
  else
  {
    require_once(PATH_VIEWS.$page.'.php');
  }
}
else
{
     header('Location: index.php');
}
