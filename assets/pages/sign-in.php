
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ColabVerse - Sign In</title>
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
<li data-tab="tab-1" class="current"><a href="#" title="">Sign in</a></li>
<li data-tab="tab-2"><a href="#" title="">Sign up</a></li>
</ul>
<div class="sign_in_sec current" id="tab-1">
<h3>Sign in</h3>
<form method="POST" action="assets/php/actions.php?sign-in">
<div class="row">
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="text" name="log_username" placeholder="Username/Email" value="<?=showFormData('log_username');?>" required>
<i class="la la-user"></i>
</div>
</div>
<?=showError('log_username');?>
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="password" name="log_password" placeholder="Password" required>
<i class="la la-lock"></i>
</div>
</div>
<?=showError('log_password');?>
<div class="col-lg-12 no-pdd">
<div class="checky-sec">
<div class="fgt-sec">
<input type="checkbox" name="remember" id="c1" value="checked">
<label for="c1">
<span></span>
</label>
<small>Keep me signed in.</small>
</div>
<a href="?forgotpassword&newfp" title="">Forgot Password?</a>
</div>
</div>
<div class="col-lg-12 no-pdd">
<button type="submit" value="submit">Sign in</button>
</div>
<?=showError('checkuser');?>
</div>
</form>
</div>
<div class="sign_in_sec" id="tab-2">

<div class="dff-tab current" id="tab-3">
<h3>Sign up</h3>
<form method="POST" action="assets/php/actions.php?sign-up">
<div class="row">
<div class="col-lg-12 no-pdd">
<div class="sn-field"> 
<input type="text" name="fname" placeholder="Fist Name" value="<?=showFormData('fname');?>" required>
<i class="la la-user"></i>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="sn-field"> 
<input type="text" name="lname" placeholder="Last Name" value="<?=showFormData('lname');?>" required>
<i class="la la-user"></i>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="email" name="reg_email" placeholder="Email" value="<?=showFormData('reg_email');?>" required>
<i class="la la-globe"></i>
</div>
</div>
<?=showError('reg_email');?>
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<select name="reg_gender" required>
<option value="gender">Gender</option>
<option value="male">Male</option>
<option value="female">Female</option>
<option value="other">Other</option>
</select>
<i class="la la-venus-mars"></i>
<span><i class="fa fa-ellipsis-h"></i></span>
</div>
</div>
<?=showError('reg_gender');?>
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="password" name="reg_password" placeholder="Password"required>
<i class="la la-lock"></i>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="password" name="repeat_password" placeholder="Repeat Password" required>
<i class="la la-lock"></i>
</div>
</div>
<?=showError('repeat_password');?>
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="text" name="skill" placeholder="Key Skill" required>
<i class="la la-globe"></i>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="checky-sec st2">
<div class="fgt-sec">
<input type="checkbox" name="cc" id="c2" required>
<label for="c2">
<span></span>
</label>
<small>Yes, I understand and agree to the ColabVerse Terms & Conditions.</small>
</div>
</div>
</div>
<?=showError('cc');?>
<div class="col-lg-12 no-pdd">
<button type="submit" value="submit">Get Started</button>
</div>
</div>
</form>
</div>
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