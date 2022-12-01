<?php

// accès base de données
// connection à la base de données

require_once('./config/configuration.php');
require_once('./lib/foncBase.php');
require_once(PATH_TEXTES.LANG.'.php');


// s'il n'y a pas d'erreurs : recherche dans la base de l'utilisateur
// $resQueryPhoto;
//global $conn;
    $username =  $_SESSION['logged'];
    $photoUploaderID =  $_POST['formUpdate_uploaderID'];
 if(  isset ($_POST ["submit"] )  && canEditPhoto($username, $photoUploaderID))
 {
  echo "<script>alert('edited!');</script>";
    //$resQueryPhoto =  mysqli_fetch_assoc(get_photo_by_id($photoid));
    //$photoid =  sqli_escape( $_POST['photoId']);

    $new_desc = $_POST['formUpdate_description'];
    $new_cat = $_POST['formUpdate_selectCat'] ;
    $photoid =  $_POST['formUpdate_photoId'] ;
    $visibility =  $_POST['formUpdate_public'] ;
    $req = "UPDATE photo  SET description = '$new_desc', catID = $new_cat, isPublic =$visibility WHERE photoId = $photoid ;";

    $result =traiterRequete($req);
    //echo "<script>alert('". $req . "');</script>";
  // if(mysqli_num_rows($result) > 0){
  //     echo "la requete est faite, maj done";
  //   return true;
            
  //       }else{
  //           echo "la requete est faite, maj not done";

  //         return false;
            
  //       }

}

// echo $resQueryPhoto;
