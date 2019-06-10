<?php
    include "header.php";
    include "includes/classes/User.php";
    include "includes/classes/Post.php";

    error_reporting(E_ERROR | E_PARSE);

    if(isset($_POST['post'])){
        $post = new Post($con, $userlogged);
        $post->submitPost($_POST['post_text'], 'none');
    }
?>
    
    <div class="user_details column">
        <a href="<?php echo $userlogged; ?>"><img src="<?php echo $user['profile_pic']; ?>"></a>
        <div class="user_details_left_right">
            <a href="<?php echo $userlogged; ?>">
                <?php
                    echo $user["first_name"] . " " . $user["last_name"];
                ?>
            </a>
            <br>

            <?php
                echo "Posts: " . $user["num_posts"] . "<br>";
                echo "Likes: " . $user["num_likes"];
            ?>
        </div>
    </div>

    <div class="main_column column">
        <form class="post_form" action="index.php" method="post">
            <textarea name="post_text" class="post_text" placeholder="What's in your mind?"></textarea>
            <input type="submit" name="post" id="post_button" value="Post">
            <hr>
            <br>
        </form>   
            
        <div class="posts_area">
            <?php
                $post = new Post($con, $userlogged);
                $post->loadPosts();
            ?>
        </div>
        <img id='loading' src="assets/images/background/load.gif">
        
        
    </div>
    
    <script>
        
        
    </script>
    
    </div>
</body>
</html>