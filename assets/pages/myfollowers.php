<?php 
    global $wall_follow_count;
?>
<section class="companies-info">
<div class="container">
<div class="company-title">
<h3>Followers</h3>
</div>
<div class="companies-list">
<div class="row">
<?php foreach($wall_follow_count['followers'] as $fuser){ ?>
<div class="col-lg-3 col-md-4 col-sm-6 col-12">
<div class="company_profile_info">
<div class="company-up-info">
<img src="./images/profile_pic/<?=$fuser['profile_pic']; ?>" alt="">
<h3><a style="color:inherit;"><?=$fuser['first_name']." ".$fuser['last_name']; ?></a></h3>
<h4><?=$fuser['key_skill']; ?></h4>
<ul>
<?php if(!checkFollowStatus($fuser['uid'])){ ?>
<li><a href="#" title="" class="follow followbtn" data-user-id="<?=$fuser['uid']; ?>">Follow</a></li><?php } ?>
<li><a href="#" title="" class="message-us"><i class="fa fa-envelope"></i></a></li>
<li><a href="#" title="" class="hire-us">Colab</a></li>
</ul>
</div>
<a href="./?u=<?=$fuser['username']; ?>" title="" class="view-more-pro">View Profile</a>
</div>
</div>
<?php } ?>
</div>
</div>
<div class="process-comm">
<div class="spinner">
<div class="bounce1"></div>
<div class="bounce2"></div>
<div class="bounce3"></div>
</div>
</div>
</div>
</section>
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
<p><img src="images/copy-icon2.png" alt="">Copyright 2019</p>
<img class="fl-rgt" src="images/logo2.png" alt="">
</div>
</div>
</footer>