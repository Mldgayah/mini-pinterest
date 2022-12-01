<?php $status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    session_start();}
/*
 * DS PHP
 * Vue page index - page d'accueil
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
<h1><?php  echo TITRE_PAGE_ACCUEIL;?></h1>

    <!--  Début formulaire -->
          <!--  ici vous aller creer un formulaire avec un post qui rederige vers "./index.html?page=hello" -->
    <!--  Fin formulaire -->



<!DOCTYPE html>
<html lang="en">
<head>
  <title> Homepage gallery </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"-->
  <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script-->
  <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script-->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  
  
</head>
<body>

<div class="container">
  <h2>Mini pinterest</h2>
  <p>Click on the images to show their details .</p>
  <!-- Example split danger button -->

  <div class="dropdown show">
    
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Choisir une catégorie spécifique  </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

    <a class="dropdown-item"  href="index.php">  ALL cats </a>  
      <?php 
      $resCat = get_all_cats();
      while ($cat =  mysqli_fetch_assoc($resCat) ){
        echo '  <a class="dropdown-item"  href=?cat='. $cat['catID'] .'>'.  $cat['nomCat'] .'</a>  ';
      }
      ?>

    </div>
  </div>
    
  <!---->

  


<!-- Page Content -->
<div class="container">

  
  <?php  
    if (!isset($user_defined_catid) ){
      $homePagePhotos = get_all_photos();
      echo '  <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Photos of cat: ALL</h1>';
      
          
    }else{
      $homePagePhotos = get_photos_with_catID($user_defined_catid);
      echo '<h1 class="font-weight-light text-center text-lg-left mt-4 mb-0"> Photos of cat:'. getCatName($user_defined_catid) . '</h1>';
    }
  ?>

  <hr class="mt-2 mb-5">

  <div class="row text-center text-lg-left">

<!---->
  <?php

    $counter=0;
    while ($row =  mysqli_fetch_assoc($homePagePhotos))
    {
      //<p>'.  $row['description'] . '</p>
        $counter++;
        
        if ( $row['isPublic']  ||  (isset($_SESSION['logged']) && canEditPhoto($_SESSION['logged'],  $row['uploaderID']) ) )  {
          echo '

            <div class="col-lg-3 col-md-4 col-6">
            <a href=?page=singlephoto&photo='.  $row['photoId'] . ' target="_blank" class="d-block mb-4 h-100">
                  <img class="img-fluid img-thumbnail"src="'. PATH_IMAGES. $row['nomFich'] . '"  alt="">
                  <div class="caption">
                          
                        </div>
                </a>
          </div>
        ';
        }
        
    }
    
    if ($counter==0) echo ' <div class="col-md-4"> <h3> No photos in this cat!  </h3> </div>' ;
    
    ?>
    
  
    <!---->
    
  </div>

</div>
<!-- /.container -->




</body>
</html>




<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php');
