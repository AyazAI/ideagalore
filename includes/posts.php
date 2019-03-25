<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<style type="text/css">
    a#post_to_plan{
            text-decoration: none;
            color: black; 
        }

        a#post_to_plan:hover{
            color:#1e501c;
        }

        a#post_to_plan:visited {
            color: #b7bbbf;
        }
</style>

<script type="text/javascript">
            $(document).ready(function() {
                $(".options").on("click", function(){

                var post_id = $(this).attr("id");

/*        post_id = post_id.replace(/\D/g,'');
*/              var vote_type = $(this).data("vote-type");

$.ajax({
    type : 'POST',
    url : 'vote.php',
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



        echo " <div class='row' data-aos='zoom-in-up' data-aos-once='true' style='background-color:rgba(242,247,246,0.74);padding:0px;margin:45px;height:auto;width:auto;border:2px solid rgb(201,196,196);border-radius:4px;'>

            <div class='col-2 col-md-1 offset-lg-0 d-inline d-flex flex-column justify-content-center' style='border-right:1px solid rgb(217,217,214);background-color:rgba(242,247,246,0.74);'>

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
                    <p class='text-muted' style='margin:0px;margin-left:-10px;font-size:small;'>Posted By&nbsp;<strong>".$firstName." ".$lastName."</strong> </p>
                </div>
                <hr />
                
                <a href='plan.php?id=".$row['id']."' id='post_to_plan'>

                <div>
                    <p class='text-left' style='margin-top:10px;font-size:26px;font-family:Aclonica, sans-serif;'>".$row['question']."</p>
                </div>
                <div>
                    <p class='text-left' style='font-size:small;margin-left:16px;margin-top:10px;font-family:Adamina, serif;'>".$row['situation']."</p>
                </div>
                </a>

            </div>

            </a>
        </div>
        ";

}
}



        ?>


        