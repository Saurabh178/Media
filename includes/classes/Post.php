<?php
    
    //creating class post
    class Post{
        private $user_object;
        private $con;
        public function __construct($con, $user){
            $this->con = $con;
            $this->user_object = new User($con, $user);   
        }
        
        public function submitPost($message_body, $user_to){
            $message_body = strip_tags($message_body);                                //removes any html tags
            $message_body = mysqli_real_escape_string($this->con, $message_body);   //escapes the single quotes
            $check_empty = preg_replace('/\s+/', '', $message_body);                 //removes all spaces
            
            if($check_empty != ''){
                
                //store date and time for posted message
                $date_posted = date("Y-m-d H:i:s");
                
                //get username for added_by
                $added_by = $this->user_object->getUserName();
                
                //when user is on his own profile
                if($user_to == $added_by){
                    $user_to = 'none';
                }
                
                //insert post
                $post_sql = "INSERT INTO posts VALUES ('','$message_body','$added_by','$user_to','$date_posted','no','no','0')";
                $post_query = mysqli_query($this->con, $post_sql);
                $returned_id = mysqli_insert_id($this->con);
                header('Location: index.php');                      //to avoid storing same value again and again
                
                //insert notification
                
                
                //update post count for user
                $posts_count = $this->user_object->getCountPost();
                $posts_count++;
                $update_sql = "UPDATE users SET num_posts = '$posts_count' WHERE username = '$added_by'";
                $update_post_count_query = mysqli_query($this->con, $update_sql);
                
            }
        }
        
        public function loadPosts(){
            $str = "";
            $load_post_sql = "SELECT * FROM posts WHERE deleted = 'no' ORDER BY id DESC";
            $load_post_query = mysqli_query($this->con, $load_post_sql);
            
            //load posts
            while($rows = mysqli_fetch_array($load_post_query)){
                $id = $rows['id'];
                $message_body = $rows['body'];
                $added_by = $rows['added_by'];
                $date_time = $rows['date_added'];
                
                if($rows['added_for'] == 'none'){
                    $user_to = '';
                }
                else{
                    $user_to_object = new User($this->con, $rows['added_for']);
                    $user_to_name = $user_to_object->getFirstAndLastName();
                    $user_to = "to <a href='" . $rows['added_for'] . "'>" . $user_to_name . "</a>";
                }
                
                //check if user who added post is active user or not
                $added_by_object = new User($this->con, $added_by);
                if($added_by_object->isClosed() == true){
                    continue;
                }
                
                $user_logged_object = new User($this->con, $this->user_object->getUserName());
                if($user_logged_object->isFriend($added_by)){
                
                    $user_details_sql = "SELECT first_name, last_name, profile_pic FROM users WHERE username = '$added_by'";
                    $user_details_query = mysqli_query($this->con, $user_details_sql);
                    $user_array_row = mysqli_fetch_array($user_details_query);

                    $first_name = $user_array_row['first_name'];
                    $last_name = $user_array_row['last_name'];
                    $profile_pic = $user_array_row['profile_pic'];

                    //get time and date for when post is posted
                    $date_time_now = date('Y-m-d H:i:s');
                    $start_date = new DateTime($date_time);     //date when posted
                    $end_date = new DateTime($date_time_now);   //current date
                    $interval = $start_date->diff($end_date);   //difference of dates


                    if($interval->y >= 1){
                        if($interval == 1){
                            $time_message = $interval->y . "year ago";
                        }
                        else{
                            $time_message = $interval->y . "years ago";
                        }
                    }
                    else if($interval->m >= 1)
                    {
                        if($interval->d == 0){
                            $days = "ago";
                        }
                        else if($interval->d == 1){
                            $days = $interval->d . " day ago";
                        }
                        else{
                            $days = $interval->d . " days ago";
                        }

                        if($interval->m == 1){
                            $time_message = $interval->m . " month" . $days;
                        }
                        else{
                            $time_message = $interval->m . " months" . $days;
                        }
                    }
                    else if($interval->d >= 1)
                    {
                        if($interval->d == 1){
                            $time_message = " Yesterday";
                        }
                        else{
                            $time_message = $interval->d . " days ago";
                        }
                    }
                    else if($interval->h >= 1)
                    {
                        if($interval->h == 1){
                            $time_message = $interval->h . " hour ago";
                        }
                        else{
                            $time_message = $interval->h . " hours ago";
                        }
                    }
                    else if($interval->i >= 1)
                    {
                        if($interval->i == 1){
                            $time_message = $interval->i . " minute ago";
                        }
                        else{
                            $time_message = $interval->i . " minutes ago";
                        }
                    }
                    else
                    {
                        if($interval->s < 15){
                            $time_message = "Just now";
                        }
                        else{
                            $time_message = $interval->s . " seconds ago";
                        }
                    }

                    $str .= "<div class='status_post'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='50'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC'>
                                    <a href='$added_by'>$first_name $last_name</a> $user_to &nbsp &nbsp &nbsp &nbsp $time_message
                                </div>

                                <div id='post_body'>
                                    $message_body 
                                </div>
                            </div>
                            <hr>";
                    
                }
            }           //ends while loop
            
            echo $str;
        }
        
    }

?>