<?php $status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    session_start();}

?>


<?php require_once(PATH_VIEWS.'header.php');?>


<?php require_once(PATH_VIEWS.'alert.php');?>


<html>

<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>


<?php  $resQueryPhoto =  mysqli_fetch_assoc(get_photo_by_id($photoid)); ?>


<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-6"  style="width: 18rem;">
            <img src=" <?php echo PATH_IMAGES. $resQueryPhoto['nomFich'] ?> " style="height:725px;max-width:500px;width: expression(this.width > 500 ? 500: true);"  >
           
        </div>
        <div class="col-xs-12 col-md-6">
        <!-- desscription card -->
            <div class="card" style="width: 18rem;">
                <div class="card-header">Info de la photo</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">PhotoId: <?php echo  $resQueryPhoto['photoId']; ?> </li>
                    <li class="list-group-item">NomFichier: <?php echo  $resQueryPhoto['nomFich']; ?> </li>
                    <li class="list-group-item">Description: <?php echo  $resQueryPhoto['description']; ?> </li>
                    <li class="list-group-item">Visibilité: <?php if ($resQueryPhoto['isPublic']) echo "public" ;
                                                                      else echo "hidden" ;  ?> </li>
                    <li class="list-group-item">Catégorie: <?php echo  getCatName($resQueryPhoto['catID']); ?> </li>
                    <?php  
                        //check if userLoggedin if he has rights to edit this file.
                        //if session && canEditPhoto($_SESSION[''],  $resQueryPhoto['uploaderID'])
                        if ( isset($_SESSION['logged']) && canEditPhoto($_SESSION['logged'],  $resQueryPhoto['uploaderID'] ) ) {
                        echo ' <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Edit</button>';
                        }
                    ?>
                </ul>
            </div>
            <div class="col-xs-12 col-md-6" style="width: 18rem; margin-top: 5%">
            <?php
                    if ( isset($_SESSION['logged']) && canEditPhoto($_SESSION['logged'],  $resQueryPhoto['uploaderID'] ) ) {
                        echo ' <form method="POST">
                                <button id="flowless" style="width: 100px;" type="submit" name="delete" class="btn btn-danger">Delete</button>                        
                            </form>';
                        
                        if(isset($_POST['delete'])){
                            echo "<script>alert('deleted!');</script>";
                            $photoid =  $resQueryPhoto['photoId'];
                            $filename =  $resQueryPhoto['nomFich'];
                            $req = "Delete from photo WHERE photoId = $photoid ;";
                            $target_dir = "assets/images/";
                            $file = $target_dir . $filename;
                     
                            $result =traiterRequete($req);
                            unlink($file);
                        }
                    }
            ?>
            </div>
        <!-- END desscription card -->
        <!-- MODAL --->
<!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Modal Heading</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body INSERT FORM WITH FIELD AND A post here -->
            <div class="modal-body">
         
            
            <form action="index.php?page=singlephoto&photo=<?php echo  $resQueryPhoto['photoId']; ?> " method="post" enctype="multipart/form-data">
                
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">PhotId: </label>
                    <div class="col-sm-16">
                    <input type="text" class="form-control" name="formUpda_photoId" id="formUpda_photoId" value="<?php echo  $resQueryPhoto['photoId']; ?>" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">nomFich: </label>
                    <div class="col-sm-16">
                    <input type="text" class="form-control" id="formUpda_nomFich" value="<?php echo  $resQueryPhoto['nomFich']; ?>" disabled>
                    </div>
                </div>                
                
                <input type="hidden" id="formUpdate_photoId" name="formUpdate_photoId" value="<?php echo  $resQueryPhoto['photoId']; ?>" >
                <input type="hidden" id="formUpdate_file" name="formUpdate_file" value="<?php echo  $resQueryPhoto['nomFich']; ?>" >
                <input type="hidden" id="formUpdate_uploaderID" name="formUpdate_uploaderID" value="<?php echo  $resQueryPhoto['uploaderID']; ?>" >

                <div class="form-group">
                    <label for="formUpdate_description"> Description: </label>
                    <textarea class="form-control"  name="formUpdate_description" id="formUpdate_description" rows="2"  ><?php echo  $resQueryPhoto['description']; ?></textarea>
                </div>

                

                <label for="catID">visibilité:</label>
                
                <select class="custom-select" name = "formUpdate_public">
                    <option value ="true" selected>Public</option>
                    <option value ="false">hidden</option>
                </select>


                
                <label for="catID">Catégorie:</label>
                
                <select class="custom-select" name = "formUpdate_selectCat">
                    <!--option selected>Select category</option-->
                    <?php  
                    $resCat = get_all_cats();
                    while ($cat =  mysqli_fetch_assoc($resCat) ){
                        if ( $cat['catID']  ==  $resQueryPhoto['catID']){
                            echo '   <option value="'. $cat['catID'] .'" selected>'.  $cat['nomCat'] .'</option>  ';
                        }else{
                            echo '   <option value="'. $cat['catID'] .'">'.  $cat['nomCat'] .'</option>  ';
                        }

                            
                    }
                    ?>
                    
                </select>


                

            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-success" >Submit</button>
            
            </form>

            </div>
            
        </div>
        </div>
    </div>

        <!---END MODAL>


        
        </div>
        </div>
    </div>
</div>




</html>

<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php');


