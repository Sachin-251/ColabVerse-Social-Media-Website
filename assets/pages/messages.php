<?php global $user; ?>
<section class="messages-page">
<div class="">
<div class="messages-sec">
<div class="row" id="message-container" onload="setChat()">
<div class="col-lg-4 col-md-12 no-pdd pl-5">
<div class="msgs-list">
<div class="msg-title border-bottom border-light">
<h3>Messages</h3>
<ul>
<li><a href="#" title=""><i class="fa fa-cog"></i></a></li>
<li><a href="#" title=""><i class="fa fa-ellipsis-v"></i></a></li>
</ul>
</div>
<div class="messages-list">
<ul id="chatlist" class="overflow-auto" style="height:510px;">
    
</ul>
</div>
</div>
</div>
<div class="col-lg-8 col-md-12 vertical-scrollable pd-right-none pd-left-none pl-1 pr-5">
<div class="main-conversation-box border-left border-light" id="chatbox_main">
<div class="message-bar-head color-change" style="opacity:0.9;">
<div class="usr-msg-details">
<div class="usr-ms-img">
<img id="chatter_user_pic" style="display:none;" src="" alt="" width="60px" height="50px">
</div>
<div class="usr-mg-info">
<h3 id="chatter_user_name"></h3>
<p>Online</p>
</div>
</div>
<a href="#" title=""><i class="fa fa-ellipsis-v"></i></a>
</div>
<div class="d-flex flex-column-reverse w-100 overflow-auto" style="height:482px;" id="user_chat">

</div>
<div class="message-send-area color-change">
<form>
<div class="mf-field">
<input class="bg-light msgInput" type="text" name="message" id="msginput" placeholder="Type a message here">
<button type="submit" id="sendmsg">Send</button>
</div>
</form>
<ul class="w-100 p-1 float-right">

<div class="emoji-picker">
<li class="float-left p-1"><a class="color-change emoji" href="#" title="" onclick="toggleEmojiPopup()"><i class="fas fa-smile"></i></a></li>
    <div class="emoji-picker__popup" id="emojiPopup">
      <ul>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128512;')">&#128512;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128513;')" >&#128513;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128514;')">&#128514;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128515;')">&#128515;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128516;')">&#128516;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128517;')">&#128517;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128518;')">&#128518;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128519;')">&#128519;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128520;')">&#128520;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128521;')">&#128521;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128522;')">&#128522;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128523;')">&#128523;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128524;')">&#128524;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128525;')">&#128525;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128526;')">&#128526;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128527;')">&#128527;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128528;')">&#128528;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128529;')">&#128529;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128530;')">&#128530;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128531;')">&#128531;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128532;')">&#128532;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128533;')">&#128533;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128534;')">&#128534;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128535;')">&#128535;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128536;')">&#128536;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128537;')">&#128537;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128538;')">&#128538;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128539;')">&#128539;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128540;')">&#128540;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128541;')">&#128541;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128542;')">&#128542;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128543;')">&#128543;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128544;')">&#128544;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128545;')">&#128545;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128546;')">&#128546;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128547;')">&#128547;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128548;')">&#128548;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128549;')">&#128549;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128550;')">&#128550;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128551;')">&#128551;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128552;')">&#128552;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128553;')">&#128553;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128554;')">&#128554;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128555;')">&#128555;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128556;')">&#128556;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128557;')">&#128557;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128558;')">&#128558;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128559;')">&#128559;</i></li>
        <li style="cursor:pointer;"><i onclick="insertEmoji('&#128560;')">&#128560;</i></li>
        <!-- Add more emoji images and onclick handlers as needed -->
      </ul>
    </div>
  </div>
<li class="float-left p-1"><a class="color-change" href="#" title=""><i class="fas fa-camera"></i></a></li>
<li class="float-left p-1"><a class="color-change" href="#" title=""><i class="fas fa-paperclip"></i></a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</section>