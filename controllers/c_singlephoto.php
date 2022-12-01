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


if (isset($_GET['photo']))
{
  $photoid =  htmlspecialchars($_GET['photo']);
}




//traitement des alertes
if(isset($_GET['message']))
{
  $message = htmlspecialchars($_GET['message']);
  $alert = choixAlert($message);
}


//appel modele
if (isset($_GET['photo']) && isset ($_POST ["submit"] ) ){
    //if a submisson handle it via model
    
    require_once(PATH_MODELS.$page.'.php');
}
  require_once(PATH_VIEWS.$page.'.php');



//appel de la vue

