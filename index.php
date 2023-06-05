<?php 

    require_once 'assets/php/functions.php';
    
    if(isset($_GET['newfp'])){
        unset($_SESSION['auth_temp']);
        unset($_SESSION['forgot_email']);
        unset($_SESSION['forgot_code']);
    }

    if(isset($_SESSION['Auth'])){
        $user = getUser($_SESSION['userdata']['id']);
        $posts = filterPosts();
        $follow_suggestions = filterFollowSuggestion();
        $wall_follow_count['followers']=getFollowers($user['id']);
    }

    $pagecount = count($_GET);

    //manage pages
    if(isset($_SESSION['Auth']) && $user['ac_status'] == 1 && !$pagecount){
        showPage('header',['page-title'=>$user['first_name']." ".$user['last_name']." - ".'Home']);
        showPage('navbar',[]);
        showPage('wall',[]);
        showPage('footer',[]);
    }
    elseif(isset($_SESSION['Auth']) && $user['ac_status'] == 0 && !$pagecount){
        showPage('verify_email');
    }
    elseif(isset($_SESSION['Auth']) && $user['ac_status'] == 2 && !$pagecount){
        showPage('header',['page-title'=>'ColabVerse - User Deactivated']);
        showPage('blocked',[]);
    }
    elseif(isset($_SESSION['Auth']) && isset($_GET['editprofile']) && $user['ac_status']==1){
        $name=$user['first_name']." ".$user['last_name'];
        showPage('header',["page-title"=>$user['first_name']." ".$user['last_name']." - ".'Edit Profile']);
        showPage('navbar',[]);
        showPage('edit_profile',[]);
        showPage('footer',[]);
    }
    elseif(isset($_SESSION['Auth']) && isset($_GET['u']) && $user['ac_status']==1){
        $profile = getUserByUsername($_GET['u']);
        if(!$profile){
            showPage('header',['page-title'=>'User Not Found']);
            showPage('navbar');
            showPage('user_not_found');

        }else{
            if($profile['username']==$user['username']){
                $profile_post = getPostById($profile['id']);  
                $profile['followers']=getFollowers($profile['id']);
                $profile['following']=getFollowing($profile['id']);
                showPage('header',['page-title'=>$user['first_name']." ".$user['last_name']." - ".'Profile']);
                showPage('navbar');
                showPage('myprofile');
                showPage('footer',[]);
            }else{
                $profile_post = getPostById($profile['id']);
                $profile['followers']=getFollowers($profile['id']);
                //$profile['following']=getFollowing($profile['id']);*/
                showPage('header',['page-title'=>$profile['first_name']." ".$profile['last_name']]);
                showPage('navbar');
                showPage('profile');
                showPage('footer',[]);
            }
        }
    }elseif(isset($_SESSION['Auth']) && isset($_GET['followers']) && $user['ac_status']==1){
        $fprofile = getUserByUsername($_GET['followers']);
        if(!$fprofile){
            showPage('header',['page-title'=>'User Not Found']);
            showPage('navbar');
            showPage('user_not_found');

        }else{
            if($fprofile['username']==$user['username']){
                $fprofile['followers']=getFollowers($fprofile['id']);
                showPage('header',["page-title"=>$user['first_name']." ".$user['last_name']." - ".'Followers']);
                showPage('navbar',[]);
                showPage('myfollowers',[]);
                showPage('footer',[]);
            }else{
                $fprofile['followers']=getFollowers($fprofile['id']);
                showPage('header',["page-title"=>$fprofile['first_name']." ".$fprofile['last_name']." - ".'Followers']);
                showPage('navbar',[]);
                showPage('followers',[]);
                showPage('footer',[]);
            }
        }
    }elseif(isset($_SESSION['Auth']) && isset($_GET['following']) && $user['ac_status']==1){
        $folprofile = getUserByUsername($_GET['following']);
        if(!$folprofile){
            showPage('header',['page-title'=>'User Not Found']);
            showPage('navbar');
            showPage('user_not_found');

        }else{
            if($folprofile['username']==$user['username']){
                $folprofile['following']=getFollowing($folprofile['id']);
                showPage('header',["page-title"=>$user['first_name']." ".$user['last_name']." - ".'Following']);
                showPage('navbar',[]);
                showPage('following',[]);
                showPage('footer',[]);}
        }
    }elseif(isset($_SESSION['Auth']) && isset($_GET['messages']) && $user['ac_status']==1){
            showPage('header', ["page-title"=>$user['first_name']." ".$user['last_name']." - ".'Following']);
            showPage('navbar',[]);
            showPage('messages',[]);
            showPage('footer',[]);
    }
    elseif(isset($_GET['sign-in'])){
        sleep(2);
        if(isset($_COOKIE["user_id"]) && isset($_COOKIE["user_password"])){
            cookieLoginVerification($_COOKIE["user_id"],$_COOKIE["user_password"]);
        }
        showPage('sign-in',[]);
    }
    elseif(isset($_GET['forgotpassword'])){
        showPage('forgot_password',[]);
    }
    else{
        if(isset($_SESSION['Auth']) && $user['ac_status']==1){
            showPage('header',['page-title'=>$user['first_name']." ".$user['last_name']." - ".'Home']);
            showPage('navbar');
            showPage('wall');
            showPage('footer',[]);
        }elseif(isset($_SESSION['Auth']) && $user['ac_status']==0){
    
            showPage('header',['page-title'=>'Verify Your Email']);
            showPage('verify_email');
        }elseif(isset($_SESSION['Auth']) && $user['ac_status']==2){
            showPage('header',['page-title'=>'User Blocked']);
            showPage('blocked');
        }else{
            if(isset($_COOKIE["user_id"]) && isset($_COOKIE["user_password"])){
                cookieLoginVerification($_COOKIE["user_id"],$_COOKIE["user_password"]);
            }
            showPage('sign-in',[]);
        }
            
    }

    unset($_SESSION['error']);
    unset($_SESSION['formdata']);

?>