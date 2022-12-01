<?php $status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    session_start();}
    
/*
 * DS PHP
 * Vue page index - page d'accueil
 *
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 *
 */
//  En tête de page -->
?>
<?php require_once(PATH_VIEWS.'header.php');?>

<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS.'alert.php');?>


<!--  Début de la page -->
  <h1><?php  echo TITRE_PAGE_HELLO;?></h1>

<!--  Liste  -->
  <ul>
<?php
// affichage de la boucle de messages
if (isset ($resultats ) ){
  for($i=0;$i<=$resultats['nbRepet']; $i++)
{
	echo '<li>'.$resultats['mot'].' '.$nom.'</li>';
}

}
?>
  </ul>
<!--  Fin de la page -->


<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php');
