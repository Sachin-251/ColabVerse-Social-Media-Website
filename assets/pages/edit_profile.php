<?php global $user; ?>
<section class="profile-account-setting">
<div class="container">
<div class="account-tabs-setting">
<div class="row">
<div class="col-lg-3">
<div class="acc-leftbar">
<div class="nav nav-tabs" id="nav-tab" role="tablist">
<a class="nav-item nav-link active" id="nav-acc-tab" data-toggle="tab" href="#nav-acc" role="tab" aria-controls="nav-acc" aria-selected="true"><i class="la la-cogs"></i>Account Setting</a>
<a class="nav-item nav-link" id="nav-status-tab" data-toggle="tab" href="#nav-status" role="tab" aria-controls="nav-status" aria-selected="false"><i class="fa fa-address-card"></i>About Info</a>
<a class="nav-item nav-link" id="nav-notification-tab" data-toggle="tab" href="#nav-notification" role="tab" aria-controls="nav-status" aria-selected="false"><i class="fa fa-user"></i>Profile Picture</a>
<a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false"><i class="fa fa-lock"></i>Change Password</a>
<a class="nav-item nav-link" id="nav-blockking-tab" data-toggle="tab" href="#blockking" role="tab" aria-controls="blockking" aria-selected="false"><i class="fa fa-cc-diners-club"></i>Block List</a>
<a class="nav-item nav-link" id="nav-deactivate-tab" data-toggle="tab" href="#nav-deactivate" role="tab" aria-controls="nav-deactivate" aria-selected="false"><i class="fa fa-random"></i>Deactivate Account</a>
</div>
</div>
</div>
<div class="col-lg-9">
<div class="tab-content" id="nav-tabContent">
<div class="tab-pane fade show active" id="nav-acc" role="tabpanel" aria-labelledby="nav-acc-tab">
<div class="acc-setting">
<h3>Account Setting</h3>
<form>
<div class="notbar">
<h4>Notification Sound</h4><br><br>
<div class="toggle-btn">
<div class="custom-control custom-switch">
<input type="checkbox" class="custom-control-input" id="customSwitch1">
<label class="custom-control-label" for="customSwitch1"></label>
</div>
</div>
</div>
<div class="notbar">
<h4>Notification Email</h4><br><br>
<div class="toggle-btn">
<div class="custom-control custom-switch">
<input type="checkbox" class="custom-control-input" id="customSwitch2">
<label class="custom-control-label" for="customSwitch2"></label>
</div>
</div>
</div>
<div class="notbar">
<h4>Chat Message Sound</h4><br><br>
<div class="toggle-btn">
<div class="custom-control custom-switch">
<input type="checkbox" class="custom-control-input" id="customSwitch3">
<label class="custom-control-label" for="customSwitch3"></label>
</div>
</div>
</div>
<div class="save-stngs">
<ul>
<li><button type="submit">Save Setting</button></li>
</ul>
</div>
</form>
</div>
</div>
<div class="tab-pane fade" id="nav-status" role="tabpanel" aria-labelledby="nav-status-tab">
<div class="acc-setting">
<h3>About Info</h3>
<form method="POST" action="assets/php/actions.php?updateinfo">
<div class="cp-field">
<h5>First Name</h5>
<div class="cpp-fiel">
<input type="text" name="fname" placeholder="<?=$user['first_name'] ?>" value="<?=$user['first_name'] ?>">
<i class="fa fa-user"></i>
</div>
</div>
<div class="cp-field">
<h5>Last Name</h5>
<div class="cpp-fiel">
<input type="text" name="lname" placeholder="<?=$user['last_name'] ?>" value="<?=$user['last_name'] ?>">
<i class="fa fa-user"></i>
</div>
</div>
<div class="cp-field">
<h5>Email</h5>
<div class="cpp-fiel">
<input type="email" name="email" placeholder="<?=$user['email'] ?>" value="<?=$user['email'] ?>" disabled>
<i class="fa fa-envelope"></i>
</div>
</div>
<div class="cp-field">
<h5>Username</h5>
<div class="cpp-fiel">
<input type="text" name="username" placeholder="<?=$user['username'] ?>" value="<?=$user['username'] ?>" disabled>
<i class="fa fa-user"></i>
</div>
</div>
<div class="cp-field">
<h5>Gender</h5>
<div class="cpp-fiel">
<input type="text" name="gender" placeholder="<?=$user['gender'] ?>" value="<?=$user['gender'] ?>" disabled>
<i class="fa fa-venus-mars"></i>
</div>
</div>
<div class="cp-field">
<h5>Key Skill</h5>
<div class="cpp-fiel">
<input type="text" name="skill" placeholder="<?=$user['key_skill'] ?>" value="<?=$user['key_skill'] ?>">
<i class="fa fa-globe"></i>
</div>
</div><div class="cp-field">
<h5>Github Profile</h5>
<div class="cpp-fiel">
<input type="text" name="github" placeholder="<?=$user['github'] ?>" value="<?=$user['github'] ?>">
<i class="fa fa-github"></i>
</div>
</div>
<div class="cp-field">
<h5>LinkedIn</h5>
<div class="cpp-fiel">
<input type="text" name="linkedin" placeholder="<?=$user['linkedin'] ?>" value="<?=$user['linkedin'] ?>">
<i class="fa fa-linkedin"></i>
</div>
</div>
<div class="save-stngs pd3">
<ul>
<li><button type="submit">Save Setting</button></li>
<li><?=showError('fname');?></li>
<li><?=showError('lname');?></li>
<li><?=showError('skill');?></li>
</ul>
</div>
</form>
</div>
</div>
<div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
<div class="acc-setting">
<h3>Change Password</h3>
<form method="POST" action="assets/php/actions.php?passwordchange">
<div class="cp-field">
<h5>Old Password</h5>
 <div class="cpp-fiel">
