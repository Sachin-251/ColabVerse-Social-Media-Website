<?php

    require_once 'functions.php';
    require_once 'send_code.php';

    //for managing signup
    if(isset($_GET['sign-up'])){
        $response = validateSignupForm($_POST);
        if($response['status']){
            if(createUser($_POST)){
                header('location:../../?verify_email');
                }else{
                    echo "<script>alert('somethihng is wrong')</script>";
                }
        }else{
            $_SESSION['error']=$response;
            $_SESSION['formdata']=$_POST;
            header("location:../../?sign-in");
            
        }
    }

    //for managing sign-in
    if(isset($_GET['sign-in'])){
    
        $response=validateSignInForm($_POST);
    
        if($response['status']){
        
            $_SESSION['Auth'] = true;
            $_SESSION['userdata'] = $response['user'];
            if($response['user']['ac_status']==0){
                $_SESSION['code']=$code = rand(111111,999999);
                sendCode($response['user']['email'],'Verify Your Email',$code);
            }
            if(isset($_POST['remember'])){
                setcookie('user_id',$_SESSION['userdata']['id'], time()+(86400 * 10), '/');
                setcookie('user_password',md5($_POST['log_password']), time()+(86400 * 10), '/');
            }
            header("location:../../");

            }else{
                $_SESSION['error']=$response;
                $_SESSION['formdata']=$_POST;
                header("location:../../?sign-in");
            }
            
    }

    //for resending the code
    if(isset($_GET['resend_code'])){
       
        $_SESSION['code']=$code = rand(111111,999999);
        sendCode($_SESSION['userdata']['email'],'Verify Your Email',$code);
        header('location:../../?resended');
    }

    //for verify Email
    if(isset($_GET['verify_email'])){
        $user_code = $_POST['ver_code'];
        $code = $_SESSION['code'];
        if($code==$user_code){
            if(verifyEmail($_SESSION['userdata']['email'])){
            header('location:../../');
            }else{
                echo "something is wrong";
            }
 
        }else{
            $response['msg']='incorrect verifictaion code !';
            if(!$_POST['ver_code']){
             $response['msg']='enter 6 digit code !';
 
            }
            $response['field']='email_verify';
            $_SESSION['error']=$response;
            header('location:../../');
 
        }
        
    }

    //for forgot password
    if(isset($_GET['forgotpassword'])){
        if(!$_POST['forgot_email']){
            $response['msg']="enter your email id !";
            $response['field']='email';
            $_SESSION['error']=$response;
            header('location:../../?forgotpassword');
    
        }elseif(!isEmailRegistered($_POST['forgot_email'])){
            $response['msg']="email id is not registered";
            $response['field']='email';
            $_SESSION['error']=$response;
            header('location:../../?forgotpassword');
    
        }else{
              $_SESSION['forgot_email']=$_POST['forgot_email'];
               $_SESSION['forgot_code']=$code = rand(111111,999999);
                sendCode($_POST['forgot_email'],'Forgot Your Password ?',$code);
                header('location:../../?forgotpassword&resended');
        }
    
    
    }

    // for verify forgot code
    if(isset($_GET['verifycode'])){
        $user_code = $_POST['ver_code'];
        $code = $_SESSION['forgot_code'];
        if($code==$user_code){
            $_SESSION['auth_temp']=true;
            header('location:../../?forgotpassword');
        }else{
            $response['msg']='incorrect verifictaion code !';
            if(!$_POST['code']){
            $response['msg']='enter 6 digit code !';

            }
        $response['field']='email_verify';
        $_SESSION['error']=$response;
        header('location:../../?forgotpassword');

        }
        
    }

    //change password
    if(isset($_GET['changepassword'])){
        if(!$_POST['new_password']){
            $response['msg']="enter your new password";
            $response['field']='password';
            $_SESSION['error']=$response;
            header('location:../../?forgotpassword');
        }elseif($_POST['new_password_repeat'] != $_POST['new_password']){
            $response['msg']="password does not match";
            $response['field']='password';
            $_SESSION['error']=$response;
            header('location:../../?forgotpassword');
        }else{
            resetPassword($_SESSION['forgot_email'],$_POST['new_password']);
            session_destroy();
            header('location:../../?reseted');
        }
    
    
    }

    //change password from account settings
    if(isset($_GET['passwordchange'])){
        if($_POST['repeat-password'] != $_POST['new-password']){
            $response['msg']="password does not match";
            $response['field']='password';
            $_SESSION['error']=$response;
            header('location:../../?editprofile');
        }elseif(!checkpassword($_SESSION['userdata']['email'], $_POST['old-password'])){
            $response['msg']="Wrong Password";
            $response['field']='password';
            $_SESSION['error']=$response;
            header('location:../../?editprofile');
        }else{
            resetPassword($_SESSION['userdata']['email'], $_POST['new-password']);
            session_destroy();
            header('location:../../?reseted');
        }
    }

    //change info
    if(isset($_GET['updateinfo'])){
        if(!$_POST['fname']){
            $response['msg']="Please provide the first name.";
            $response['field']='fname';
            $_SESSION['error']=$response;
            header('location:../../?editprofile');
        }elseif(!$_POST['lname']){
            $response['msg']="Please provide the Last name.";
            $response['field']='lname';
            $_SESSION['error']=$response;
            header('location:../../?editprofile');
        }elseif(!$_POST['skill']){
            $response['msg']="Please provide the Key Skill";
            $response['field']='skill';
            $_SESSION['error']=$response;
            header('location:../../?editprofile');
        }else{
            $result=updateInfo($_SESSION['userdata']['email'],$_POST['fname'],$_POST['lname'],$_POST['skill'],$_POST['github'],$_POST['linkedin']);
            if($result){
                echo '<script>alert("Info Updated.")</script>';
            }else{
                echo '<script>alert("There was some problem. Could not update the info.")</script>';
            }
            header('location:../../?editprofile');
        }
    }

    //for deactivating the account
    if(isset($_GET['deactivate'])){
        if($_POST['email']!=$_SESSION['userdata']['email']){
            $response['msg']="Wrong Email";
            $response['field']='email';
            $_SESSION['error']=$response;
            header('location:../../?editprofile');
        }elseif(!checkpassword($_SESSION['userdata']['email'], $_POST['password'])){
            $response['msg']="Wrong Password";
            $response['field']='password';
            $_SESSION['error']=$response;
            header('location:../../?editprofile');
        }else{
            deactivateAccount($_SESSION['userdata']['email']);
            session_destroy();
            header('location:../../');
        }
    }

    //for profile pic update
    if(isset($_GET['picupdate'])){
        $response = validatePicForm($_FILES['profile_pic']);

        if($response['status']){
       
            if(updateProfilePic($_SESSION['userdata']['email'],$_FILES['profile_pic'])){
                header("location:../../?editprofile&success");
    
            }else{
                echo "something is wrong";
            }
           
        
        }else{
            $_SESSION['error']=$response;
            header("location:../../?editprofile");
        }
    }

    //for logout
    if(isset($_GET['logout'])){
        setcookie('user_id','', time() - 3600, '/');
        setcookie('user_password','', time() - 3600, '/');
        session_destroy();
        header('location:../../');
    }

    //for managing add media
    if(isset($_GET['addmedia'])){
        $response = validatePostImage($_FILES['post_img']);
        if(!$response['status']){
            $response = validatePostImage($_FILES['post_vid']);
            if($response['status']){
                $media_type=2;
                if(createPost($_POST,$_FILES['post_vid'],$media_type)){
                    header("location:../../?new_post_added");
                }else{
                    echo "something went wrong";
                }
                   }else{
                    $_SESSION['error']=$response;
                    header("location:../../");
                }
        }else{
            if($response['status']){
                $media_type=1;
                if(createPost($_POST,$_FILES['post_img'],$media_type)){
                    header("location:../../?new_post_added");
                }else{
                    echo "something went wrong";
                }
            }else{
                $_SESSION['error']=$response;
                header("location:../../");
            }
        }
     }

     //for managing status post
     if(isset($_GET['addstatus'])){
        if(createStatus($_POST)){
            header("location:../../?new_post_added");
        }else{
            echo "something went wrong";
        }
     }

     if(isset($_GET['unfollow'])){
        $profile_un = getUserByUsername($_GET['unfollow']);
        $response=unfollowUser($profile_un['id']);
        $var=$_GET['var'];
        if($response){
            if($var==1){
                header("location:../../?u=".$profile_un['username']);
            }elseif($var==2){
                header("location:../../");
            }elseif($var==3){
                header("location:../../?following=".$_SESSION['userdata']['username']);
            }
            
        }else{
            echo "Something went wrong";
        }
     }
?>