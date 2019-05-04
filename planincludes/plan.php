<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 

<?php
require("config/dbconnection.php");


/* 
    CODE FOR SHARING OF PLAN WITH MESSAGE
*/
if(isset($_POST['submit'])) {

    $plan = mysqli_real_escape_string($conn,$_POST['plan']);
    $id = $_GET['id'];

    /*logged in userid*/
    $token = $_COOKIE['bp'];
    $query = mysqli_query($conn, "SELECT * FROM login_tokens WHERE token = '$token'");
    $row= mysqli_fetch_assoc($query);
    $loggedInId = $row['user_id'];
    
    $sql = "INSERT INTO plans (plan, plan_for, plan_by) VALUES ('$plan', '$id', '$loggedInId')";


if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success' style='width: 100%;'>
        <strong>Your Plan have been shared!</strong>
    </div>";
}else{
    echo "<div class='alert alert-danger'>
    <strong>Sorry Try Again!</strong>
    ".mysqli_error($conn)."</div>";
    }
}

/*
    END
*/


/*
    SHOWING CURRENT POST FOR WHICH THE PLANS WILL BE CREATED 
*/


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

 
 echo "
        <div class='row' data-aos='zoom-in-up' data-aos-once='true' style='background-color:rgba(242,247,246,0.74);padding:0px;margin:45px;height:auto;width:auto;border:2px solid rgb(201,196,196);border-radius:4px;'>

        <div class='col-1 col-lg-1 offset-lg-0 d-flex flex-column justify-content-center' style='border-right:1px solid rgb(217,217,214);background-color:rgba(242,247,246,0.74);'>

            <div class='d-flex flex-column align-items-center align-self-center'>
            
            <a class='options' id='";?><?php echo $row['id'];?><?php echo "' data-vote-type='1' style='cursor:pointer;'>
            <i class='fa fa-arrow-up d-inline' style='width:16px;height:27px;font-size:21px;'></i>
            </a>

            <span id='total-votes-".$row['id']."'>".$row['votes']."</span>

            <a class='options' id='";?><?php echo $row['id'];?><?php echo "' data-vote-type='-1' style='cursor:pointer;'>
            <i class='fa fa-arrow-down d-inline' style='font-size:21px;'></i>
            </a>


            </div>
        </div>

        <div class='col-10 col-lg-11 offset-lg-0' style='background-color:#fcfcfc;width:680px;'>
            <div>
                <p class='text-muted' style='margin:0px;margin-left:-10px;font-size:small;font-family:Aldrich, sans-serif;'>Posted By &nbsp;<strong>".$firstName." ".$lastName."</p>
            </div>
            <hr>

            <div style='font-family:'Roboto Slab', serif;'>
                <p class='text-left' style='margin-top:10px;font-size:26px;font-family:Amiko, sans-serif;'>".$row['question']."</p>
            </div>
            <div>
                <p class='text-left' style='font-size:small;margin-left:16px;margin-top:10px;font-family:Amiko, sans-serif;'>".$row['situation']."</p>
            </div>

            ";
            if ($row['postimg']) {
                echo " <div>
            <img class='img-fluid' src=".$row['postimg']." data-bs-hover-animate='pulse' id='image'>
            </div>";
            }

             if ($row['postvideo']) {
                echo "<div>
            <iframe width='560' height='315' allowfullscreen='' frameborder='0' src=".$row['postvideo']." id='video'>
            </iframe>
            </div>";
            }
            

            echo "
            
        </div>
    </div>";

}

/*
    END
*/
?>



<hr>
<div class="row">

    <div class="col-4"><h3>Share on Facebook</h3></div>
    <div class="col-4">
        <?php
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        ?>

        <br>

        <?php
        echo '<iframe src="https://www.facebook.com/plugins/share_button.php?href='.$actual_link.'&layout=button_count&size=large&mobile_iframe=true&width=83&height=28&appId" width="83" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>';
        ?>
    </div>
    <div class="col-4"></div>