<input type="password" name="old-password" placeholder="Old Password">
<i class="fa fa-lock"></i>
</div>
</div>
<div class="cp-field">
<h5>New Password</h5>
<div class="cpp-fiel">
<input type="password" name="new-password" placeholder="New Password">
<i class="fa fa-lock"></i>
</div>
</div>
<div class="cp-field">
<h5>Repeat Password</h5>
<div class="cpp-fiel">
<input type="password" name="repeat-password" placeholder="Repeat Password">
<i class="fa fa-lock"></i>
</div>
</div>
<div class="save-stngs pd2">
<ul>
<li><button type="submit">Save Settings</button></li>
<li><?=showError('password');?></li>
</ul>
</div>
</form>
</div>
</div>
<div class="tab-pane fade" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">
<div class="helpforum">
<div class="row">
<div class="col-12 security">
<h3>Change Profile Pic</h3>
<hr>
</div>
<form method="POST" action="assets/php/actions.php?picupdate" enctype="multipart/form-data">
<div class="row">
<div class="col-12">
<div class="edit_profile">
<img src="./images/profile_pic/<?=$user['profile_pic']?>" alt="">
</div>
<div>
<input class="form-control" type="file" name="profile_pic" id="formfile">
</div>
<div class="save-stngs pd2">
<ul>
<li><button type="submit">Save Settings</button></li>
<li><?=showError('profile_pic');?></li>
</ul>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
<div class="tab-pane fade" id="blockking" role="tabpanel" aria-labelledby="nav-blockking-tab">
<div class="helpforum">
<div class="row">
<div class="col-12 security">
<h3>Blocking</h3>
<hr>
</div>
<div class="row">
<div class="col-12">
<h4>Blocking</h4>
<p>See your list,and make changes if you'd like</p>
<div class="bloktext">
<p>You are not bloking anyone</p>
<p>Need to blok or report someone? Go to the profile of the person you want to blok and select "Blok or Report" from the drowp-down menu at the top of the profile summery</p>
<p>Note: After you have blocked the person, Any previous profile views of yours and of the other person will disappear from each of your "Who's viewed your profile" sections. </p>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="tab-pane fade" id="nav-deactivate" role="tabpanel" aria-labelledby="nav-deactivate-tab">
<div class="acc-setting">
<h3>Deactivate Account</h3>
<form method="POST" action="assets/php/actions.php?deactivate">
<div class="cp-field">
<h5>Email</h5>
<div class="cpp-fiel">
<input type="text" name="email" placeholder="Email" required>
<i class="fa fa-envelope"></i>
</div>
</div>
<div class="cp-field">
<h5>Password</h5>
<div class="cpp-fiel">
<input type="password" name="password" placeholder="Password" required>
<i class="fa fa-lock"></i>
</div>
</div>
<div class="cp-field">
<h5>Please Explain Further</h5>
<textarea required></textarea>
</div>
<div class="cp-field">
<div class="fgt-sec">
<input type="checkbox" name="cc" id="c4" required>
<label for="c4">
<span></span>
</label>
<small>I agree to the terms & conditions of ColabVerse</small>
</div>
<p>By deactivating your account, you will lost all the connections and your information on ColabVerse.</p>
</div>
<div class="save-stngs pd3">
<ul>
<li><button type="submit">Deactivate Account</button></li>
<li><?=showError('email');?></li>
<li><?=showError('password');?></li>
</ul>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>