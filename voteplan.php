<?php

include("config/dbconnection.php");

/*post id*/
$id = $_POST['post_id'];

$sql = "SELECT * FROM plans WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row2 = mysqli_fetch_assoc($result);

$userVoteId = $row2['user_vote_id'];
$voteCount = $row2['vote_count'];


if($_POST['vote_type'] == -1) {

		if ($voteCount == 0) {
			$sql = "UPDATE plans SET votes=votes-1,vote_count=-1 WHERE id='$id'";
			mysqli_query($conn, $sql);
		}


		if ($voteCount == 1) {
			$sql = "UPDATE plans SET votes=votes-2,vote_count=-1 WHERE id='$id'";
			mysqli_query($conn, $sql);
		}

}


if($_POST['vote_type'] == 1) {

		if ($voteCount == 0) {
				$sql = "UPDATE plans SET votes=votes+1,vote_count=1 WHERE id='$id'";
				mysqli_query($conn, $sql);
		}

		if ($voteCount == -1) {
				$sql = "UPDATE plans SET votes=votes+2,vote_count=1 WHERE id='$id'";
				mysqli_query($conn, $sql);
		}

	

}



$sql = "SELECT votes FROM plans WHERE id='$id'";

if (mysqli_query($conn, $sql)) {

	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$votes = $row['votes'];
	$return = array("votes"=>$votes,"post_id"=>$id);

	echo json_encode($return);
}



