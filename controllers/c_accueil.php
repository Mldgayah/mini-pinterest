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

if (isset($_GET['nom']))
{
  $nom =  htmlspecialchars($_GET['nom']);
}
if (   isset( $_GET['action']) &&  $_GET ['action']== "logout"){
  
  session_destroy() ;
  echo '<script>alert("vous êtes deconnecté, vouz allez etre redirigez vers la page d\'accueil.");</script>';  
  header( "refresh:2;url=index.php" );
  
}


if (isset($_GET['cat']))
{
  $user_defined_catid =  htmlspecialchars($_GET['cat']);
}


//traitement des alertes
if(isset($_GET['message']))
{
  $message = htmlspecialchars($_GET['message']);
  $alert = choixAlert($message);
}

//appel de la vue
require_once(PATH_VIEWS.$page.'.php');
