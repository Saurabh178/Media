<?php
include("connection.php");
include("classes/User.php");
include("classes/Post.php");

$limit = 5;                            //number of posts to display at a time
$post = new Post($con, $_REQUEST['userLoggedIn']);
$post->loadPosts();

?>