</div>
<hr>
<div class="container">
    <form method="post" action="plan.php?id=<?php echo $id;?>">

      <textarea id="summernote" name="plan"></textarea>
      <br/>
      <input type="submit" name="submit" class="btn btn-primary" value="Share my Plan"></input>
      <input type="button" id="cancel" class="btn" value="Cancel"></input>
  </form>
</div>



<h1 class="container">Plans</h1>

<?php 

/*
    SHOWING LIST OF PLANS
*/

/*get the url of the post. The plan will be made for this post*/

$id = $_GET['id'];

/*Select all plans regarding this post*/
$result =NULL;
$sql = "SELECT * FROM plans WHERE plan_for='$id' ORDER BY votes DESC";
$result = mysqli_query($conn, $sql);

/*get id of user*/
$rowName =mysqli_fetch_assoc($result);
$planBy = $rowName['plan_by']; //id gained
/*get user name*/
$sql2 = "SELECT * FROM users WHERE id = '$planBy'";
$result2 = mysqli_query($conn, $sql2);
$row2 =mysqli_fetch_assoc($result2);
$firstName=$row2['first_name'];
$lastName=$row2['last_name'];

$sql = "SELECT * FROM plans WHERE plan_for='$id' ORDER BY votes DESC";
$result = mysqli_query($conn, $sql);




/*Show all plans*/
if(mysqli_num_rows($result) > 0) {

while($row = mysqli_fetch_assoc($result)) {

    $planBy = $row['plan_by']; //id gained
    /*get user name*/
    $sql2 = "SELECT * FROM users WHERE id = '$planBy'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 =mysqli_fetch_assoc($result2);
    $firstName=$row2['first_name'];
    $lastName=$row2['last_name'];
        
    echo "<div class='row' data-aos='zoom-in-up' data-aos-once='true' style='background-color:rgba(242,247,246,0.74);padding:0px;margin:45px;height:auto;width:auto;border:2px solid rgb(201,196,196);border-radius:4px;'><div class='col-2 col-md-1 offset-lg-0 d-inline d-flex flex-column justify-content-center' style='border-right:1px solid rgb(217,217,214);background-color:rgba(242,247,246,0.74);'>



        <div class='d-flex flex-column align-items-center'>
        <a class='options' id='";?><?php echo $row['id'];?><?php echo "' data-vote-type='1' style='cursor:pointer;'>
            <i class='fa fa-angle-up d-inline' style='width:16px;height:27px;font-size:26px;'> 
            </i>
        </a>

        <span id='total-votes-".$row['id']."'>".$row['votes']."</span>


        <a class='options' id='";?><?php echo $row['id'];?><?php echo "' data-vote-type='-1' style='cursor:pointer;'>
            <i class='fa fa-angle-down d-inline' style='font-size:26px;'>

            </i>
        </a>

    </div>



</div>

<div class='col-10 col-md-11 offset-lg-0' style='background-color:#f2f5f8;width:680px;'>
 <div>
    <p class='text-muted' style='margin:0px;margin-left:-10px;font-size:small;'>Posted By&nbsp;".$firstName." ".$lastName."</p>
</div>
<hr />

<div>
    <p class='text-left' style='font-size:small;margin-left:16px;margin-top:10px;font-family:Adamina, serif;'>".$row['plan']."</p>
</div>
</div></div>";

}      
}else{
    echo "No records";
}

/*
    END
*/

?>

<script type="text/javascript">
    $(document).ready(function() {

        $(".options").on("click", function(){

            var post_id = $(this).attr("id");
            var vote_type = $(this).data("vote-type");

            $.ajax({
                type : 'POST',
                url : 'voteplan.php',
                dataType:'JSON',

                data : {
                    post_id:post_id, 
                    vote_type:vote_type
                },

                success : function(response){
                    $("#total-votes-"+response.post_id).text(response.votes);

                }
            });
        });

    });
</script>

<!-- <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<link rel="stylesheet" type="text/css" href="assets/summernote/css/summernote-lite-flatly.css"> -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>

<script>
    $('#summernote').summernote({
        placeholder: 'Share your Idea ... ',
        tabsize: 2,
        height: 200,
        minHeight: 170,
        maxHeight: 400,
       // focus: false

   }); 
</script>
