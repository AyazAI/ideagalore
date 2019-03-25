<?php
require('../config/dbconnection.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST') { // A form is posted


    if (isset($_POST['register'])) { // Register process
        // Retrieve Data
    	$userfirstname = $_POST['first_name'];
    	$userlastname = $_POST['last_name'];
    	$userpassword = password_hash($_POST['password'],PASSWORD_BCRYPT);
    	$useremail = $_POST['email'];
    	$userbirthdate = $_POST['selectyear'] . '-' . $_POST['selectmonth'] . '-' . $_POST['selectday'];
    	$usergender = $_POST['gender'];

        // Check for Already existence of MAIL
    	$query = mysqli_query($conn, "SELECT  email FROM users WHERE email = '$useremail'");
    	$errormsg=[];

    	if(mysqli_num_rows($query) > 0){
			//get associative array
    		$row = mysqli_fetch_assoc($query);
    		$email = $row["email"];

    		if($useremail == $email)
    		{
    			$errormsg['0']= "Email pehlay se hai.";
    		}
    	}


    	/*validation start*/



    	$email = $useremail;
    	$first = $userfirstname;
    	$last = $userlastname;
    	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    		if (preg_match("/^[a-zA-Z ]*$/",$first)) {
    			if (preg_match("/^[a-zA-Z ]*$/",$last)) {
        // Insert Data
    				$sql = "INSERT INTO users(first_name, last_name,  password, email, birthdate, gender)
    				VALUES ('$userfirstname', '$userlastname', '$userpassword', '$useremail', '$userbirthdate', '$usergender')";
    				$query = mysqli_query($conn, $sql);


    				if($query){
    					$query = mysqli_query($conn, "SELECT id FROM users WHERE email = '$useremail'");
    					$row = mysqli_fetch_assoc($query);

    					$cstrong = True;
        				$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

        				$query = mysqli_query($conn, "SELECT id FROM users WHERE email = '$useremail'");
        
        				$row= mysqli_fetch_assoc($query);
        				$id = $row['id'];
        				$token = sha1($token);

        				if(mysqli_query($conn, "INSERT INTO login_tokens(token, user_id) VALUES ('$token','$id')")){
            			setcookie("bp", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
            			setcookie("bp__",1 , time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

           				header("Location:../index.php");
        				}
    					
    					header("Location:../index.php");
    				}
    			}else{
    				$errormsg['1']="Name bhi sai tarah nai likh saktai.";
    			}
    		}else{
    			$errormsg ['2'] ="Name bhi sai tarah nai likh saktai.";
    		}
    	}else{
    		$errormsg ['3'] = "Email to daikh k likho";
    		
    	}
    } /*validation end*/




   
/*Login php*/
session_start();
require("../config/dbconnection.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['login'])) { // Login process
    $useremail = $_POST['email'];
    $userpassword = $_POST['password'];
    $passwordfromdb= mysqli_query($conn, "SELECT password FROM users WHERE email = '$useremail'");

    $passwordresult= mysqli_fetch_assoc($passwordfromdb);

    $verify = password_verify($userpassword,$passwordresult['password']);
    
    if($verify){

        $cstrong = True;
        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

        $query = mysqli_query($conn, "SELECT id FROM users WHERE email = '$useremail'");
        
        $row= mysqli_fetch_assoc($query);
        $id = $row['id'];
        $token = sha1($token);

        if(mysqli_query($conn, "INSERT INTO login_tokens(token, user_id) VALUES ('$token','$id')")){
            setcookie("bp", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
           	header("Location:../index.php");
        }
        



        // $_SESSION['user_name'] = $row['user_firstname'] . " " . $row['user_lastname'];
        
        header("Location: ../index.php");
    }else {
            echo("Invalid Cred");
            //header("location:some.php");
    }
 }
}
}



?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include("../links/link.html"); ?>
	<style type="text/css">
		.login-container{
			margin-top: 10px;
			padding-bottom: 50px;
		}
		.login-logo{
			position: relative;
			margin-left: -41.5%;
		}
		.login-logo img{
			position: absolute;
			width: 20%;
			margin-top: 16%;
			background: white;
			border-radius: 2.1rem;
			padding: 5%;
		}
		.login-form-1{
			padding: 9%;
			background:#e8bb34;
			box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
		}
		.login-form-1 h3{
			text-align: center;
			margin-bottom:12%;
			color:#fff;
		}
		.login-form-2{
			padding: 9%;
			background: #28a745;
			box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
		}
		.login-form-2 h3{
			text-align: center;
			margin-bottom:12%;
			color: #fff;
		}
		.btnSubmit{
			font-weight: 600;
			width: 50%;
			color: #282726;
			background-color: #fff;
			border: none;
			border-radius: 1.5rem;
			padding:2%;
		}
		.btnForgetPwd{
			color: #fff;
			font-weight: 600;
			text-decoration: none;
		}
		.btnForgetPwd:hover{
			text-decoration:none;
			color:#fff;
		}
		body{
			background-color: #e3ede5;
		}

	</style>
</head>
<body>

	

	<!-- bs4 form -->

	
	<?php 

	if (isset($_POST['register'])) {
		if (count($errormsg)>0) {
		//$er = explode(".",$errormsg);
			foreach ($errormsg as $key => $value) {

				echo "<div class='alert alert-danger alert-dismissible fade show'>

				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong>Hmmm! &nbsp</strong>$value
			</div>";

		}


	}
	
}
?>

<!-- Sign In Form -->
<form action="in.php" method="post">

	<div class="container login-container">
		<div class="row">
			<div class="col-md-6 login-form-1">
				<h3>Sign In</h3>

				<div class="form-group">
					<input type="text" class="form-control" name="email" placeholder="Email" value="" />
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password" />
				</div>
				<div class="form-group">
					<input type="submit" class="btnSubmit" value="Login" name="login" />
				</div>

				<!-- forgot password -->
				<div class="form-group">
					<a href="#" class="btnForgetPwd">Forget Password?</a>
				</div>

			</div>


			<!-- center logo -->
			<div class="col-md-6 login-form-2">
				<div class="login-logo">
					<img src="../assets/icons/login.png" alt=""/>
				</div>

			</form>


<!-- Sign Up Form -->
			<form action="in.php" method="post">
				<h3>Sign Up</h3>
				<div class="form-group">
					<input type="text" class="form-control" name="first_name"placeholder="Your First Name"  />
				</div>

				<div class="form-group">
					<input type="text" class="form-control" name="last_name"placeholder="Your Last Name"  />
				</div>


				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Your Password" value="" />
				</div>

				<div class="form-group">
					<input type="password" class="form-control" name="password_confirm" placeholder="Confirm Password" value="" />
				</div>

				<div class="form-group">
					<input type="password" class="form-control" name="email" placeholder="Email" value="" />
				</div>


				<h5>Birthday</h5>
				<div class="form-group form-check-inline">

					<select name="selectday" class="form-control">
						<?php
						for($i=1; $i<=31; $i++){
							echo '<option value="'. $i .'">'. $i .'</option>';
						}
						?>
					</select>
					<select name="selectmonth" class="form-control">
						<?php
						echo '<option value="1">January</option>';
						echo '<option value="2">February</option>';
						echo '<option value="3">March</option>';
						echo '<option value="4">April</option>';
						echo '<option value="5">May</option>';
						echo '<option value="6">June</option>';
						echo '<option value="7">July</option>';
						echo '<option value="8">August</option>';
						echo '<option value="9">September</option>';
						echo '<option value="10">October</option>';
						echo '<option value="11">Novemeber</option>';
						echo '<option value="12">December</option>';
						?>
					</select>
					<select name="selectyear" class="form-control">
						<?php
						for($i=date('Y'); $i>=1975; $i--){
							if($i == 2000){
								echo '<option value="'. $i .'" selected>'. $i .'</option>';
							}
							echo '<option value="'. $i .'">'. $i .'</option>';
						}
						?>
					</select>

				</div>




				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="gender" value="M" checked="checked">Male
					</label>
				</div>

				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="gender" value="F">Female
					</label>
				</div>




				<div class="form-group">
					<input type="submit" class="btnSubmit" name="register" value="Sign Up" />
				</div>

				<div class="form-group">

					<a href="#" class="btnForgetPwd" value="Login">Forget Password?</a>
				</div>
			</form>
		</div>
	</div>
</div>



</body>
</html>