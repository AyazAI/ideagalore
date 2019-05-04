<?php
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
