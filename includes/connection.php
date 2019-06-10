<?php
session_start();
ob_start();
$con = mysqli_connect("localhost","root","","media");

if(mysqli_connect_errno()){
    echo "Failed to Connect " . mysqli_connect_errno();
}

?>