<?php global $user; ?>
<header>
<div class="container">
<div class="header-data">
<div class="logo">
<a href="./" title=""><img src="images/logo.png" alt=""></a>
</div>
<div class="search-bar">
<form class="d-flex" id="searchform">
    <input class="form-control me-2" type="search" id="search" placeholder="looking for someone.."
    aria-label="Search" autocomplete="off">
<div class="ser-field text-end rounded border shadow py-3 px-4 mt-5" id="search_result" data-bs-auto-close="true">

<div id="sra" class="text-start nav-close">
<p class="text-center text-muted">Enter name or username</p>

</div>
<button type="button" style="width:20px;height:20px;background-color:#0ca678;color:white;" aria-label="Close" id="close_search">X</button>
</div>

</form>
</div>
<nav>
<ul>
<li>
<a href="./" title="">
<span><img src="images/icon1.png" alt=""></span>
Home
</a>
</li>
<li>
<a href="./?u=<?=$user['username']; ?>" title="">
<span><img src="images/icon4.png" alt=""></span>
Profile
</a>
</li>
<li>
<a href="./?messages" title="" class="not-box-openm" id="msgNoti">
<span class="msg-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"></span>
<span><img src="images/icon6.png" alt=""></span>
Messages
</a>
</li>
<li>
<a href="#" title="" class="not-box-open" id="show_not">
<span class="un-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"></span>
<span><i class="fa fa-solid fa-bell"></i></span>
Notifications 
</a>
<div class="notification-box noti" id="notification">
<div class="nt-title">
<h4>Setting</h4>
<a href="#" title="">Clear all</a>
</div>
<div class="nott-list">
    <?php
        $notifications=getNotifications();
        $i=0;
        foreach($notifications as $notification){
            if($i>6){
                break;
            }
            $nuser=getUser($notification['from_user_id']);
            $i++;
        ?>
<div class="notfication-details">
<div class="noty-user-img">
<img src="images/profile_pic/<?=$nuser['profile_pic']; ?>" alt="">
</div>
<div class="notification-info">
<h3><a href="./?u=<?=$nuser['username'];?>" title=""><?=$nuser['first_name']." ".$nuser['last_name']; ?> </a> <?=$notification['message']; ?></h3>&nbsp;
<span><?=timeago(date('d-m-YH:i:s', strtotime($notification['created_at']))); ?></span>
</div>
</div>
<?php }
?>
<div class="view-all-nots">
<a href="#" title="">View All Notification</a>
</div>
</div>
</div>
</li>
</ul>
</nav>
<div class="menu-btn">
<a href="#" title=""><i class="fa fa-bars"></i></a>
</div>
<div class="user-account">
<div class="user-info">
<img src="./images/profile_pic/<?=$user['profile_pic']?>" alt="">
<a href="#" title=""><?=$user['first_name']?><i style="font-size:16px;font-weight: bold;margin-left:5px;" class="la la-chevron-circle-down"></i></a>
</div>
<div class="user-account-settingss" id="users">
<div class="p-3 border-bottom border-white" >
    <span><button id="theme-toggle" class="btn btn-secondary">Switch to Dark Mode</button></span>
</div>
<h3>Setting</h3>
<ul class="us-links">
<li><a href="?editprofile" title="">Account Setting</a></li>
<li><a href="#" title="">Privacy</a></li>
<li><a href="#" title="">Faqs</a></li>
<li><a href="#" title="">Terms & Conditions</a></li>
</ul>
<h3 class="tc"><a href="assets/php/actions.php?logout" title="">Logout</a></h3>
</div>
</div>
</div>
</div>
</header>