<?php global $user; ?>
<section>
<div class="wrapper">
<div class="sign-in-page">
<div class="blocked">
<h1><b>USER DEACTIVATED !<b></h1>
<div><p>Hi <?=$user['first_name']?>, your account is deactivated. To reactivate your account, please drop a mail at usersupport@colabverse.com</p></div>
<div>
<ul style="margin-top:20px;" >
<a href="assets/php/actions.php?logout" style="color:black; background-color:azure; font-weight:600;" class="logout" type="submit">Back to Login</a>
</ul>
</div>
</div>
</div>

</div>
</section>