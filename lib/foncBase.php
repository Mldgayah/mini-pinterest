<?php

require_once('./config/configuration.php');

function choixAlert($message)
{
  $alert = array();
  switch($message)
  {
    case 'connexion':
      $alert['messageAlert'] = ERREUR_CONNECT_BDD;
      break;
    case 'login' :
      $alert['messageAlert'] = ERREUR_INSCRIPTION;
      break;
    case 'query' :
      $alert['messageAlert'] = ERREUR_QUERY_BDD;
      break;
    case 'url_non_valide' :
      $alert['messageAlert'] = TEXTE_PAGE_404;
      break;
    default :
      $alert['messageAlert'] = MESSAGE_ERREUR;
  }
  return $alert;
}

/****************  ***************/
function traiterRequete($req){
    $conn = new mysqli(BD_HOST, BD_USER, BD_PWD, BD_DBNAME);
    $res;
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 
    else {
      $res= mysqli_query($conn, $req);
    
    }

  $conn->close();
  
  return $res;
}


function traiterRequeteK($req)
{

  //$conn = new mysqli(BD_HOST, BD_USER, BD_PWD, BD_DBNAME);
  $connexion = new mysqli(BD_HOST, BD_USER, BD_PWD, BD_DBNAME);
  if(mysqli_connect_errno()) // erreur si > 0
    printf("Échec de la connexion :%s",mysqli_connect_error()) ;
  else {
    // utilisation de la base
    $tableauRetourne = array() ;
    $resultat = mysqli_query($connexion, $req) ;
    if($resultat == FALSE) // échec si FALSE
    printf("Échec de la requête ") ;
    else {
      // collecte des métadonnées
      $finfo = mysqli_fetch_fields($resultat);
      $entete = array() ;
      foreach ($finfo as $val){
        array_push($entete, $val->name);
      }
      $tableauRetourne[0]=$entete ;
      $cpt=1 ;
      while ($ligne = mysqli_fetch_assoc($resultat)) {
        $tableauRetourne[$cpt++]= $ligne ;
      }
    }
  }
  $connexion->close(); //!!!on ferme pas la connexion ici!!! on en a besoin!
  return $tableauRetourne;
}


function Array2Table($tableauRetourne, $show_ed = false,$show_rm = false  )
{
  $leTableau = '<table align="center" class="sortable table table-striped table-sm" id="myTable">';
  foreach ($tableauRetourne as  $key => $tuple) {
    if ($key == 0) {
      //ici on est dans le table header
      $leTableau .='<thead><tr id="tableHeader" class="header">';
      foreach ($tuple as $attribut) {
        $leTableau .= '<th>' . $attribut . '</th>';
      }
      //if($tuple >= 1)$leTableau .= '<td><button type="button" class="deletebtn" title="Supprimer"><i class="fas fa-trash-alt"></i></button></td>';
      //else $leTableau .= '<td>Supprimer</td>';
      $leTableau .='</tr></thead>';
    } 
  
    else {
      $leTableau .='<tr>';
    
      foreach ($tuple as $attribut) {
          //check sortable t or tt
        $leTableau .= '<td>' . $attribut . '</td>';
      }
        //if($tuple >= 1)$leTableau .= '<td><button type="button" class="deletebtn" title="Supprimer"><i class="fas fa-trash-alt"></i></button></td>';
        //else $leTableau .= '<td>Supprimer</td>';
      $leTableau .='</tr>';


    }
    
    
   
  }
  $leTableau .= '</table>';
  return $leTableau;
}




/****************  main public functions ************/




function get_all_photos(){
  $query = "SELECT * FROM Photo where isPublic =1;";
  
  return traiterRequete($query);  
}

function get_my_photos($username){
  $query = "SELECT * FROM `photo` JOIN users on users.uID = photo.uploaderID WHERE username ='". $username ."';";
  return traiterRequete($query); 
}

function get_all_cats(){
  $query = "SELECT * FROM Categorie;";
  
  return traiterRequete($query);
 
  
}



function get_photos_with_catName($catName){
  $catName= clean_for_queries($catName);
  $query = "SELECT * FROM Photo where catID = (SELECT catID FROM  Categorie WHERE nomCat=". $catName.") and isPublic =1;";
  $res=traiterRequete($query);
  return $res;
}


