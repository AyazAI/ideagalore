<?php
include("../config/dbconnection.php");



/*very crucial logging verification*/


function isLoggedIn()

{
    include('../config/dbconnection.php'); 

    if (isset($_COOKIE['bp'])) {
        $token = $_COOKIE['bp'];

        $query = mysqli_query($conn, "SELECT user_id FROM login_tokens WHERE token = '$token'");

        if ($query) {

            $row= mysqli_fetch_assoc($query);
            $id = $row['user_id'];

            return $id;
        }
        
    }
    return False;
}

if (isLoggedIn()) {
    
$token= $_COOKIE['bp'];
$query = mysqli_query($conn, "SELECT user_id FROM login_tokens WHERE token = '$token'");
$row= mysqli_fetch_assoc($query);
$id = $row['user_id'];	

if (isset($_POST['confirm'])) {

	if (isset($_POST['alldevices'])) {
		mysqli_query($conn, "DELETE FROM login_tokens WHERE user_id='$id'");
		header('Location: logout.php');

	} else {

		//$token = sha1($token);
		/*$query=mysqli_query($conn, "SELECT * FROM login_tokens WHERE token='$token'");
		$row= mysqli_fetch_assoc($query);
		$tokenq = $row['token'];

		echo "token from db ".$tokenq;
		echo "<br>";
		echo "token in browser ".$token;*/

		if (isset($_COOKIE['bp'])) {
			mysqli_query($conn, "DELETE FROM login_tokens WHERE token='$token'");
		}
		setcookie('bp', '1', time()-3600);
		setcookie('bp__', '1', time()-3600);
		header('Location: logout.php');
	}
}


}else{
    header('Location: ../IN/in.php');

}



?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/css/Features-Boxed.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/header1.css">
    <link rel="stylesheet" href="assets/css/header2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">
    <link rel="stylesheet" href="../assets/css/Pretty-Header.css">
    <link rel="stylesheet" href="../assets/css/sticky-dark-top-nav-with-dropdown.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="shortcut icon" href="https://img.icons8.com/color/48/000000/brainstorm-skill.png" type="image/x-icon"/>
</head>
<body>
	

<nav class="navbar navbar-light navbar-expand-md custom-header">
        <div class="container-fluid"><a class="navbar-brand" href="index.php" style="color:rgb(241,238,238);">Idea<span><strong>Galore</strong></span></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav links">
                    <li class="nav-item" role="presentation"><a class="nav-link" style="margin-right:14px;font-family:'Roboto Slab', serif;font-size:19px;" href="howitworks.php">How it Works?</a></li>
                </ul>
                <form class="form-inline mx-auto" style="font-family:Roboto, sans-serif;"><input class="form-control" type="search" placeholder="Search for Posts ..." autofocus="" autocomplete="on" style="width:352px;"></form>
                <ul class="nav navbar-nav ml-auto">
            <li>
                <a href="../profile.php">
                    <button class="btn btn-primary" style="margin-right: 4px;">Profile</button>
                </a>

            </li>
        </ul>


        </div>
        </div>
    </nav>




<div class="jumbotron jumbotron-fluid" >
		<div class="container">
			<h1>Are you sure !</h1>  
			<form action="logout.php" method="post">
				<div class="form-check">
					<label class="form-check-label">
						<input type="checkbox" name="alldevices" class="form-check-input">Logout of All devices?</input>
					</label>
				</div>

				<input type="submit" name="confirm" class="btn btn-primary" value="Confirm"></input>
			</form>
		</div>
	</body>
</html>