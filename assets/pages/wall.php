<?php 
global $user; 
global $posts;
global $follow_suggestions;
global $wall_follow_count;
?>

<main>
<div class="main-section">
<div class="container">
<div class="main-section-data">
<div class="row">
<div class="col-lg-3 col-md-4 pd-left-none no-pd">
<div class="main-left-sidebar no-margin stk" id="mobScreen">
<div class="user-data full-width">
<div class="user-profile">
<div class="username-dt">
<div class="usr-pic">
<img src="./images/profile_pic/<?=$user['profile_pic'] ?>" alt="">
</div>
</div>
<div class="user-specs">
<h3><?=$user['first_name'].' '.$user['last_name'] ?></h3>
<span>@<?=$user['username'] ?></span>
</div>
</div>
<ul class="user-fw-status">
<li>
<h4 class="font-weight-bold"><a href="./?followers=<?=$user['username']; ?>" style="color:inherit; font-size:inherit;" class="font-weight-bold">Followers</a></h4>
<span><?=count($wall_follow_count['followers']);?></span>
</li>
<!-- <li>
<h4 class="font-weight-bold">Collaborations</h4>
<span>2</span>
</li> -->
<li>
<a href="./?u=<?=$user['username']; ?>" title="">View Profile</a>
</li>
</ul>
</div>
<div class="suggestions full-width">
<div class="sd-title">
<h3>Suggestions</h3>
<i class="la la-ellipsis-v"></i>
</div>
<div class="suggestions-list">
<?php $i=0; foreach($follow_suggestions as $suser){ 
    if($i<8){    
?>
<div class="suggestion-usd">
<img src="./images/profile_pic/<?=$suser['profile_pic']; ?>" alt="">
<div class="sgt-text">
<h4><a style="color:inherit; text-decoration:none;" href="./?u=<?=$suser['username']; ?>"><?=$suser['first_name']." ".$suser['last_name']; ?></a></h4>
<span><?=$suser['key_skill']; ?></span>
</div>
<span><i style="display:" class="la la-plus followbtn" data-user-id="<?=$suser['id']; ?>"></i></span>
</div>
<?php }
} ?>
<div class="view-more">
<a href="#" title="">View More</a>
</div>
</div>
</div>
<div class="tags-sec full-width">
<ul>
<li><a href="#" title="">Help Center</a></li>
<li><a href="#" title="">About</a></li>
 <li><a href="#" title="">Privacy Policy</a></li>
