<?php
include "includes/connection.php";
include "includes/registration_form.php";
include "includes/login_form.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to My Book</title>
    <link rel="stylesheet" type="text/css" href="include_css/style_register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="includes/register.js"></script>
</head>
    
<body>
    
    <?php 
        if($_POST["register_button"]){
            echo '<script>
                    $(document).ready(function(){
                        $("#first_form").hide();
                        $("#second_form").show();
                    });
                    </script>';
        }
    ?>
    <div class="wrapper">
        <div class="login_box">
            <div class="login_head">
                <h2>Social Media!</h2>
                Login or Register here.
            </div>
            
            <div id="first_form">
                <form method="post" action="register.php">
                    <input type="email" name="login_email" placeholder="Email Address" value="<?php if(isset($_SESSION['login_email'])){ echo $_SESSION['login_email']; }?>" required>
                    <br> 
                    <input type="password" name="login_password" placeholder="Password" required>
                    <br>
                    <input type="submit" name="login_button" value="Login">
                    <br>
                    <?php if(in_array("Email or Password was Incorrect!<br>",$error_array_login))  echo "Email or Password was Incorrect!<br>"; ?>
                    <a href="#" id="signup" class="signup">Don't have an account, Click here to Register!</a>

                </form>
            </div>
            
            <br>
            
            <div id="second_form">
                <form action="register.php" method="post">
                    <input type="text" name="reg_fname" placeholder="First Name" value="<?php if(isset($_SESSION['reg_fname'])){ echo $_SESSION['reg_fname']; }?>" required>
                    <br>
                    <?php if(in_array("First Name should be between 3 to 20 characters!<br>",$error_array))  echo "First Name should be between 3 to 20 characters!<br>"; ?>

                    <input type="text" name="reg_lname" placeholder="Last Name" value="<?php if(isset($_SESSION['reg_lname'])){ echo $_SESSION['reg_lname']; }?>" required>
                    <br>
                    <?php if(in_array("Last Name should be between 3 to 20 characters!<br>",$error_array))  echo "Last Name should be between 3 to 20 characters!<br>"; ?>

                    <input type="email" name="reg_email" placeholder="Email" value="<?php if(isset($_SESSION['reg_email'])){ echo $_SESSION['reg_email']; }?>" required>
                    <br>
                    <?php if(in_array("Email is already in use!<br>",$error_array))  echo "Email is already in use!<br>";
                    else if(in_array("Invalid Email Format!<br>",$error_array))  echo "Invalid Email Format!<br>"; ?>

                    <input type="password" name="reg_password" placeholder="Password" required>
                    <br>
                    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
                    <br>
                    <?php if(in_array("Password should contain only aplhabet and numbers!<br>",$error_array))  echo "Password should contain only aplhabet and numbers!<br>";
                    else if(in_array("Password too Short!<br>",$error_array))  echo "Password too Short!<br>";
                    else if(in_array("Password didn't match, Please re-enter Password!<br>",$error_array))  echo "Password didn't match, Please re-enter Password!<br>"; ?>

                    <input type="submit" name="register_button" value="Register">
                    <br>
                    <?php if(in_array("<span style = 'color: #FF0000;'> All Set, Go Ahead and Login! </span><br>",$error_array))  echo "<span style = 'color: #FF0000;'> All Set, Go Ahead and Login! </span><br>"; ?>
                    <a href="#" id="signin" class="signin">Already have an account, Sign in here!</a>

                </form>
            </div>

        </div>
    </div>
</body>
</html>