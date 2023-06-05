<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ColabVerse - Verify Email</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" type="text/css" href="css/animate.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css">
</head>
<body class="sign-in">
<div class="wrapper">
<div class="sign-in-page">
<div class="signin-popup">
<div class="signin-pop">
<div class="row">
<div class="col-lg-6">
<div class="cmp-info">
<div class="cm-logo">
<img src="images/cm-logo.png" alt="">
<p>ColabVerse, is a global collaborating platform and social networking where individuls can collaborate and connect with others sharing the same passion.</p>
</div>
<img src="images/cm-main-img.png" alt="">
</div>
</div>
<div class="col-lg-6">
<div class="login-sec">
<ul class="sign-control">
<a href="assets/php/actions.php?logout" class="logout" type="submit">Back to Login</a>
</ul>
<div class="sign_in_sec current" id="tab-1">
<h3>Verify your Email: Enter the code sent to your email.</h3>
<form method="POST" action="assets/php/actions.php?verify_email">
<div class="row">
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="text" name="ver_code" placeholder="Enter the Verification Code" required>
<i class="la la-lock"></i>
</div>
</div>
<?php
    if(isset($_GET['resended'])){?>
        <p>Verification Code Resended !</p>
    <?php }
?>
<?=showError('email_verify');?>
<div class="col-lg-12 no-pdd">
<button type="submit" value="submit">Verify Email</button>
<a href="assets/php/actions.php?resend_code" class="resend" type="submit" >Resend Code</a>
</div>

</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="footy-sec">
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
<p><img src="images/copy-icon.png" alt="">Copyright 2019</p>
</div>
</div>
</div>
</div>
<script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>