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
	<?php include("../links/link.html") ?>
</head>
<body>
	<nav class='navbar navbar-light navbar-expand-md navigation-clean-search'>
		<div class='container'><a class='navbar-brand' href='#' data-aos='fade-down' data-aos-delay='50' data-aos-once='true'>LOGO</a><button class='navbar-toggler' data-toggle='collapse' data-target='#navcol-1'><span class='sr-only'>Toggle navigation</span><span class='navbar-toggler-icon'></span></button>
			<div
			class='collapse navbar-collapse' id='navcol-1'>
			<ul class='nav navbar-nav'>
				<li class='nav-item' role='presentation'><a class='nav-link active' href='#'><span><i class='fa fa-newspaper-o' style='font-size:25px;'></i></span></a></li>
				<li class='nav-item' role='presentation'><a class='nav-link' href='#'>Settings</a></li>
			</ul>
			<form class='form-inline mx-auto' target='_self' style='width:233px;'>
				<div class='form-group'><label for='search-field'><i class='fa fa-search'></i></label><input class='form-control search-field' type='search' name='search' placeholder='Search for topic' id='search-field'></div>
			</form>
			<a class='btn btn-light action-button' role='button' href='OUT/logout.php'>Logout</a>
		</div>
	</div>
</nav>

<div>


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