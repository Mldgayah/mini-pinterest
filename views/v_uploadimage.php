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
<div class = "row"><h1>ajouter un fichier a la gallerie</h1> <BR><BR><BR> </div>

<!-- form action : submit to model? and do the DB conneection and upload in model-->
<form action="index.php?page=uploadimage" method="post" enctype="multipart/form-data">

    <div class="form-group">
      <div class="custom-file">
            
            
            <input type="file" class="custom-file-input" name="customFile" id="customFile" accept="image/*">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
    </div>
    <div class="form-group">
        <label for="formUpdate_description"> Description: </label>
        <textarea class="form-control" name="formUpload_description" id="formUpload_description" rows="2"  > </textarea>
    </div>

  <!-- add hidden form field with uploaderID so that the form passed will have all data-->

  <div class="form-group">
    <label for="pwd">categorie:</label>
    <select class="custom-select" name = "formUpload_selectCat">
    <option selected>Select category</option>
    <?php 
      $resCat = get_all_cats();
      while ($cat =  mysqli_fetch_assoc($resCat) ){
        echo '   <option value="'. $cat['catID'] .'">'.  $cat['nomCat'] .'</option>  ';
      }
      ?>
    
    </select>
  </div>



  <button type="submit" name="submituploadform" class="btn btn-primary">Submit</button>
</form>

</div>

</body>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

<!--  Fin de la page -->


<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php');
