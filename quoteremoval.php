<?php


require("config/dbconnection.php");

if(isset($_POST['submit'])) {
    
    /*getting the plan*/    
    $plan = $_POST['plan'];
    /*Showing all plans*/
    $id = $_GET['id'];


    /*logged in userid*/
    $token = $_COOKIE['bp'];
    $query = mysqli_query($conn, "SELECT * FROM login_tokens WHERE token = '$token'");
    $row= mysqli_fetch_assoc($query);
    $loggedInId = $row['user_id'];
    
    

    $sql = "INSERT INTO plans (plan, plan_for, plan_by) VALUES ('$plan', '$id', '$loggedInId')";


    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success'>
            <strong>Your Plan have been shared!</strong>
                </div>";
}else{
    echo "<div class='alert alert-danger'>
    <strong>Sorry Try Again!</strong>
    ".mysqli_error($conn)."</div>";
}


}


if(isset($_GET['id'])) {

        $id = $_GET['id'];

        $sql = "SELECT * FROM posts WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $row =mysqli_fetch_assoc($result);

        /*GETTING USER NAMES*/

        $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
        $names= mysqli_fetch_assoc($query);
        $firstName=$names['first_name'];
        $lastName=$names['last_name'];
        
echo " <div class='row' data-aos='zoom-in-up' data-aos-once='true' style='background-color:rgba(242,247,246,0.74);padding:0px;margin:45px;height:auto;width:auto;border:2px solid rgb(201,196,196);border-radius:4px;'><div class='col-2 col-md-1 offset-lg-0 d-inline d-flex flex-column justify-content-center' style='border-right:1px solid rgb(217,217,214);background-color:rgba(242,247,246,0.74);'>

    <div class='d-flex flex-column align-items-center'>


    <span id='total-votes-".$row['id']."'>".$row['votes']."</span>

    </div>

</div>

<div class='col-10 col-md-11 offset-lg-0' style='background-color:#f2f5f8;width:680px;'>
 <div>
    <p class='text-muted' style='margin:0px;margin-left:-10px;font-size:small;'>Posted By&nbsp;".$firstName." ".$lastName."</p>
    </div>
    <hr />
    <div>
        <p class='text-left' style='margin-top:10px;font-size:26px;font-family:Aclonica, sans-serif;'>".$row['question']."</p>
    </div>
    <div>
        <p class='text-left' style='font-size:small;margin-left:16px;margin-top:10px;font-family:Adamina, serif;'>".$row['situation']."</p>
    </div>
</div></div>";