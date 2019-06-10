<html>
<head>    
    <title></title>
    <link rel="stylesheet" type="text/css" href="include_css/style.css">
</head>
<body>
    
    <?php
        include "includes/connection.php";
        include "includes/classes/User.php";
        include "includes/classes/Post.php";

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
    
    <script>
        function toggle(){
            var element = document.getElementById('comment_section')
            if(element.style.display = 'block'){
                element.style.display = 'none';
            }
            else{
                element.style.display = 'block';
            }
        }
    </script>
    
    <?php
    //get id of post
    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
    }
    
    $user_sql = "SELECT added_by,user_to FROM posts WHERE id = '$post_id'";
    $user_query = mysqli_query($con, $user_sql);
    $user_rows = mysqli_fetch_array($user_query);
    $posted_to = $user_rows['added_by']
    
    ?>
    
    <form>
    
    </form>
    
</body>
</html>