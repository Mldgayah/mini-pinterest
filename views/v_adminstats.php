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
<div class = "row"><h1>admin stats</h1> <BR><BR><BR> </div>

<!-- form action : submit to model? and do the DB conneection and upload in model-->

<div class="card">
  <div class="card-header">Statistique globale sur les images et les utilisateurs</div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">nombre d'utilisateurs: <?php echo getUsersCount();  ?> </li>
      <li class="list-group-item">nombre de catégories: <?php echo getCategoriesCount(); ?> </li>
      <li class="list-group-item">nombre d'images: <?php echo  getImagesCount(); ?> </li>
      <BR>
      <li class="list-group-item card-header"><h4>nombre de photos de chaque utilisateurs </h4> </li>
        <?php
          $tableauRetourne = getImagesPerUser();
          echo Array2Table($tableauRetourne);
        ?>
        <BR>
      <div class="list-group-item card-header"> <h4>nombre de photos de chaque categories</h4> </div>
        <?php
          $tableauRetourne = getImagesPerCategorie();
          echo Array2Table($tableauRetourne);
        ?>

    </ul>
  </div>
</div>

</body>



<!--  Fin de la page -->


<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php');
