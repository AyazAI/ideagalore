<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BehtarPakistanOrignal</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/css/Animated-Type-Heading.css">
    <link rel="stylesheet" href="assets/css/Features-Boxed.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/header1.css">
    <link rel="stylesheet" href="assets/css/header2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Header.css">
    <link rel="stylesheet" href="assets/css/Pretty-Registration-Form.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form1.css">
    <link rel="stylesheet" href="assets/css/sticky-dark-top-nav-with-dropdown.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md custom-header">
        <div class="container-fluid"><a class="navbar-brand" href="#" style="color:rgb(241,238,238);">Idea<span><strong>Galore</strong></span></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav links">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="margin-right:14px;font-family:'Roboto Slab', serif;font-size:19px;">How it Works?</a></li>
                </ul>
                <form class="form-inline mx-auto" style="font-family:Roboto, sans-serif;"><input class="form-control" type="search" placeholder="Search for Posts ..." autofocus="" autocomplete="on" style="width:352px;"></form>
                <ul class="nav navbar-nav ml-auto">
                    <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="width:84px;height:35px;"> <img src="assets/img/avatar.jpg" class="dropdown-image" style="height:32px;margin:-1px;margin-top:-9px;"></a>
                        <div
                            class="dropdown-menu dropdown-menu-right" role="menu"><a class="dropdown-item" role="presentation" href="#">Settings </a><a class="dropdown-item" role="presentation" href="#">Payments </a><a class="dropdown-item" role="presentation" href="#">Logout </a></div>
        </li>
        </ul><button class="btn btn-success btn-sm" type="button" id="logout">Logout</button></div>
        </div>
    </nav>
    <div class="footer-basic">
        <div class="row register-form">
            <div class="col-md-8 offset-md-2">
                <form class="custom-form" action="createpost.php" method="POST">
                    <h1>Create Post</h1>
                    <div class="form-row form-group">
                        <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Problem</label></div>
                        <div class="col-sm-6 input-column"><input class="form-control" type="text" name="question"></div>
                    </div>
                    <div class="form-row form-group">
                        <div class="col-sm-4 label-column"><label class="col-form-label" for="email-input-field">Statement</label></div>
                        <div class="col-sm-6 input-column"><textarea class="form-control" rows="5" cols="10" wrap="hard" placeholder="Explain a bit" autofocus="" name="situation"></textarea></div>
                    </div><input class="btn btn-light submit-button" type="submit" value="Share" name="submit"></input></form>
            </div>
        </div>
        <footer>
            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
            <p class="copyright">Company Name © 2017</p>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
    <script src="assets/js/Animated-Type-Heading.js"></script>
    <script src="assets/js/bs-animation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src="assets/js/Profile-Edit-Form.js"></script>
</body>

</html>

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