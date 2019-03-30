<?php 
$sql = 'SELECT * FROM posts ORDER BY votes DESC';



/*Getting the post id for user*/
$result = mysqli_query($conn, $sql);



$i=0;
if(mysqli_num_rows($result) > 0) {

    /*if found any results then show some*/
    while($row = mysqli_fetch_assoc($result)) {

        /*Getting the post id for user*/


        $postbyid =$row['post_by'];


        /*Getting the names*/
        $sql = "SELECT * FROM users WHERE id='$postbyid'";
        $resultforuserid = mysqli_query($conn, $sql);
        $userarray= mysqli_fetch_assoc($resultforuserid);
        $firstName=$userarray['first_name'];
        $lastName=$userarray['last_name'];




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

            <a href='plan.php?id=".$row['id']."' id='post_to_plan'>
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
            </a>           
        </div>
    </div>";

    }
}


?>


        