<?php 
global $profile; 
global $profile_post;
global $follow_suggestions;
?>
<section class="cover-sec">
<img src="images/resources/cover-img.jpg" alt="">
</section>
<main>
<div class="main-section">
<div class="container">
<div class="main-section-data">
<div class="row">
<div class="col-lg-3">
<div class="main-left-sidebar">
<div class="user_profile">
<div class="user-pro-img">
<img style="border-radius:150px;" src="./images/profile_pic/<?=$profile['profile_pic']; ?>" alt="">
</div>
<div class="user_pro_status">
<ul class="flw-hr">
<?php
    if(checkFollowStatus($profile['id'])){ ?>
        <li><a href="#" title="" class="flww">Following</a></li>
    <?php }else{
?>
<li><a href="#" title="" style="" class="flww followbtn2" data-user-id="<?=$profile['id']; ?>" ><i class="la la-plus"></i> Follow</a></li>
<?php } ?>
<li><a href="#" title="" class="hre">Colab</a></li>
</ul>

<ul class="user-fw-status">
<li>
<h4 class="font-weight-bold"><a href="./?followers=<?=$profile['username']; ?>" style="color:inherit; font-size:inherit;" class="font-weight-bold">Followers</a></h4>
<span><?=count($profile['followers']);?></span>
</li>
<!-- <li>
<h4 class="font-weight-bold">Collaborations</h4>
<span>155</span>
</li> -->
</ul>
</div>
<ul class="social_links">
<?php if($profile['github']=="Not Specified"){ ?>
    <li><a href="#" title="" style="pointer-events: none;cursor: default;"><i class="fa fa-github color-change" aria-hidden="true"></i><?=$profile['github'] ?></a></li>
  <?php } else{ ?>
    <li><a href="<?=$profile['github'] ?>" title="" target="_blank"><i class="fa fa-github color-change" aria-hidden="true"></i><?=$profile['github'] ?></a></li>
  <?php } ?>
  <?php if($profile['linkedin']=="Not Specified"){ ?>
    <li><a href="#" title="" style="pointer-events: none;cursor: default;"><i class="fa fa-linkedin color-change"></i><?=$profile['linkedin'] ?></a></li>
  <?php } else{ ?>
    <li><a href="<?=$profile['linkedin'] ?>" title=""><i class="fa fa-linkedin color-change"></i><?=$profile['linkedin'] ?></a></li>
  <?php } ?>
