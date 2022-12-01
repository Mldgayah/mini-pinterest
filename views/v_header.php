<?php

$status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    session_start();
  }
/*
 * DS PHP
 * Vue Entete HTML du site
 *
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 *
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?= TITRE ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="Language" content="<?= LANG ?>"/>
		<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1; user-scalable=0"/>

		
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

		

		

		<style>
			.topheader {
				background-color: #007bff;
				}


		</style>
	</head>
	<body>
		<!-- En-tête -->
		<header class="header topheader" >
			<section class="container" >
				<div class = "row">
					<div class = "col-md-2 col-sm-2 col-xs-12">
						<img src="<?= PATH_LOGO ?>" alt="<?= LOGO ?>" class="img-circle">
					</div>
					<div class="col-md-10 col-sm-10 col-xs-12">
						<h2><?= TITRE ?></h2>
					</div>
				</div>
			</section>
			<?php 
			if (! isset($_SESSION['logged'] ) ) {
				echo '
				<section class="container">
				<form action="index.php?page=hello"  method="post" enctype="multipart/form-data">
				<div class="form-row align-items-center">

					<div class="col-sm-3 my-1">
					<label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
					<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">@</div>
						</div>
						<input type="text" class="form-control" name ="loginUsername" id="loginUsername" placeholder="Username">
					</div>
					</div>

					<div class="col-sm-3 my-1">
					<label class="sr-only" for="inlineFormInputName">Name</label>
					<input type="password" class="form-control" name="loginUserpassword" id="loginUserpassword" placeholder="password">
					</div>
					
					<div class="col-auto my-1">
					<button name="pEnvoyer" type="submit" class="btn btn-success ">Login</button>
					</div>
				</div>
				</form>
			</section>				
				';
			}else {
				echo '
				<div class=" row ">
				<h2 style="padding-left:10%;"> Welcome ' .$_SESSION['logged']  .'</h2>
					<div style="padding-left:3%;" class="login-container">
					<a class="btn btn-success" href="index.php?page=uploadimage" role="button"> <i class="fa fa-plus"></i>  ajouter </a>
					<a class="btn btn-dark" href="index.php?action=logout" role="button">Log out</a>
					';
					
				if (is_admin($_SESSION['logged'] ) ){
					echo '<a style="" class="btn btn-info" href="index.php?page=adminstats" role="button"> admin stats </a>';
				}
				echo '<a style="margin-left:5px;" class="btn btn-info" href="index.php?page=userstats" role="button"> my stats </a>';

				echo '</div>
					</div>

				';
			}
			
			?>
		</header>
		<!-- Menu -->
		<?php include(PATH_VIEWS.'menu.php'); ?>


		<!-- Vue -->
			<section class="container">
				<!--div class = "row"-->
				
	

	</body>
	</html>