<li><a href="#" title="">Community Guidelines</a></li>
<li><a href="#" title="">Cookies Policy</a></li>
<li><a href="#" title="">Career</a></li>
<li><a href="#" title="">Language</a></li>
<li><a href="#" title="">Copyright Policy</a></li>
</ul>
<div class="cp-sec">
<img style="width:40%;" src="images/cm-logo.png" alt="">
<p><img src="images/cp.png" alt="">Copyright 2023</p>
</div>
</div>
</div>
</div>
<div class="col-lg-6 col-md-8 no-pd">
<div class="main-ws-sec">
<div class="post-topbar">
<div class="user-picy">
<img src="./images/profile_pic/<?=$user['profile_pic'] ?>" alt="">
</div>
<div class="post-st">
<ul>
<li><a class="post_project active" href="#" title="">Update Status</a></li>
<li><a class="post-jb active" href="#" title="">Image/Video</a></li>
</ul>
</div>
</div>
<div class="posts-section">
<?php if(!count($posts)){ ?>
        <h4 class="post-bar text-center lead font-weight-bold">No Posts to Show</h4>
<?php }else{ ?>
<?php $x=0; foreach($posts as $post){ 
  $likes = getLikes($post['id']);
  $comments = getComments($post['id']);
?>
<div class="post-bar">
<div class="post_topbar">
<div class="usy-dt">
<div class="user-picy">
<img src="./images/profile_pic/<?=$post['profile_pic'] ?>" alt=""></div>
<div class="usy-name">
<h3><a style="color:inherit; decoration:none;" href="./?u=<?=$post['username']; ?>"><?=$post['first_name']." ".$post['last_name']; ?></a></h3>
<span><img src="images/clock.png" alt=""><?=date('d-m-Y', strtotime($post['created_at'])); ?></span>
</div>
</div>
<div class="ed-opts">
<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
<ul class="ed-options">
<?php if($post['uid']==$user['id']){ ?><li><a href="#" title="">Edit Post</a></li><?php } ?>
<?php if($post['uid']==$user['id']){ ?><li><a href="#" title="">Delete</a></li><?php } ?>
<li><a href="#" title="">Copy link</a></li>
<?php if($post['uid']!=$user['id']){ ?><li><a href="assets/php/actions.php?unfollow=<?=$post['username']; ?>&var=2" title="">Unfollow</a></li><?php } ?>
<?php if($post['uid']!=$user['id']){ ?><li><a href="#" title="">Report</a></li><?php } ?>
</ul>
</div>
</div>
<div class="epi-sec">
<ul class="descp">
<li><img src="images/icon8.png" alt=""><span><?=$post['key_skill']; ?></span></li>
<li><img src="images/icon9.png" alt=""><span><?=$post['country']; ?></span></li>
</ul>
<ul class="bk-links">
<li><a href="#" title="" id="save_post<?=$post['id'] ?>" onclick="savePost(<?=$post['id'] ?>)"><i id="saveIcon<?=$post['id'] ?>" style="display:" class="la la-bookmark text-light"></i><i style="display:none" class="fa-solid fa-check text-light" id="savedIcon<?=$post['id'] ?>"></i></a></li>
<?php if($post['uid']!=$user['id']){ ?><li><a href="#" title="" data-toggle="modal" data-target="#message<?=$post['id']?>"><i class="la la-envelope"></i></a></li><?php } ?>
</ul>
</div>
<div class="job_descp">
<p class="color-change"><?=$post['post_text']; ?></p>
<?php if($post['media_type']==1){ ?>
    <img src="./images/posts/<?=$post['post_media'];?>" class="img-post-cust2" alt="Something went wrong">
<?php }elseif($post['media_type']==2){ ?>
    <video src="./images/posts/<?=$post['post_media']; ?>" class="img-post-cust2" controls></video>
<?php } ?>
</div>
<div class="job-status-bar">
<ul class="like-com">
<?php
if(checkLikeStatus($post['id'])){
  $like_btn_display='none';
  $unlike_btn_display='';
  }else{
      $like_btn_display='';
      $unlike_btn_display='none';  
  }
?>
<li>
<span class="mr-1 ml-3 mt-1" style="cursor:pointer;" id="likecount<?=$post['id']?>" data-toggle="modal" data-target="#likes<?=$post['id']?>"><?=count($likes);?></span>
<i class="la la-heart like_btn like-btn" style="display:<?=$like_btn_display?>;" data-post-id="<?=$post['id']?>"></i>
<i class="la la-heart unlike_btn unlike-btn" style="display:<?=$unlike_btn_display?>;" data-post-id="<?=$post['id']?>" ></i>
</li>
</ul>
<a href="#" style="font-size:15px;" class="com" data-toggle="modal" data-target="#comments<?=$post['id']?>"><i class="fas fa-comment-alt" style="font-size:15px;"></i> <?=count($comments); ?> Comments</a>
</div>
</div>
<!-- likesModal -->
<div class="modal fade" id="likes<?=$post['id']?>" tabindex="-1" role="dialog" aria-labelledby="likesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
      
        <h5 class="modal-title" id="likesModalLabel" style="text-align:center;font-size:20px;color:white;font-weight:bold;"><i class="la la-heart"></i> Likes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body color-change">
        <?php if(count($likes)<1){ ?>
          <h5 class="text-center p-3 font-weight-bold" style="border:2px solid #f8f8ff;border-radius:3px;color:#808080">No likes</h5><?php }else{
          foreach($likes as $f){
            $fuser=getUser($f['user_id']);
          ?>
        <ul class="list-group">
          <li class="">
            <div class="usy-dt p-3">
            <div class="user-picy">
            <img src="./images/profile_pic/<?=$fuser['profile_pic'] ?>" alt=""></div>
            <div class="usy-name">
            <h3><a style="color:inherit; decoration:none;" href="./?u=<?=$fuser['username']; ?>"><?=$fuser['first_name']." ".$fuser['last_name']; ?></a></h3>
            <span><img src="images/clock.png" alt=""><?=timeago(date('d-m-YH:i:s', strtotime($f['created_at']))); ?></span>
            </div>
            </div></li>
        </ul>
        <?php } } ?>
      </div>
      <div class="modal-footer color-change">
        <button type="button" class="active text-white" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- CommentsModal -->
<div class="modal fade" id="comments<?=$post['id']?>" tabindex="-1" role="dialog" aria-labelledby="commentsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" style="border:2px solid #0ca678;border-radius:10px;">
    <div class="modal-content">
      
      <div class="modal-body">
        
        <ul class="list-group color-change">
          <li style="background-image:linear-gradient(#282828,black);" >
            <div class="mx-auto w-50 h-50">
          <?php if($post['media_type']==1){ ?>
              <img src="./images/posts/<?=$post['post_media'];?>" style="background-color:white;" alt="Something went wrong">
          <?php }elseif($post['media_type']==2){ ?>
              <video src="./images/posts/<?=$post['post_media']; ?>" class="w-100 h-100" controls></video>              
          <?php } ?></div></li>
          <li>
            <div class="usy-dt p-3 ml-3">
            <div class="user-picy">
            <img src="./images/profile_pic/<?=$post['profile_pic'] ?>" alt=""></div>
            <div class="usy-name">
            <h3><a style="color:inherit; decoration:none;" href="./?u=<?=$post['username']; ?>"><?=$post['first_name']." ".$post['last_name']; ?></a></h3>
            <span><img src="images/clock.png" alt=""><?=timeago(date('d-m-YH:i:s', strtotime($post['created_at']))); ?></span>
            <p style="color:#606060;"><?=$post['post_text']; ?><?=$post['id']; ?></p>
            </div>
            </div></li><hr style="color:#0ca678;">
        <?php  
        foreach($comments as $c){
          $cuser=getUser($c['user_id']);
          $tz=date_default_timezone_get()
        ?>
          <li class="" id="comment-section<?=$post['id']?>">
          <div class="suggestion-usd">
          <img src="./images/profile_pic/<?=$cuser['profile_pic']; ?>" alt="">
          <div class="sgt-text w-75">
          <div class="d-flex flex-column mb-2 rounded comment-flex">
            <div class="pl-2 pt-2 pr-2 bd-highlight"><p><a href="./?u=<?=$cuser['username']; ?>"><?=$cuser['first_name']." ".$cuser['last_name']; ?></a></p></div>
            <div class="pl-2 pb-2 pr-2 bd-highlight"><p class="flex-row h6"><?=$c['comment']; ?></p></div>
          </div>
          <span class="float-right" style="font-size:14px;color:#808080;"><img src="images/clock.png" style="width:13px; height:13px;margin-right:4px;" alt=""> <?=timeago(date('Y-m-dH:i:s', strtotime($c['created_at']))); ?></span>
          </div>
          
          
          </div>
          
        </li>
            <?php } ?>
        </ul>
        
       
      </div>
      <div class="modal-footer color-change">
      <form>
          <div class="form-group">
            <input type="text" style="border-color:#0ca678" class="form-control comment-input<?=$post['id']; ?>" rows="3" placeholder="Comment" required>
          </div>
        </form>
        <button type="button" class="active text-white h5" style="background-color:#0ca678;" data-dismiss="modal">Close</button>
        <button type="button" class="active add-comment text-white h5" style="background-color:#0ca678;" data-cs="comment-section<?=$post['id'];?>" data-post-id="<?=$post['id']; ?>">Post Comment</button>
      </div>
    </div>
  </div>
</div>

<!--Message Model-->
<div class="modal fade" id="message<?=$post['id']?>" tabindex="-1" role="dialog" aria-labelledby="messageModalSender" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content color-change">
      <div class="modal-header">
        <h5 class="modal-title h4 text-light" id="exampleModalLongTitle">Send a text message to <?=$post['first_name']?></h5>
      </div>
      <div class="modal-body">
      <form>
          <div class="form-group">
            <input type="text" id="msgText" style="border-color:#0ca678; width:80%;" class="m-5 mb-0 align-item-center form-control msgText<?=$post['uid']; ?>" rows="5" placeholder="Type your message..." required></textarea>
          </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="active text-white h5 float-right" style="background-color:#0ca678;" data-dismiss="modal">Close</button>
        <button type="button" class="active sendMsgWall text-white h5 float-right mr-1" style="background-color:#0ca678;" onClick="sendMsg(<?=$post['uid'] ?>)">Send</button>
      </div>
    </div>
  </div>
</div>

<?php $x=$x+1; if($x==3){ ?>
<div class="top-profiles">
<div class="pf-hd">
<h3>Top Profiles</h3>
<i class="la la-ellipsis-v"></i>
</div>
<div class="profiles-slider">
<?php $i=0; foreach($follow_suggestions as $suser){ 
    if($i<8){    
?>
<div class="user-profy">
 <img src="./images/profile_pic/<?=$suser['profile_pic']; ?>" alt="">
<h3><?=$suser['first_name']." ".$suser['last_name']; ?></h3>
<span><?=$suser['key_skill']; ?></span>
<ul>
<li><a href="#" title="" class="followw">Follow</a></li>
<li><a href="#" title="" class="envlp"><img src="images/envelop.png" alt=""></a></li>
<li><a href="#" title="" class="hire">Colab</a></li>
</ul>
<a href="./?u=<?=$suser['username']; ?>" title="">View Profile</a>
</div>
<?php }
} ?>
</div>
</div>
<?php } } } ?>
<div class="process-comm">
<div class="spinner">
<div class="bounce1"></div>
<div class="bounce2"></div>
<div class="bounce3"></div>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-3 pd-right-none no-pd">
<div class="right-sidebar">
<div class="widget widget-jobs">
<div class="suggestions full-width">
<div class="sd-title">
<h3>Top Profiles</h3>
<i class="la la-ellipsis-v"></i>
</div>
<div class="suggestions-list">
<?php $i=0; foreach($follow_suggestions as $suser){ 
    if($i<8){    
?>
<div class="suggestion-usd">
<img src="./images/profile_pic/<?=$suser['profile_pic']; ?>" alt="">
<div class="sgt-text">
<h4><a style="color:inherit; text-decoration:none;" href="./?u=<?=$suser['username']; ?>"><?=$suser['first_name']." ".$suser['last_name']; ?></a></h4>
<span><?=$suser['key_skill']; ?></span>
</div>
<span><i style="display:" class="la la-plus followbtn" data-user-id="<?=$suser['id']; ?>"></i></span>
</div>
<?php }
} ?>
<div class="view-more">
<a href="#" title="">View More</a>
</div>
</div>
</div>
</div>
<div class="widget widget-jobs">
<div class="suggestions full-width">
<div class="sd-title">
<h3>Most Viewed This Week</h3>
<i class="la la-ellipsis-v"></i>
</div>
<div class="suggestions-list">
<?php $i=0; foreach($follow_suggestions as $suser){ 
    if($i<8){    
?>
<div class="suggestion-usd">
<img src="./images/profile_pic/<?=$suser['profile_pic']; ?>" alt="">
<div class="sgt-text">
<h4><a style="color:inherit; text-decoration:none;" href="./?u=<?=$suser['username']; ?>"><?=$suser['first_name']." ".$suser['last_name']; ?></a></h4>
<span><?=$suser['key_skill']; ?></span>
</div>
<span><i style="display:" class="la la-plus followbtn" data-user-id="<?=$suser['id']; ?>"></i></span>
</div>
<?php }
} ?>
<div class="view-more">
<a href="#" title="">View More</a>
</div>
</div>
</div>
</div>
<div class="widget suggestions full-width">
<div class="suggestions full-width">
<div class="sd-title">
<h3>Most Viewed People</h3>
<i class="la la-ellipsis-v"></i>
</div>
<div class="suggestions-list">
<?php $i=0; foreach($follow_suggestions as $suser){ 
    if($i<8){    
?>
<div class="suggestion-usd">
<img src="./images/profile_pic/<?=$suser['profile_pic']; ?>" alt="">
<div class="sgt-text">
<h4><a style="color:inherit; text-decoration:none;" href="./?u=<?=$suser['username']; ?>"><?=$suser['first_name']." ".$suser['last_name']; ?></a></h4>
<span><?=$suser['key_skill']; ?></span>
</div>
<span><i style="display:" class="la la-plus followbtn" data-user-id="<?=$suser['id']; ?>"></i></span>
</div>
<?php }
} ?>
<div class="view-more">
<a href="#" title="">View More</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</main>
<div class="post-popup pst-pj">
<div class="post-project">
<h3>Post Status</h3>
<div class="post-project-fields">
<form method="POST" action="assets/php/actions.php?addstatus">
<div class="row">
<div class="col-lg-12">
<textarea name="description" placeholder="What's on your mind?" required></textarea>
</div>
<div class="col-lg-12">
<ul>
<li><button class="active text-white" type="submit" value="post">Post</button></li>
</ul>
</div>
</div>
</form>
</div>
<a href="#" title=""><i class="la la-times-circle-o text-white"></i></a>
</div>
</div>
<div class="post-popup job_post">
<div class="post-project">
<h3>Post Image/Video</h3>
<div class="post-project-fields">
<form method="POST" action="assets/php/actions.php?addmedia" enctype="multipart/form-data">
<div class="row">
<div class="col-lg-12">
<div><img src="" style="display:none;" class="img-post-cust" id="post_img" alt="">
<video src="" style="display:none;" class="img-post-cust" id="post_vid" controls></video>
</div>
</div>
<div class="col-lg-12">
<span class="btn btn-primary btn-file">
    Upload Image <input type="file" id="select_post_img" name="post_img">
</span>
<span class="btn btn-primary btn-file">
    Upload Video <input type="file" id="select_post_vid" name="post_vid">
</span>
</div>
<div class="col-lg-12">
<textarea name="img_caption" placeholder="Caption"></textarea>
</div>
<div class="col-lg-12">
<ul>
<li><button class="active text-white" type="submit" value="post">Post</button></li>
</ul>
</div>
</div>
</form>
</div>
<a href="#" title=""><i class="la la-times-circle-o text-white"></i></a>
</div>
</div>

</div>
