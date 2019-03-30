<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form action="testing.php" method="post" enctype="multipart/form-data"> 
	<input type="file" name="image"></input>
	<input type="submit" name="submit"></input>
</form>

</body>
</html>
<?php

if (isset($_POST['submit'])) {
	if (isset($_FILES['image']['name'])) {
	echo "image";
	}
}

/*
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
            
            <div class='col-10 col-md-11 offset-lg-0' style='background-color:#f2f5f8;'>
                <div>
                    <p class='text-muted' style='margin:0px;margin-left:-10px;font-size:small;'>Posted By&nbsp;<strong>".$firstName." ".$lastName."</strong> </p>
                </div>
                
                <a href='plan.php?id=".$row['id']."' id='post_to_plan'>

                <div>
                    <p class='text-left' style='margin-top:10px;font-size:26px;font-family:Aclonica, sans-serif;'>".$row['question']."</p>
                </div>
                ";

                if ($row['postimg']) {
                    echo("<hr>
                        <div>
                    <img src=".$row['postimg']."  style='max-width:100%;max-height:100%;'></img>
                </div>");
                }
                if ($row['postvideo']) {
                    echo("<hr>
                        <iframe allowfullscreen style='display: block; width: 100%;height: 100%' frameborder='1' src=".$row['postvideo']." class='d-flex flex-row justify-content-center' ;'></iframe>");
                }
                
                echo "
                <div>
                    <p class='text-left' style='font-size:small;margin-left:16px;margin-top:10px;font-family:Adamina, serif;'>".$row['situation']."</p>
                </div>
                </a>

            </div>

            </a>
        </div>
        ";
*/