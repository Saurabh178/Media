<?php
include "includes/connection.php";

if(isset($_SESSION['username'])){
    $userlogged = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username = '$userlogged'";
    $user_details = mysqli_query($con,$sql);
    $user = mysqli_fetch_array($user_details);
}
else{
    header("Location: register.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Book</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="include_css/style.css">
</head>

<body>
    
    <div class="top_bar">
        <div class="logo">
            <a href="index.php">Social Media <i class="fa fa-paper-plane"></i></a>
        </div>
        
        <nav>
            <a href="<?php echo $userlogged; ?>"><?php  echo $user['first_name']; ?></a>
            <a href="index.php"><i class="fas fa-home"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
            <a href="#"><i class="fas fa-users"></i></a>
            <a href="#"><i class="fas fa-bell"></i></a>
            <a href="#"><i class="fas fa-user-cog"></i></a>
            <a href="includes/logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </nav>
    
    </div>
    
    <div class="wrapper">