<?php
session_start();
require("../config/dbconnection.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['login'])) { // Login process
    $useremail = $_POST['email'];
    $userpassword = $_POST['password'];
    $passwordfromdb= mysqli_query($conn, "SELECT password FROM users WHERE email = '$useremail'");
    $passwordresult= mysqli_fetch_assoc($passwordfromdb);
    $verify = password_verify($userpassword,$passwordresult['password']);

    
    if($verify){

        $cstrong = True;
        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

        $query = mysqli_query($conn, "SELECT id FROM users WHERE email = '$useremail'");
        
        $row= mysqli_fetch_assoc($query);
        $id = $row['id'];
        $token = sha1($token);

        if(mysqli_query($conn, "INSERT INTO login_tokens(token, user_id) VALUES ('$token','$id')")){
            setcookie("bp", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
        }

        // $_SESSION['user_name'] = $row['user_firstname'] . " " . $row['user_lastname'];
        
        header("Location: ../index.php");
        }
        else 
        {
        echo("Invalid Cred");
        //header("location:some.php");
    }
 }
}
?>

<!-- 
<form method="post" action="login.php">
            <label>Email</label><br>
                <input type="text" name="email" id="useremail">
                <div class="required"></div>
                <br>
                    <label>Password</label><br>
                    <input type="password" name="password" id="userpassword">
                    <div class="required"></div>
                    <br><br>
                <input type="submit" value="Login" name="login">
</form>  -->