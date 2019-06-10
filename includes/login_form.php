<?php

if(isset($_POST["login_button"])){
    $error_array_login = array();
    $email = filter_var($_POST["login_email"],FILTER_SANITIZE_EMAIL);
    $_SESSION["login_email"] = $email;
    $password = md5($_POST["login_password"]);
    
    //check database
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $check_database = mysqli_query($con,$sql);
    $check_login = mysqli_num_rows($check_database);
    
    if($check_login == 1){
        $row = mysqli_fetch_array($check_database);
        $username = $row['username'];
        
        //check if account is closed
        $sql = "SELECT * FROM users WHERE email = '$email' AND user_closed = 'yes'";
        $check_closed = mysqli_query($con,$sql);
        if(mysqli_num_rows($check_closed) == 1){
            $sql_open = "UPDATE users SET user_closed = 'no' WHERE email = '$email'";
            $reopen = mysqli_query($con,$sql_open);
            
        }
        
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit(); 
    }
    else
    {
        array_push($error_array_login, "Email or Password was Incorrect!<br>");
    }
}


?>