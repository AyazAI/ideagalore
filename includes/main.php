
<?php  

include('config/dbconnection.php'); 

if(isset($_POST['submit'])) {
    $question = $_POST['question'];
    $situation = $_POST['situation'];
    $date = date("Y-m-d H:i:s");
    
    $token = $_COOKIE['bp'];
    $query = mysqli_query($conn, "SELECT * FROM login_tokens WHERE token = '$token'");
    $row= mysqli_fetch_assoc($query);
    $id = $row['user_id'];

    $sql = "INSERT INTO posts (question, situation, post_time,post_by) VALUES ('$question', '$situation', '$date','$id')";


    if (!$conn) {
        die("not");
    }
    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success'>
        <strong>Your Post have been shared!</strong>
    </div>";
}else{
    echo "<div class='alert alert-danger'>
    <strong>Please Enter Data Correctly!</strong>
    ".mysqli_error($conn)."</div>";
}


}




function isLoggedIn()

{
    include('config/dbconnection.php'); 

    if (isset($_COOKIE['bp'])) {
        $token = $_COOKIE['bp'];

        $query = mysqli_query($conn, "SELECT user_id FROM login_tokens WHERE token = '$token'");

        if ($query) {

            $row= mysqli_fetch_assoc($query);
            $id = $row['user_id'];

            if (isset($_COOKIE['bp__'])) {
                return $id;
            }else{

                $cstrong = True;
                $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

                mysqli_query($conn, "INSERT INTO login_tokens(token, user_id) VALUES ('$token','$id')");


                $cook = $_COOKIE['bp'];
                mysqli_query($conn, "DELETE FROM login_tokens WHERE token='$cook'");
                

                setcookie('bp', $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                setcookie('bp__',1 , time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

                return $id;

            }
            
            
        }
        
    }
    return False;
}

if (isLoggedIn()) {

    $token = $_COOKIE['bp'];
    $query = mysqli_query($conn, "SELECT * FROM login_tokens WHERE token = '$token'");
    $row= mysqli_fetch_assoc($query);
    $id = $row['user_id'];

    /*We have to logged in user id*/

    /*We have to get the name of the user*/

    /*$query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
    $names= mysqli_fetch_assoc($query);
    $firstName=$names['first_name'];
    $lastName=$names['last_name'];*/

}else{
    header('Location: IN/in.php');

}




?>

<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 data-aos="fade-down-left" data-aos-once="true">Add Value to Community</h1>
                    <p>Everything comes with courage. Just support your community</p>
                    <div class="modal fade" role="dialog" tabindex="-1" id="post">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            
                            <form action="index.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Create Your Post</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                <div class="modal-body">
                                    <!-- <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle float-none" data-toggle="dropdown" aria-expanded="false" type="button">Select Category</button>
                                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#">First Item</a><a class="dropdown-item" role="presentation" href="#">Second Item</a><a class="dropdown-item" role="presentation" href="#">Third Item</a></div>
                                    </div> -->
                                    
                                    <h1>Question</h1><input class="form-control-lg" type="text" placeholder="Write general statement" style="width:401px;height:49px;" name="question">
                                    <hr>
                                    <h1>Situation</h1>
                                    <textarea class="form-control-lg" style="width:401px;height:131px;" placeholder="Explain it a bit!" name="situation">
                                    </textarea>


                                    <hr>
                                </div>
                                <div class="modal-footer">
                                <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                                
                                <input class="btn btn-primary" value="Share" type="submit" name="submit"></input>

                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <p>
                    <button class="btn btn-success" id="createpost" data-aos="fade-right" data-aos-delay="100" data-aos-once="true">Create your Post</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h1>Current Targets</h1>
            </div>
        </div>
    </div>

