
<?php
include("config/dbconnection.php");

$token = $_COOKIE['bp'];
$query = mysqli_query($conn, "SELECT * FROM login_tokens WHERE token = '$token'");
$row= mysqli_fetch_assoc($query);
$loggedinid = $row['user_id'];
$query = mysqli_query($conn, "SELECT  * FROM users WHERE id = '$loggedinid'");
$row = mysqli_fetch_assoc($query);


?>


<div class="container profile profile-view" id="profile">
    <div class="row">
        <div class="col-md-12 alert-col relative">
            <div role="alert" class="alert alert-info absolue center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
        </div>
    </div>
    <div class="caption v-middle text-center">
        <h1 class="cd-headline clip"><span class="blc">I&#39;m |</span><span class="cd-words-wrapper"><b class="is-visible">Designer.</b><b>Changer.</b><b>Creative.</b><b>Awesome.</b></span></h1>
    </div>
    <form action="profile.php" method="POST">
        <div class="form-row profile-row">
            <div class="col-md-4 relative">
                <div class="avatar">
                    <div class="avatar-bg center"></div>
                </div><input type="file" class="form-control" name="avatar-file" /></div>
                <div class="col-md-8">
                    <h1>Edit your Profile</h1>
                    <hr />
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Firstname</label><input type="text" class="form-control" name="firstname" value="<?php echo $row['first_name'];?>" /></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Lastname</label><input type="text" class="form-control" name="lastname" value="<?php echo $row['last_name'];?>" /></div>
                        </div>
                    </div>
                    <div class="form-group"><label>Username</label><input type="text" name="username" class="form-control" autocomplete="off" value="<?php echo $row['username'];?>" /></div>
                    <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" autocomplete="off" required name="email" value="<?php echo $row['email'];?>" /></div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Password</label><input type="password" class="form-control" name="password" autocomplete="off" required /></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Confirm Password</label><input type="password" class="form-control" name="confirmpassword" autocomplete="off" required /></div>
                        </div>
                    </div>
                    <hr />
                    <div class="form-row">
                        <div class="col-md-12 content-right"><input class="btn btn-primary" type="submit" name="submit" value="Save"></input>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php 
    include("config/dbconnection.php");

    if (isset($_POST['submit'])) {

        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $userName = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];

        /*selecting the mail if found in DB*/

        $query = mysqli_query($conn, "SELECT  email FROM users WHERE email = '$email'");
        

        if(mysqli_num_rows($query) > 0){

            /*get the already mail*/
            $row = mysqli_fetch_assoc($query);
            $dbemail = $row["email"];

            /*get the logged in mail*/
            $token = $_COOKIE['bp'];
            $query = mysqli_query($conn, "SELECT * FROM login_tokens WHERE token = '$token'");
            $row= mysqli_fetch_assoc($query);
            $id = $row['user_id'];

            $query = mysqli_query($conn, "SELECT  email FROM users WHERE id = '$id'");
            $row=$row= mysqli_fetch_assoc($query);
            $loggedinemail = $row['email'];


            /*if mail matches then accept only if */
            if($loggedinemail == $email)
            {
               /* $token = $_COOKIE['bp'];
                $query = mysqli_query($conn, "SELECT * FROM login_tokens WHERE token = '$token'");
                $row= mysqli_fetch_assoc($query);
                $id = $row['user_id'];

                $query = mysqli_query($conn, "SELECT  email FROM users WHERE id = '$id'");
                $logggeninemail = $row['email'];

                if ($alreadyemail == $loggedinemail) {
                    echo "<div class='alert alert-success alert-dismissible fade show'>

                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Email Already Exists &nbsp</strong>
                        </div>";
                }else{
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if (preg_match("/^[a-zA-Z ]*$/",$firstName)) {
                            if (preg_match("/^[a-zA-Z ]*$/",$lastName)) {
                                $token = $_COOKIE['bp'];
                                $query = mysqli_query($conn, "SELECT * FROM login_tokens WHERE token = '$token'");
                                $row= mysqli_fetch_assoc($query);
                                $id = $row['user_id'];

                                $sql = "UPDATE users SET first_name='$firstName', last_name ='$lastName',  password='$password', email='$email',username='$userName' WHERE id='$id' ";

                                $query = mysqli_query($conn, $sql);


                                if($query){


                                    echo "<div class='alert alert-success alert-dismissible fade show'>

                                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Profile Updated! &nbsp</strong>
                                </div>";
                            }else
                            {
                                die("Can't");
                            }

                        }
                    }
                }
            }

*/




        }else{

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if (preg_match("/^[a-zA-Z ]*$/",$firstName)) {
                            if (preg_match("/^[a-zA-Z ]*$/",$lastName)) {
                                $token = $_COOKIE['bp'];
                                $query = mysqli_query($conn, "SELECT * FROM login_tokens WHERE token = '$token'");
                                $row= mysqli_fetch_assoc($query);
                                $id = $row['user_id'];

                                $sql = "UPDATE users SET first_name='$firstName', last_name ='$lastName',  password='$password', email='$email',username='$userName' WHERE id='$id' ";

                                $query = mysqli_query($conn, $sql);


                                if($query){


                                    echo "<div class='alert alert-success alert-dismissible fade show'>

                                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Profile Updated! &nbsp</strong>
                                </div>";
                            }else
                            {
                                die("Can't");
                            }
                            
                        }
                    }
                }
    }


}




}


?>
