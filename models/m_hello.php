<?php
// accès base de données
// connection à la base de données

require_once('./config/configuration.php');
require_once('./lib/foncBase.php');
require_once(PATH_TEXTES.LANG.'.php');

try
{
	/// etablir une connexion a la base de données

	// Accès base de données
}
catch(exception $e)
{
	$erreur = 'connexion';
}

// s'il n'y a pas d'erreurs : recherche dans la base de l'utilisateur
if(!isset($erreur) && isset($nom))
{

	
	// try
	// {
	// 	// a l'interieur de ce block executer la requette et verifier le resultat retourné

	// }
	// catch(exception $e)
	// {
	// 	$erreur = 'query';
	
	// }

	
	if (log_in($nom,$pass)) {
			$_SESSION['logged'] =$nom; 
			header( "refresh:0;url=index.php" );
	}else
	     {
	         header( "refresh:0; url=index.php?page=hello" );
	         echo '<script>alert("Le couple pseudo/mot de passe ne correspond à aucun utilisateur!");</script>';
			 
	         exit();
	     }
}