</ul>
</div>
<div class="suggestions full-width">
<div class="sd-title">
<h3>Suggestions</h3>
<i class="la la-ellipsis-v"></i>
</div>
<div class="suggestions-list">
<?php foreach($follow_suggestions as $suser){ 
    if($suser['id']!=$profile['id']){    
?>
<div class="suggestion-usd">
<img src="./images/profile_pic/<?=$suser['profile_pic']; ?>" alt="">
<div class="sgt-text">
<h4><a style="color:inherit; text-decoration:none;" href="./?u=<?=$suser['username']; ?>"><?=$suser['first_name']." ".$suser['last_name']; ?></a></h4>
<span><?=$suser['key_skill']; ?></span>
</div>
<span><i class="la la-plus followbtn" data-user-id="<?=$suser['id']; ?>"></i></span>
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
<div class="col-lg-6">
<div class="main-ws-sec">
<div class="user-tab-sec">
<h3><?=$profile['first_name']." ".$profile['last_name']; ?></h3>
<div class="star-descp">
<span><?=$profile['key_skill']; ?></span>
<ul>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star-half-o"></i></li>
</ul>
</div>
<div class="tab-feed">
<ul>
<li data-tab="feed-dd" class="active">
<a href="#" title="">
<img src="images/ic1.png" alt="">
<span>Feed</span>
</a>
</li>
<li data-tab="info-dd">
<a href="#" title="">
<img src="images/ic2.png" alt="">
<span>Info</span>
</a>
</li>
<li data-tab="portfolio-dd">
<a href="#" title="">
<img src="images/ic3.png" alt="">
<span>Portfolio</span>
</a>
</li>
</ul>
</div>
</div>
<div class="product-feed-tab current" id="feed-dd">
<div class="posts-section">
<?php if(!count($profile_post)){ ?>
        <h4 class="post-bar text-center lead font-weight-bold color-change">No Posts to Show</h4>
<?php }else{ ?>
<?php foreach($profile_post as $post){ 
    $likes = getLikes($post['id']);
    $comments = getComments($post['id']);
?>
<div class="post-bar">
<div class="post_topbar">
<div class="usy-dt">
<div class="user-picy">
<img src="images/profile_pic/<?=$profile['profile_pic']; ?>" alt=""></div>
<div class="usy-name">
<h3><?=$profile['first_name']." ".$profile['last_name']; ?></h3>
<span><img src="images/clock.png" alt=""><?=date('d-m-Y', strtotime($post['created_at'])); ?></span>
</div>
</div>
<div class="ed-opts">
<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
<ul class="ed-options">
<li><a href="#" title="">Copy Link</a></li>
<li><a href="#" title="">Report</a></li>
</ul>
</div>
</div>
<div class="epi-sec">
<ul class="descp">
<li><img src="images/icon8.png" alt=""><span><?=$profile['key_skill']; ?></span></li>
<li><img src="images/icon9.png" alt=""><span><?=$profile['country']; ?></span></li>
</ul>
<ul class="bk-links">
<li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
<li><a href="#" title=""><i class="la la-envelope"></i></a></li>
</ul>
</div>
<div class="job_descp">
<p><?=$post['post_text']; ?></p>
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
            <img src="./images/profile_pic/<?=$profile['profile_pic'] ?>" alt=""></div>
            <div class="usy-name">
            <h3><a style="color:inherit; decoration:none;" href="./?u=<?=$profile['username']; ?>"><?=$profile['first_name']." ".$profile['last_name']; ?></a></h3>
            <span><img src="images/clock.png" alt=""><?=timeago(date('d-m-YH:i:s', strtotime($post['created_at']))); ?></span>
            <p class="color-change"><?=$post['post_text']; ?></p>
            </div>
            </div></li><hr style="color:#0ca678;">
        <?php  
        foreach($comments as $c){
          $cuser=getUser($c['user_id']);
        ?>
          <li class="" id="comment-section<?=$post['id']?>">
          <div class="suggestion-usd">
          <img src="./images/profile_pic/<?=$cuser['profile_pic']; ?>" alt="">
          <div class="sgt-text w-75">
          <div class="d-flex flex-column mb-2 rounded comment-flex">
            <div class="pl-2 pt-2 pr-2 bd-highlight"><p><a href="./?u=<?=$cuser['username']; ?>"><?=$cuser['first_name']." ".$cuser['last_name']; ?></a></p></div>
            <div class="pl-2 pb-2 pr-2 bd-highlight"><p class="flex-row h6"><?=$c['comment']; ?></p></div>
          </div>
          <span class="float-right" style="font-size:14px;color:#808080;"><img src="images/clock.png" style="width:13px; height:13px;margin-right:4px;" alt=""> <?=timeago(date('d-m-YH:i:s', strtotime($c['created_at']))); ?></span>
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
<?php } } ?>
<div class="process-comm">
<div class="spinner">
<div class="bounce1"></div>
<div class="bounce2"></div>
<div class="bounce3"></div>
</div>
</div>
</div>
</div>
<div class="product-feed-tab" id="info-dd">
<div class="user-profile-ov color-change">
<h3>Overview</h3>

</div>
<div class="user-profile-ov st2">

</div>
<div class="user-profile-ov">
<h3>Education</h3>

</div>
<div class="user-profile-ov">
<h3>Location</h3>
<h4><?=$profile['country'] ?></h4>
</div>
<div class="user-profile-ov">
<h3>Skills</h3>
<ul>
<li><a href="#" title="">HTML</a></li>
<li><a href="#" title="">PHP</a></li>
</ul>
</div>
</div>
<div class="product-feed-tab" id="portfolio-dd">
<div class="portfolio-gallery-sec color-change">
<h3>Gallery</h3>
<div class="gallery_pf">
<div class="row">
<?php foreach($profile_post as $post){ ?>
<?php if($post['media_type']==1){ ?>
<div class="col-lg-4 col-md-4 col-sm-6 col-6">
<div class="gallery_pt">
<img src="./images/posts/<?=$post['post_media']; ?>" alt="">
<a href="#" title=""><img src="images/all-out.png" alt=""></a>
</div>
</div>
<?php } 
} ?>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-3">
<div class="right-sidebar">
<div class="message-btn ed-opts">
<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"> Options</i></a>
<ul class="ed-options text-center">

<li><a style="<?php if(!checkFollowStatus($profile['id'])){ ?>display:none<?php } ?>" href="assets/php/actions.php?unfollow=<?=$profile['username']; ?>&var=1" title=""class="optbtn optuf">Unfollow</a></li>
<li><a class="optbtn post_project active" href="#" title="">Block</a></li>
<li><a href="#" title="" class="optbtn">Report</a></li>
</ul>
</div>
<div class="message-btn">
<a href="#" title="" data-toggle="modal" data-target="#message<?=$profile['id'] ?>"><i class="fa fa-envelope"></i> Message</a>
</div>
<!--Message Model-->
<div class="modal fade" id="message<?=$profile['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="messageModalSender" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content color-change">
      <div class="modal-header">
        <h5 class="modal-title h4 text-light" id="exampleModalLongTitle">Send a text message to <?=$profile['first_name']?></h5>
      </div>
      <div class="modal-body">
      <form>
          <div class="form-group">
            <input type="text" id="msgText" style="border-color:#0ca678; width:80%;" class="m-5 mb-0 align-item-center form-control msgText<?=$profile['id'] ?>" rows="5" placeholder="Type your message..." required></textarea>
          </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="active text-white h5 float-right" style="background-color:#0ca678;" data-dismiss="modal">Close</button>
        <button type="button" class="active sendMsgWall text-white h5 float-right mr-1" style="background-color:#0ca678;" onClick="sendMsg(<?=$profile['id'] ?>)">Send</button>
      </div>
    </div>
  </div>
</div>
<div class="widget widget-portfolio">
<div class="wd-heady">
<h3>Portfolio</h3>
<img src="images/photo-icon.png" alt="">
</div>
<div class="pf-gallery">
<ul>
<?php $i=0; foreach($profile_post as $post){ 
   if($post['media_type']==1 && $i<9){ $i++; ?>
<li><a href="#" title=""><img style="width:70px; height:70px;border: 2px solid #F0F0F0;" src="./images/posts/<?=$post['post_media']; ?>" alt=""></a></li>
<?php } 
} ?>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</main>
<footer>
<div class="footy-sec mn no-margin">
<div class="container">
<ul>
<li><a href="help-center.html" title="">Help Center</a></li>
<li><a href="about.html" title="">About</a></li>
<li><a href="#" title="">Privacy Policy</a></li>
<li><a href="#" title="">Community Guidelines</a></li>
<li><a href="#" title="">Cookies Policy</a></li>
<li><a href="#" title="">Career</a></li>
<li><a href="forum.html" title="">Forum</a></li>
<li><a href="#" title="">Language</a></li>
<li><a href="#" title="">Copyright Policy</a></li>
</ul>
<p><img src="images/copy-icon2.png" alt="">Copyright 2023</p>
<img style="width:10%;" class="fl-rgt" src="images/cm-logo.png" alt="">
</div>
</div>
</footer>
<div class="overview-box" id="create-portfolio">
<div class="overview-edit">
<h3>Create Portfolio</h3>
<form>
<input type="text" name="pf-name" placeholder="Portfolio Name">
<div class="file-submit">
<input type="file" name="file">
</div>
<div class="pf-img">
<img src="images/resources/np.png" alt="">
</div>
<input type="text" name="website-url" placeholder="htp://www.example.com">
<button type="submit" class="save">Save</button>
<button type="submit" class="cancel">Cancel</button>
</form>
<a href="#" title="" class="close-box"><i class="la la-close"></i></a>
</div>
</div>
<div class="post-popup pst-pj">
<div class="post-project">
<h3>Unfollow</h3>
<div class="post-project-fields">
<form method="POST" action="assets/php/actions.php?unfollow">
<div class="row">
<div class="col-lg-12">
<p class="font-weight-bold h5">Are you sure you want to unfollow <?=$profile['first_name']; ?>?</p>
</div>
<div class="col-lg-12">
<ul>
<li><button class="active" type="submit" value="post">Unfollow</button></li>
<li><a href="#" title="">Cancel</a></li>
</ul>
</div>
</div>
</form>
</div>
<a href="#" title=""><i class="la la-times-circle-o"></i></a>
</div>
</div>