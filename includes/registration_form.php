<?php
error_reporting(E_ALL & ~E_NOTICE & E_WARNING);
error_reporting(E_ERROR | E_PARSE);

if(isset($_POST['register_button'])){
    
    $error_array = array();
    $username = "";
    //form values
    $fname = strip_tags($_POST['reg_fname']);          //removes html tags
    $fname = str_replace(' ','',$fname);               //removes spaces
    $fname = ucfirst(strtolower($fname));               //makes first letter as capital
    $_SESSION['reg_fname'] = $fname;                    //stores first name into session variable
    
    $lname = strip_tags($_POST['reg_lname']);
    $lname = str_replace(' ','',$lname);               //removes spaces
    $lname = ucfirst(strtolower($lname));
    $_SESSION['reg_lname'] = $lname;
    
    $email = strip_tags($_POST['reg_email']);
    $email = str_replace(' ','',$email);               //removes spaces
    $_SESSION['reg_email'] = $email;
    
    $password = strip_tags($_POST['reg_password']);
    $password2 = strip_tags($_POST['reg_password2']);
    
    $date = date("Y-m-d");                              //current date
    
    //check email vaild format
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email = filter_var($email,FILTER_VALIDATE_EMAIL);
        
        //check if email already exists
        $sql = "SELECT email FROM users WHERE email = '$email'";
        $email_check = mysqli_query($con,$sql);
        $num_rows = mysqli_num_rows($email_check);
        
        if($num_rows > 0){
            array_push($error_array,"Email is already in use!<br>");
        }
        
    }
    else{
        array_push($error_array,"Invalid Email Format!<br>");
    }
    
    if(strlen($fname) > 20 || strlen($fname) < 3){
        array_push($error_array,"First Name should be between 3 to 20 characters!<br>");
    }
    if(strlen($lname) > 20 || strlen($lname) < 3){
        array_push($error_array,"Last Name should be between 3 to 20 characters!<br>");
    }
    
    if($password != $password2){
        array_push($error_array,"Password didn't match, Please re-enter Password!<br>");
    }
    else{
        if(preg_match('/[^A-Za-z0-9]/',$password)){
            array_push($error_array,"Password should contain only aplhabet and numbers!<br>");
        }
    }
    if(strlen($password) < 6){
        array_push($error_array,"Password too Short!<br>");
    }
    
    if(empty($error_array)){
        $password = md5($password);                                //encrypted password before storing to database
        $username = strtolower($fname . "_" . $lname);              //generates username
        
        //check if any user exits with same username, if exits add number to its username
        $sql = "SELECT username FROM users WHERE username = '$username'";
        $username_check = mysqli_query($con,$sql);
        
        $i = 0;
        while(mysqli_num_rows($username_check) != 0){
            $i = $i+1;
            $username = $username . "_" . $i;
            $sql = "SELECT username FROM users WHERE username = '$username'";           //check again 
            $username_check = mysqli_query($con,$sql);
        }
         //profile picture
        $profile_pic = "assets/images/profile/default/pic1.png";
        $sql = "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')";
        $query = mysqli_query($con,$sql);
        array_push($error_array,"<span style = 'color: #FF0000;'> All Set, Go Ahead and Login! </span><br>");

    }
    
    //clear session
    $_SESSION['reg_fname'] = "";
    $_SESSION['reg_lname'] = "";
    $_SESSION['reg_email'] = "";
    
}

?>