<?php
    
    //creating class user
    class User{
        private $user;
        private $con;
        
        public function __construct($con, $user){
            $this->con = $con;
            $sql = "SELECT * FROM users WHERE username = '$user'";
            $user_details = mysqli_query($con,$sql);
            $this->user = mysqli_fetch_array($user_details);   
        }
        
        public function getFirstAndLastName(){
            $username = $this->user['username'];
            $name_sql = "SELECT first_name, last_name FROM users WHERE username = '$username'";
            $query = mysqli_query($this->con, $name_sql);
            $row_name = mysqli_fetch_array($query);
            return $row_name['first_name'] . " " . $row_name['last_name'];
        }
        
        public function getUserName(){
            return $this->user['username'];
        }
        
        public function getCountPost(){
            $username = $this->user['username'];
            $count_post_sql = "SELECT num_posts FROM users WHERE username = '$username'";
            $query = mysqli_query($this->con, $count_post_sql);
            $row_post_count = mysqli_fetch_array($query);
            return $row_post_count['num_posts'];
        }
        
        public function isClosed(){
            $username = $this->user['username'];
            $closed_sql = "SELECT user_closed FROM users WHERE username = '$username'";
            $query = mysqli_query($this->con, $closed_sql);
            $user_closed_row = mysqli_fetch_array($query);
            
            if($user_closed_row['user_closed'] == 'yes')
                return true;
            else
                return false;
        }
        
        public function isFriend($username_to_check){
            $friend = ',' . $username_to_check . ',';
            if(strstr($this->user['friend_array'], $friend) || ($this->user['username'] == $friend)){
                return true;
            }
            else{
                return false;
            }
        }
        
    }

?>