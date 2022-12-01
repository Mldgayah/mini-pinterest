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


<!--  form  -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container mt-3">
<div class = "row"><h1>My stats</h1> <BR><BR><BR> </div>

<!-- form action : submit to model? and do the DB conneection and upload in model-->

<div class="card" style="display: inline-block;"> 
  <div class="card-header">Mes  statistiques personnelles</div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">J'ai téleversé: <?php echo  getUserImagesCount($_SESSION['logged']); ?> images </li>
    </ul>
      <h4 style="margin: 1% 1% 1% 1%;"> Mes photos  </h4>      <BR>

        <?php 
          $myPhotos = get_my_photos($_SESSION['logged']);
          $counter=0;
          while ($row =  mysqli_fetch_assoc($myPhotos))
          {
            //<p>'.  $row['description'] . '</p>
              $counter++;
              
              if ( $row['isPublic']  ||  (isset($_SESSION['logged']) && canEditPhoto($_SESSION['logged'],  $row['uploaderID']) ) )  {
                echo '

                  <div class="col-lg-3 col-md-3 col-3" style="display: inline-block;" >
                  <a href=?page=singlephoto&photo='.  $row['photoId'] . ' target="_blank" class="d-block mb-4 h-100">
                        <img class="img-fluid img-thumbnail"src="'. PATH_IMAGES. $row['nomFich'] . '"  alt="">
                        <div class="caption">
                                
                              </div>
                      </a>
                </div>
              ';
              }
              
          }

          if ($counter==0) echo ' <div class="col-md-6"> <h3> You have not uploaded any photos yet!  </h3> </div>' ;

        ?>
  </div>
</div>

</body>



<!--  Fin de la page -->


<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php');
