<?php
include('../config/dbconnection.php'); 

$token= $_COOKIE['bp'];
$query = mysqli_query($conn, "SELECT user_id FROM login_tokens WHERE token = '$token'");
$row= mysqli_fetch_assoc($query);
$id = $row['user_id'];

if (isset($_POST['all'])) {
		mysqli_query($conn, "DELETE FROM login_tokens WHERE user_id='$id'");
		header('Location: index.php');

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
		header('Location: index.php');
	}
