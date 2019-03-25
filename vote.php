<?php
include("config/dbconnection.php");

$token = $_COOKIE['bp'];

$query = mysqli_query($conn, "SELECT user_id FROM login_tokens WHERE token = '$token'");
$row= mysqli_fetch_assoc($query);

/*getting logged in user id*/
$loggedInUserId = $row['user_id'];

/*post id*/
$id = $_POST['post_id'];


$sql = "SELECT * FROM posts WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$userVoteId = $row['user_vote_id'];
$voteCount = $row['vote_count'];


if($_POST['vote_type'] == -1) {

		if ($voteCount == 0) {
			$sql = "UPDATE posts SET votes=votes-1,vote_count=-1 WHERE id='$id'";
			mysqli_query($conn, $sql);
		}


		if ($voteCount == 1) {
			$sql = "UPDATE posts SET votes=votes-2,vote_count=-1 WHERE id='$id'";
			mysqli_query($conn, $sql);
		}

		
		
}


if($_POST['vote_type'] == 1) {

		if ($voteCount == 0) {
				$sql = "UPDATE posts SET votes=votes+1,vote_count=1 WHERE id='$id'";
				mysqli_query($conn, $sql);
		}

		if ($voteCount == -1) {
				$sql = "UPDATE posts SET votes=votes+2,vote_count=1 WHERE id='$id'";
				mysqli_query($conn, $sql);
		}

	

}



$sql = "SELECT votes FROM posts WHERE id='$id'";

if (mysqli_query($conn, $sql)) {

	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$votes = $row['votes'];
	$return = array("votes"=>$votes,"post_id"=>$id);

	echo json_encode($return);
}