function get_photos_with_catID($catID){
  $catID= clean_for_queries($catID);
  $query = "SELECT * FROM Photo where catID =$catID and isPublic =1;";
  $res=traiterRequete($query);
  return $res;
}


function get_photo_by_id($id){
  $id= clean_for_queries($id);
  $query = "SELECT * FROM Photo where photoId = $id;";
  return traiterRequete($query);

}

function getCatName($catID){
  $catID= clean_for_queries($catID);
  $query = "SELECT nomCat FROM Categorie where catID =$catID;";
  $res= mysqli_fetch_assoc (traiterRequete($query));
  return $res['nomCat'];
}



function getImagesCount(){
  $query = "SELECT count(`photoID`) as number_of_images FROM `photo`;";
  $res= mysqli_fetch_assoc (traiterRequete($query));
  return $res['number_of_images'];
}

function getUserImagesCount($username){
  $query = "SELECT count(`photoID`) as number_of_images FROM `photo`
            JOIN users on users.uID = photo.uploaderID WHERE username ='". $username ."';";
  $res= mysqli_fetch_assoc (traiterRequete($query));
  return $res['number_of_images'];
}

function getUsersCount(){
  $query = "SELECT count(`users`.`uID`) as number_of_users FROM `users` where `users`.`isadmin` = 0;";
  $res= mysqli_fetch_assoc (traiterRequete($query));
  return $res['number_of_users'];
}

function getCategoriesCount(){
  $query = "SELECT count(`categorie`.`catID`) as number_of_categories FROM `categorie`;";
  $res= mysqli_fetch_assoc (traiterRequete($query));
  return $res['number_of_categories'];
}

function getImagesPerUser(){
  $query = "SELECT `users`.`username`, count(`users`.`uID`) as user_images FROM `users` join `photo`
	on `photo`.`uploaderID` = `users`.`uID`
	group by `users`.`username`;";
  return traiterRequeteK($query);
}

function getImagesPerCategorie(){
  $query = "SELECT `categorie`.`nomCat`, count(`photo`.`photoID`) as categorie_images FROM `photo` join `categorie`
	on `photo`.`catID` = `categorie`.`catID`
	group by `categorie`.`catID`;";
  return traiterRequeteK($query);
}

/********functions for users */
function canEditPhoto($username, $photoUploaderID){
  $username = clean_for_queries($username);
  $query = "SELECT * FROM users where username ='$username';";
  $res= mysqli_fetch_assoc (traiterRequete($query));
  $bool_admin = $res['isadmin'];
  if ($bool_admin) return true;
  return $photoUploaderID == $res['uID'];
}

function getUIDfromusername($username){
  $username = clean_for_queries($username);
  $query = "SELECT * FROM users where username ='$username';";
  $res= mysqli_fetch_assoc (traiterRequete($query));
  return $res['uID'];
}








/**************** fonctions utiles */

//fonction booleene qui prend un pseudo et dis s'il est admin ou pas
function is_admin($username){
  $username = clean_for_queries($username);
  $query= "SELECT * from users where username=  '$username' AND isadmin=1";
  $result1 = traiterRequete($query);

  if(mysqli_num_rows($result1) > 0 ) return true;
  else return false;

}

//function booleene qui prend un pseudo et dis s'il est user ou pas (admin ou adherent normal)
function is_user($username){
  
  $username = clean_for_queries($username);
  $query= "SELECT * from users where username=  '$username' ";
  $result1 = traiterRequete($query);
  if(mysqli_num_rows($result1) > 0 ) return true;
  else return false;
}

function log_in($username,$password  ){
  //return true;
  $username=clean_for_queries($username);
  $password=clean_for_queries($password);
  $rq = "SELECT username, password FROM users WHERE username = '$username' AND  password = '$password';";
  $result1 = traiterRequete($rq);
  
  
  if(mysqli_num_rows($result1) == 1 ) return true;
  else return false;
}

function log_out(){
  session_destroy() ;
  echo "vous êtes deconnecté, vouz allez etre redirigez vers la page d'accueil.";
  header( "refresh:2;url=index.php" );
}





function clean_for_queries($value)
{
    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

    $value= str_replace($search, $replace, $value);
    $value=stripslashes($value);
    $value=htmlentities($value);
    $value=strip_tags($value);
    return $value;
	
}



?>