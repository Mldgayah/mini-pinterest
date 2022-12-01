

<?php
// accès base de données
// connection à la base de données
//  BASS :: cf https://www.w3schools.com/php/php_file_upload.asp


require_once('./config/configuration.php');
require_once('./lib/foncBase.php');
require_once(PATH_TEXTES.LANG.'.php');

$target_dir = "assets/images/";
$target_file = $target_dir . basename($_FILES["customFile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submituploadform"])) {
    $check = getimagesize($_FILES["customFile"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "<script>alert('File is not an image.');</script>";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    //
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["customFile"]["size"] > 500000*1024*1024*1024) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["customFile"]["tmp_name"], $target_file)) {
        $fullfilename= basename( $_FILES["customFile"]["name"]);
        //echo "The file ". basename( $_FILES["customFile"]["name"]). " has been uploaded.";
        // insert to database here
        $new_desc = $_POST['formUpload_description'];
        $new_cat = $_POST['formUpload_selectCat'] ;
        //$photoid =  $_POST['formUpdate_photoId'] ;
        $user_id = getUIDfromusername($_SESSION['logged']);
        $req = "INSERT INTO Photo VALUES (NULL,'$fullfilename', '$new_desc',$new_cat,$user_id,true ); ";
        $result =traiterRequete($req);
        
        echo "<script>alert(' file uploaded');</script>";


    } else {
        echo "<script>alert(' Sorry, there was an error uploading your file.');</script>";
    }
}


// s'il n'y a pas d'erreurs : recherche dans la base de l'utilisateur
// $resQueryPhoto;
// if(!isset($erreur) && isset($nom) && isset($photoid))
// {
//     $resQueryPhoto = get_photo_by_id($photoid);
// }

// echo $resQueryPhoto;