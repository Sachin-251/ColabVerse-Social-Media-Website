<?php
    require_once 'functions.php';

    //follow user
    if(isset($_GET['follow'])){
        $user_id = $_POST['user_id'];
    
    
        if(followUser($user_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }

        echo json_encode($response);
    }

    //unfollow user
    if(isset($_GET['unfollow'])){
        $user_id = $_POST['user_id'];
    
    
        if(unfollowUser($user_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    }

    //like post
    if(isset($_GET['like'])){
        $post_id = $_POST['post_id'];
    
        if(!checkLikeStatus($post_id)){
            if(like($post_id)){
                $response['status']=true;
            }else{
                $response['status']=false;
            }
        
            echo json_encode($response);
        }
    
      
    }

    //unlike post
    if(isset($_GET['unlike'])){
        $post_id = $_POST['post_id'];
    
        if(checkLikeStatus($post_id)){
            if(unlike($post_id)){
                $response['status']=true;
            }else{
                $response['status']=false;
            }
        
            echo json_encode($response);
        }
    
      
    }

    //add-comment
    if(isset($_GET['addcomment'])){
        $post_id = $_POST['post_id'];
        $comment = $_POST['comment'];
    
    
        
            if(addComment($post_id,$comment)){
          $cuser = getUser($_SESSION['userdata']['id']);
          $time = date("Y-m-d H:i:s");
                $response['status']=true;
                $response['comment']='<div class="suggestion-usd">
                <img src="./images/profile_pic/'.$cuser['profile_pic'].'" alt="">
                <div class="sgt-text w-75">
                <div class="d-flex flex-column mb-2 rounded comment-flex">
                    <div class="pl-2 pt-2 pr-2 bd-highlight"><p><a href="./?u='.$cuser['username'].'">'.$cuser['first_name'].' '.$cuser['last_name'].'</a><p></div>
                    <div class="pl-2 pb-2 pr-2 bd-highlight"><p class="flex-row h6">'.$_POST['comment'].'</p></div>
                </div>
                <span class="float-right" style="font-size:14px;color:#808080;"><img src="images/clock.png" style="width:13px; height:13px; margin-right:2px;" alt="">just now</span>
                </div>
                
                
                </div>';
            }else{
                $response['status']=false;
            }
        
            echo json_encode($response);
        
    
      
    }

    if(isset($_GET['notread'])){
        
        if(setNotificationStatusAsRead()){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    }

    if(isset($_GET['getNotifications'])){
        if(getUnreadNotificationsCount()){
            $response['status']=getUnreadNotificationsCount();
        }else{
            $response['status']=false;
        }

        echo json_encode($response);
    }

    //Unread Message Count
    if(isset($_GET['getUnreadMessageCount'])){
        if(newMsgCount()){
            $response['status']=newMsgCount();
        }else{
            $response['status']=false;
        }

        echo json_encode($response);
    }

    //searching
    if(isset($_GET['search'])){
        $keyword = $_POST['keyword'];
        $data = searchUser($keyword);
    $users="";
        if(count($data)>0){
            $response['status']=true;
         
    
    
            foreach($data as $fuser){
                $fbtn='';
            
            
           $users.=' <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center p-1 m-2">
                                    <div><img src="./images/profile_pic/'.$fuser['profile_pic'].'" alt="" style="width:60px; height:60px;" class="rounded-circle border">
                                    </div>
                                    <div>&nbsp;&nbsp;</div>
                                    <div class="d-flex flex-column justify-content-center ml-3">
                                        <a href="?u='.$fuser['username'].'" class="text-decoration-none text-dark"><h6 class="ser-res" style="margin: 0px;font-size: small;">'.$fuser['first_name'].' '.$fuser['last_name'].'</h6></a>
                                        <p style="margin:0px;font-size:small" class="text-muted ser-res">'.$fuser['key_skill'].'</p>
                                    </div>
                                </div>
                                <hr class="hr" />
                                <div class="d-flex align-items-center">
                                  '.$fbtn.'
                                
                                </div>
                                
                            </div>';
            
            }
                        
            
    $response['users']=$users;
    
    
    
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    }

    //Messaging
    if(isset($_GET['sendmessage'])){
        if(sendMessage($_POST['user_id'],$_POST['msg'])){
            $response['status']=true;
        }else{
            $response['status']=false;
    
        }
    
        echo json_encode($response);
    }

    if(isset($_GET['getmessages'])){
        $chats = getAllMessages();
        $chatlist="";
        $first_chat="";
        $i=0;
        // echo "<pre>";
        // print_r($chats);
        foreach($chats as $chat){
            $ch_user = getUser($chat['user_id']);
            if($i==0){
                $first_chat = $chat['user_id'];
                $i++;
            }
            
            $seen=false;
            if($chat['messages'][0]['read_status']==1 || $chat['messages'][0]['from_user_id']==$_SESSION['userdata']['id']){
                $seen = true;
            }
            $chatlist.=
            '<li class="active" onClick="chatTab('.$ch_user['id'].')">
            <div class="usr-msg-details ml-0">
            <div class="usr-ms-img">
            <img src="images/profile_pic/'.$ch_user['profile_pic'].'" alt="" height="50" witdh="50">
            <span class="msg-status"></span>
            </div>
            <div class="usr-mg-info">
            <h3>'.$ch_user['first_name'].' '.$ch_user['last_name'].'</h3>
            <p>'.substr($chat['messages'][0]['msg'],0,30).'</p>
            </div>
            <span class="posted_time">'.timeago(date('d-m-YH:i:s', strtotime($chat['messages'][0]['created_at']))).'</span>
            <span class="msg-notifc '.($seen?'d-none':'').'">'.getUnreadMessageCount($ch_user['id']).'</span>
            </div>
            </li>';

           
        
        }
        $json['chatlist'] = $chatlist;
        $json['first_chat'] = $first_chat;
        
        
        if(isset($_POST['chatter_id']) && $_POST['chatter_id']!=0){
        $messages = getMessages($_POST['chatter_id']);
        $chatmsg="";
       /* if(checkBS($_POST['chatter_id'])){
            $json['blocked']=true;
        }else{*/
            $json['blocked']=false;
        
        //}
        updateMessageReadStatus($_POST['chatter_id']);
        
        foreach($messages as $cm){
            $ch_user = getUser($cm['from_user_id']);
            if($cm['from_user_id']==$_SESSION['userdata']['id']){
                $chatmsg.='<div class="d-flex flex-row justify-content-end w-100 p-2 float-right">
                <div class="d-flex flex-column mr-2" style="max-width:65%;">
                <div class="p-2" style="border-radius:10px;background-color:#0CA678;">
                <p class="text-justify">'.$cm['msg'].'</p>
                </div>
                <span class="text-right text-secondary">'.timeago(date('d-m-YH:i:s', strtotime($cm['created_at']))).'</span>
                </div>
                <div class="rounded float-right">
                <img src="images/profile_pic/'.$ch_user['profile_pic'].'" alt="" style="border-radius:50px;" width="40px" height="40px">
                </div>
                </div>';
            
            }else{
                $chatmsg.='<div class="d-flex flex-row-reverse justify-content-end w-100 p-2 float-left">
                <div class="d-flex flex-column ml-2">
                <div class="p-2 text-left" style="border-radius:10px;background-color:#808080;">
                <p>'.$cm['msg'].'</p>
                </div>
                <span class="text-left text-secondary">'.timeago(date('d-m-YH:i:s', strtotime($cm['created_at']))).'</span>
                </div>
                <div class="rounded float-left">
                <img src="images/profile_pic/'.$ch_user['profile_pic'].'" alt="" style="border-radius:50px;" width="40px" height="40px">
                </div>
                </div>';
            }
            // $chatmsg.=' <div class="py-2 px-3 border rounded shadow-sm col-8 d-inline-block '.$cl1.'">'.$cm['msg'].'<br>
            // <span style="font-size:small" class="'.$cl2.'">'.gettime($cm['created_at']).'</span>
            // </div>';
        }
        $json['chat']['msgs']=$chatmsg;
        $json['chat']['userdata']=getUser($_POST['chatter_id']);
        }else{
            $json['chat']['msgs']='<div class="process-comm">
            <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
            </div>
            </div>';
        }
        
        echo json_encode($json);
        }

        if(isset($_GET['savepost'])){
            if(savepost($_POST['post_id'])){
                $response['status']=true;
            }else{
                $response['status']=false;
            }
    
            echo json_encode($response);
        }
?>