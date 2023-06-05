<?php

    require_once 'config.php'; 
    $db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("database is not connected");

    //function for showing pages
    function showPage($page, $data=""){
        include("assets/pages/$page.php");
    }

    //function for show prevformdata
    function showFormData($field){
        if(isset($_SESSION['formdata'])){
            $formdata =$_SESSION['formdata'];
            return $formdata[$field];
        }
    
    }

    //function for show errors
    function showError($field){
        if(isset($_SESSION['error'])){
            $error =$_SESSION['error'];
            if(isset($error['field']) && $field==$error['field']){
            ?>
        <div class="alert alert-danger my-1" role="alert">
        <?=$error['msg']?>
        </div>
            <?php
            }
        }
        }

    //for checking duplicate email
    function isEmailRegistered($email){
        global $db;
        $query="SELECT count(*) as row FROM users WHERE email='$email'";
        $run=mysqli_query($db,$query);
        $return_data = mysqli_fetch_assoc($run);
        return $return_data['row'];
    }

    //for checking duplicate username
    function isUsernameRegistered($username){
        global $db;
        $query="SELECT count(*) as row FROM users WHERE username='$username'";
        $run=mysqli_query($db,$query);
        $return_data = mysqli_fetch_assoc($run);
        return $return_data['row'];
    }

    //for validating the signup form
    function validateSignupForm($form_data){
        $response=array();
        $response['status']=true;

        if($form_data['cc']!='on'){
            $response['msg']="Please accept terms and conditions";
            $response['status']=false;
            $response['field']='cc';
        }

        if(!$form_data['skill']){
            $response['msg']="Please mention your key skill";
            $response['status']=false;
            $response['field']='skill';
        }

        if($form_data['repeat_password'] != $form_data['reg_password']){
            $response['msg']="password does not match";
            $response['status']=false;
            $response['field']='repeat_password';
        }
    
        if(!$form_data['reg_password']){
            $response['msg']="password is not given";
            $response['status']=false;
            $response['field']='reg_password';
        }
    
        if($form_data['reg_gender']=='gender'){
            $response['msg']="Please select a gender";
            $response['status']=false;
            $response['field']='reg_gender';
        }
        
        if(!$form_data['reg_email']){
            $response['msg']="email is not given";
            $response['status']=false;
            $response['field']='reg_email';
        }
        
        if(!$form_data['lname']){
            $response['msg']="last name is not given";
            $response['status']=false;
            $response['field']='lname';
        }
        if(!$form_data['fname']){
            $response['msg']="first name is not given";
            $response['status']=false;
            $response['field']='fname';
        }
        if(isEmailRegistered($form_data['reg_email'])){
            $response['msg']="email id is already registered";
            $response['status']=false;
            $response['field']='reg_email';
        }
        
    
        return $response;
    
    }

    //for validate the login form
    function validateSignInForm($form_data){
        $response=array();
        $response['status']=true;
        $blank=false;
      
        if(!$form_data['log_password']){
            $response['msg']="password is not given";
            $response['status']=false;
            $response['field']='log_password';
            $blank=true;
        }
       
        if(!$form_data['log_username']){
            $response['msg']="username/email is not given";
            $response['status']=false;
            $response['field']='log_username';
            $blank=true;
        }

        if(!$blank && !checkUser($form_data)['status'] ){
            $response['msg']="Incorrect username or password.";
            $response['status']=false;
            $response['field']='checkuser';
        }else{
            $response['user']=checkUser($form_data)['user'];
        }
           
        return $response;
    
    }

    //for checking the user
    function checkUser($login_data){
    global $db;
    $username_email = $login_data['log_username'];
    $password=md5($login_data['log_password']);
    $query = "SELECT * FROM users WHERE (email='$username_email' || username='$username_email') && password='$password'";
    $run = mysqli_query($db,$query);
    $data['user'] = mysqli_fetch_assoc($run)??array();
    if(count($data['user'])>0){
        $data['status']=true;
    }else{
        $data['status']=false;

    }

    return $data;
    }

    //for checking the cookie login
    function checkCookieLogin($login_id,$login_password){
        global $db;
        $username_id = $login_id;
        $password=$login_password;
        $query = "SELECT * FROM users WHERE id='$username_id' && password='$password'";
        $run = mysqli_query($db,$query);
        $data['user'] = mysqli_fetch_assoc($run)??array();
        if(count($data['user'])>0){
            $data['status']=true;
        }else{
            $data['status']=false;
    
        }
    
        return $data;
    }

    //User login Cookie Verification
    function cookieLoginVerification($user_id,$password){
        
        if(checkCookieLogin($user_id,$password)['status']){
            echo $user_id;
            $response['user'] = checkCookieLogin($user_id,$password)['user'];
            $_SESSION['Auth'] = true;
            $_SESSION['userdata'] = $response['user'];
            if($response['user']['ac_status']==0){
                $_SESSION['code']=$code = rand(111111,999999);
                sendCode($response['user']['email'],'Verify Your Email',$code);
            }
            header("location:./");
        }
    }

    //for getting userdata by id
    function getUser($user_id){
    global $db;
    $query = "SELECT * FROM users WHERE id=$user_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run);

    }

    //for creating new user
    function createUser($data){
        global $db;
        $first_name = mysqli_real_escape_string($db,$data['fname']);
        $last_name = mysqli_real_escape_string($db,$data['lname']);
        $gender = $data['reg_gender'];
        $email = mysqli_real_escape_string($db,$data['reg_email']);
        $username = strtolower($first_name."_".$last_name);
        if($gender=='female'){
            $profile_pic='default-female.jpg';
        }else{
            $profile_pic='default-male.jpg';
        }
        $i=0;
        while(isUsernameRegistered($username)){
            $i++;
            $username=$username."_".$i;
            isUsernameRegistered($username);
        }
        $password = mysqli_real_escape_string($db,$data['reg_password']);
        $password = md5($password);
        $key_skill = mysqli_real_escape_string($db,$data['skill']);
        $query = "INSERT INTO users(first_name,last_name,email,username,gender,password,profile_pic,key_skill) ";
        $query.="VALUES ('$first_name','$last_name','$email','$username','$gender','$password','$profile_pic','$key_skill')"; 
        return mysqli_query($db,$query);
    }

    //for verify email
    function verifyEmail($email){
        global $db;
        $query="UPDATE users SET ac_status=1 WHERE email='$email'";
        return mysqli_query($db,$query);
    }

    //function for reset password
    function resetPassword($email,$password){
        global $db;
        $password=md5($password);
        $query="UPDATE users SET password='$password' WHERE email='$email'";
        return mysqli_query($db,$query);
    }

    //to check the old password
    function checkpassword($email,$oldpassword){
        global $db;
        $password=md5($oldpassword);
        $query = "SELECT count(*) as row FROM users WHERE email='$email' && password='$password'";
        $run = mysqli_query($db,$query);
        $return_data = mysqli_fetch_assoc($run);
        return $return_data['row'];
    }

    //function for Update About Info
    function updateInfo($email,$fname,$lname,$skill,$github,$linkedin){
        global $db;
        $query="UPDATE users SET first_name='$fname',last_name='$lname',key_skill='$skill',github='$github',linkedin='$linkedin' WHERE email='$email'";
        return mysqli_query($db,$query);
    }

    //function for deactivating account
    function deactivateAccount($email){
        global $db;
        $query="UPDATE users SET ac_status=2 WHERE email='$email'";
        return mysqli_query($db,$query);
    }

    //function for validating Profile pic
    function validatePicForm($image_data){
        $response=array();
        $response['status']=true;

        if($image_data['name']){
            $image = basename($image_data['name']);
            $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
            $size = $image_data['size']/1000;
 
            if($type!='jpg' && $type!='jpeg' && $type!='png'){
             $response['msg']="only jpg,jpeg,png images are allowed";
             $response['status']=false;
             $response['field']='profile_pic';
            }
 
         if($size>5000){
             $response['msg']="upload image less then 5 mb";
             $response['status']=false;
             $response['field']='profile_pic';
            }
        }
        return $response;
    }

    //function for updating profile pic
    function updateProfilePic($email,$imagedata){
        global $db;
        $profile_pic="";
        if($imagedata['name']){
            $image_name = time().basename($imagedata['name']);
            $image_dir="../../images/profile_pic/$image_name";
            move_uploaded_file($imagedata['tmp_name'],$image_dir);
            $profile_pic="profile_pic='$image_name'";
        }
        $query = "UPDATE users SET $profile_pic WHERE email='$email'";
        return mysqli_query($db,$query);
    }

    //for validating post media
    function validatePostImage($image_data){
        $response=array();
        $response['status']=true;
          
    
        if(!$image_data['name']){
            $response['msg']="no media is selected";
            $response['status']=false;
            $response['field']='post_img';
        }
            
       
        
        if($image_data['name']){
            $image = basename($image_data['name']);
            $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
            $size = $image_data['size']/1000;

            if($type!='jpg' && $type!='jpeg' && $type!='png' && $type!='gif' && $type!='mp4' && $type!='wmv' && $type!='mkv' && $type!='webm' && $type!='ogg' ){
            $response['msg']="Invalid file format";
            $response['status']=false;
            $response['field']='post_img';
        }

        if($size>20000){
            $response['msg']="upload media less then 10 mb";
            $response['status']=false;
            $response['field']='post_img';
        }
        }

        return $response;
        
    }

    //for add new media post
    function createPost($text,$image,$media_type){
        global $db;
        $post_text = mysqli_real_escape_string($db,$text['img_caption']);
        $user_id = $_SESSION['userdata']['id'];
    
        if(!$image['name']){
            $image_name="null";
        }else{
            $image_name = time().basename($image['name']);
            $image_dir="../../images/posts/$image_name";
            move_uploaded_file($image['tmp_name'],$image_dir);
        }
    
        $query = "INSERT INTO posts(user_id,post_text,post_media,media_type)";
        $query.="VALUES ($user_id,'$post_text','$image_name','$media_type')"; 
        return mysqli_query($db,$query);
    }

    //for update status
    function createStatus($text){
        global $db;
        $post_text = mysqli_real_escape_string($db,$text['description']);
        $user_id = $_SESSION['userdata']['id'];
        $image_name="null";
        $query = "INSERT INTO posts(user_id,post_text,post_media)";
        $query.="VALUES ($user_id,'$post_text','$image_name')"; 
        return mysqli_query($db,$query);
    }

    //for getting posts
    function getPost(){
        global $db;
        $query = "SELECT users.id as uid,posts.id,posts.user_id,posts.post_media,posts.post_text,posts.created_at,posts.media_type,users.first_name,users.last_name,users.username,users.profile_pic,users.key_skill,users.country FROM posts JOIN users ON users.id=posts.user_id ORDER BY id DESC";

        $run = mysqli_query($db,$query);
        return mysqli_fetch_all($run,true);

    }

    //for getting userdata by username
    function getUserByUsername($username){
        global $db;
        $query = "SELECT * FROM users WHERE username='$username'";
        $run = mysqli_query($db,$query);
        return mysqli_fetch_assoc($run);
    }

    //for getting posts by id
    function getPostById($user_id){
        global $db;
        $query = "SELECT * FROM posts WHERE user_id=$user_id ORDER BY id DESC";
        $run = mysqli_query($db,$query);
        return mysqli_fetch_all($run,true);
    }

    //for getting users for follow suggestions
    function getFollowSuggestions(){
        global $db;
        $current_user = $_SESSION['userdata']['id'];
        $query = "SELECT * FROM users WHERE id!=$current_user && ac_status=1";
        $run = mysqli_query($db,$query);
        return mysqli_fetch_all($run,true);
    }

    //for filtering the suggestion list
    function filterFollowSuggestion(){
        $list = getFollowSuggestions();
        $filter_list  = array();
        foreach($list as $user){
            if(!checkFollowStatus($user['id']) && count($filter_list)<8){
            $filter_list[]=$user;
            }
        }
        return $filter_list;
    }

    //for checking the user is followed by current user or not
    function checkFollowStatus($user_id){
        global $db;
        $current_user = $_SESSION['userdata']['id'];
        $query="SELECT count(*) as row FROM follow_list WHERE follower_id=$current_user && user_id=$user_id";
        $run = mysqli_query($db,$query);
        return mysqli_fetch_assoc($run)['row'];
    }

    //function for follow the user
    function followUser($user_id){
        global $db;
        $current_user=$_SESSION['userdata']['id'];
        $query="INSERT INTO follow_list(follower_id,user_id) VALUES($current_user,$user_id)";
        return mysqli_query($db,$query);
    }

    //for getting posts dynamically
    function filterPosts(){
        $list = getPost();
        $filter_list  = array();
        foreach($list as $post){
            if(checkFollowStatus($post['user_id']) || $post['user_id']==$_SESSION['userdata']['id']){
            $filter_list[]=$post;
            }
        }
        
        return $filter_list;
    }

    //get followers count
    function getFollowers($user_id){
        global $db;
        $query = "SELECT users.id as uid,follow_list.id,follow_list.user_id,follow_list.follower_id,users.first_name,users.last_name,users.username,users.profile_pic,users.key_skill,users.country FROM follow_list JOIN users ON users.id=follow_list.follower_id where follow_list.user_id=$user_id";
        $run = mysqli_query($db,$query);
        return mysqli_fetch_all($run,true);
    }

    //get followers count
    function getFollowing($user_id){
        global $db;
        $query = "SELECT users.id as uid,follow_list.id,follow_list.user_id,follow_list.follower_id,users.first_name,users.last_name,users.username,users.profile_pic,users.key_skill,users.country FROM follow_list JOIN users ON users.id=follow_list.user_id where follow_list.follower_id=$user_id";
        $run = mysqli_query($db,$query);
        return mysqli_fetch_all($run,true);
    }

    //Unfollow User
    function unfollowUser($user_id){
        global $db;
        $current_user=$_SESSION['userdata']['id'];
        $query="DELETE FROM follow_list WHERE follower_id=$current_user && user_id=$user_id";
        return mysqli_query($db,$query);   
    }

    //function for like the post
    function like($post_id){
        global $db;
        $current_user=$_SESSION['userdata']['id'];
        $query="INSERT INTO likes(post_id,user_id) VALUES($post_id,$current_user)";
        $poster_id = getPosterId($post_id);
   
        if($poster_id!=$current_user){
            createNotification($current_user,$poster_id,"liked your post !",$post_id);
        }
        return mysqli_query($db,$query);
    }

    //function checkLikeStatus
    function checkLikeStatus($post_id){
        global $db;
        $current_user = $_SESSION['userdata']['id'];
        $query="SELECT count(*) as row FROM likes WHERE user_id=$current_user && post_id=$post_id";
        $run = mysqli_query($db,$query);
        return mysqli_fetch_assoc($run)['row'];
    }

    //function for unlike the post
    function unlike($post_id){
        global $db;
        $current_user=$_SESSION['userdata']['id'];
        $query="DELETE FROM likes WHERE user_id=$current_user && post_id=$post_id";
        return mysqli_query($db,$query);
    }

    //function for getting likes count
    function getLikes($post_id){
        global $db;
        $query="SELECT * FROM likes WHERE post_id=$post_id";
        $run = mysqli_query($db,$query);
        return mysqli_fetch_all($run,true);
    }

    //time ago function
    function timeago($date) {
        date_default_timezone_set('Asia/Calcutta');
        $time = strtotime($date);	
        $time_difference = time() - $time;

    if( $time_difference < 60 ) { return 'just now'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'm',
                24 * 60 * 60            =>  'd',
                60 * 60                 =>  'h',
                60                      =>  'min',
                1                       =>  'sec'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return $t . ' ' . $str;
        }
    }
    }
     
     //add-comment function
     function addComment($post_id,$comment){
        global $db;
        $comment = mysqli_real_escape_string($db,$comment);
    
        $current_user=$_SESSION['userdata']['id'];
        $query="INSERT INTO comments(user_id,post_id,comment,replies) VALUES($current_user,$post_id,'$comment',0)";
        $poster_id = getPosterId($post_id);
    
        if($poster_id!=$current_user){
            createNotification($current_user,$poster_id,"commented on your post",$post_id);
        }
       
    
        return mysqli_query($db,$query);
        
    }

    //getting poster id
    function getPosterId($post_id){
        global $db;
        $query = "SELECT user_id FROM posts WHERE id=$post_id";
        $run = mysqli_query($db,$query);
        return mysqli_fetch_assoc($run)['user_id'];

    }

    //function for getting comments count
    function getComments($post_id){
        global $db;
        $query="SELECT * FROM comments WHERE post_id=$post_id ORDER BY id DESC";
        $run = mysqli_query($db,$query);
        return mysqli_fetch_all($run,true);
    }
    
    //function for creating notifications
    function createNotification($from_user_id,$to_user_id,$msg,$post_id=0){
        global $db;
        $query="INSERT INTO notifications(from_user_id,to_user_id,message,post_id) VALUES($from_user_id,$to_user_id,'$msg',$post_id)";
        mysqli_query($db,$query);    
    }

    //Get notifications
    function getNotifications(){
        $cu_user_id = $_SESSION['userdata']['id'];
      
          global $db;
          $query="SELECT * FROM notifications WHERE to_user_id=$cu_user_id ORDER BY id DESC";
          $run = mysqli_query($db,$query);
          return mysqli_fetch_all($run,true);
      }

    //Unread notification count
    function getUnreadNotificationsCount(){
    $cu_user_id = $_SESSION['userdata']['id'];
    
        global $db;
        $query="SELECT count(*) as row FROM notifications WHERE to_user_id=$cu_user_id && read_status=0 ORDER BY id DESC";
        $run = mysqli_query($db,$query);
        if($run){
            return mysqli_fetch_assoc($run)['row'];
        }
        return 0;
    }

    //Get Unread Notifications
    function getUnreadNotifications(){
        $cu_user_id = $_SESSION['userdata']['id'];
        
            global $db;
            $query="SELECT * FROM notifications WHERE to_user_id=$cu_user_id && read_status=0 ORDER BY id DESC";
            $run = mysqli_query($db,$query);
            return mysqli_fetch_all($run,true);
        }

    //Setting notification status to read
    function setNotificationStatusAsRead(){
        $cu_user_id = $_SESSION['userdata']['id'];
        global $db;
        $query="UPDATE notifications SET read_status=1 WHERE to_user_id=$cu_user_id";
        return mysqli_query($db,$query);
    }

    //SearchUser
    function searchUser($keyword){
        global $db;
        $query = "SELECT * FROM users WHERE username LIKE '%".$keyword."%' || (first_name LIKE '%".$keyword."%' || last_name LIKE '%".$keyword."%') LIMIT 5";
        $run = mysqli_query($db,$query);
        return mysqli_fetch_all($run,true);
    
    }

    //send message
    function sendMessage($user_id,$msg){
        global $db;
        $message = mysqli_real_escape_string($db,$msg);
        $current_user_id = $_SESSION['userdata']['id'];
        $query = "INSERT INTO messages (from_user_id,to_user_id,msg) VALUES($current_user_id,$user_id,'$message')";
        return mysqli_query($db,$query);
    
    }

    //get messages
    function getMessages($user_id){
        global $db;
        $current_user_id = $_SESSION['userdata']['id'];
        $query = "SELECT * FROM messages WHERE (to_user_id=$current_user_id && from_user_id=$user_id) || (from_user_id=$current_user_id && to_user_id=$user_id) ORDER BY id DESC";
        $run = mysqli_query($db,$query);
        return  mysqli_fetch_all($run,true);
    }

    //new msg count
    function newMsgCount(){
        global $db;
        $current_user_id = $_SESSION['userdata']['id'];
        $query="SELECT COUNT(*) as row FROM messages WHERE to_user_id=$current_user_id && read_status=0";
        $run=mysqli_query($db,$query);
        return mysqli_fetch_assoc($run)['row'];
    }

    //msg read status
    function updateMessageReadStatus($user_id){
        $cu_user_id = $_SESSION['userdata']['id'];
        global $db;
        $query="UPDATE messages SET read_status=1 WHERE to_user_id=$cu_user_id && from_user_id=$user_id";
        return mysqli_query($db,$query);
    }

    function gettime($date){
        return date('H:i - (F jS, Y )', strtotime($date));
    }
    
    //get all messages
    function getAllMessages(){
        $active_chat_ids = getActiveChatUserIds();
        $conversation=array();
        foreach($active_chat_ids as $index=>$id){
            $conversation[$index]['user_id'] = $id;
            $conversation[$index]['messages'] = getMessages($id);
        }
        return $conversation;
    }

    //for getting ids of chat users
    function getActiveChatUserIds(){
        global $db;
        $current_user_id = $_SESSION['userdata']['id'];
        $query = "SELECT from_user_id,to_user_id FROM messages WHERE to_user_id=$current_user_id || from_user_id=$current_user_id ORDER BY id DESC";
        $run = mysqli_query($db,$query);
        $data =  mysqli_fetch_all($run,true);
        $ids=array();
        foreach($data as $ch){
        if($ch['from_user_id']!=$current_user_id && !in_array($ch['from_user_id'],$ids)){
        $ids[]=$ch['from_user_id'];
        }

        if($ch['to_user_id']!=$current_user_id && !in_array($ch['to_user_id'],$ids)){
            $ids[]=$ch['to_user_id'];
        }

        }

        return $ids;
    }

    //UnreadMessageCount
    function getUnreadMessageCount($from_user_id){
    $cu_user_id = $_SESSION['userdata']['id'];
    
        global $db;
        $query="SELECT count(*) as row FROM messages WHERE to_user_id=$cu_user_id && from_user_id=$from_user_id && read_status=0 ORDER BY id DESC";
        $run = mysqli_query($db,$query);
        if($run){
            return mysqli_fetch_assoc($run)['row'];
        }
        return 0;
    }

    //Save Posts
    //send message
    function savepost($post_id){
        global $db;
        $current_user_id = $_SESSION['userdata']['id'];
        $query = "INSERT INTO saved_post (user_id,post_id) VALUES($current_user_id,$post_id)";
        return mysqli_query($db,$query);
    
    }