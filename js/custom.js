//for preview the post image
var input = document.querySelector("#select_post_img");
if(input){
    input.addEventListener("change", preview);
}


function preview() {
    var fileobject = this.files[0];
    var filereader = new FileReader();

    filereader.readAsDataURL(fileobject);

    filereader.onload = function () {
        var image_src = filereader.result;
        var image = document.querySelector("#post_img");
        image.setAttribute('src', image_src);
        image.setAttribute('style', 'display:');
    }
    
}

//for preview the post video
var input = document.querySelector("#select_post_vid");
if(input){
    input.addEventListener("change", previewVid);
}


function previewVid() {
    var fileobject = this.files[0];
    var filereader = new FileReader();

    filereader.readAsDataURL(fileobject);

    filereader.onload = function () {
        var vid_src = filereader.result;
        var video = document.querySelector("#post_vid");
        video.setAttribute('src', vid_src);
        video.setAttribute('style', 'display:');
    }
    
}

//for follow the user

$(".followbtn").click(function () {
    var user_id_v = $(this).data('userId');
    var button = this;
    var button = this;
    $(button).removeClass("la-plus");

    $.ajax({
        url: 'assets/php/ajax.php?follow',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        success: function (response) {
            console.log(response);
            if (response.status) {
                $(button).data('userId', 0);
                $(button).replaceWith('<i style="color:#fff; font-size:22px; border-radius: 15px; background-color: #0CA678;" class="la la-check-circle"></i>');
            
            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');
            }
        }
    });
});

//for Follow the user from profile page
$(".followbtn2").click(function () {
    var user_id_v = $(this).data('userId');
    var button = this;
    var button = this;

    $.ajax({
        url: 'assets/php/ajax.php?follow',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        success: function (response) {
            console.log(response);
            if (response.status) {
                $(button).data('userId', 0);
                $(button).replaceWith('<a href="#" title="" class="flww">Following</a>');
                $('.optuf').attr('style',"display:");
            } else {
                $(button).attr('style', 'pointer-events:');

                alert('something is wrong,try again after some time');
            }
        }
    });
});

//for like the post
$(".like_btn").click(function () {
    var post_id_v = $(this).data('postId');
    var button = this;
    $(button).attr('disabled', true);
    $.ajax({
        url: 'assets/php/ajax.php?like',
        method: 'post',
        dataType: 'json',
        data: { post_id: post_id_v },
        success: function (response) {
            //console.log(response);
            if (response.status) {

                $(button).attr('disabled', false);
                $(button).hide()
                $(button).siblings('.unlike_btn').show();
                $('#likecount' + post_id_v).text($('#likecount' + post_id_v).text() - (-1));
                //location.reload();

            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');

            }


        }
    });
});

$(".unlike_btn").click(function () {
    var post_id_v = $(this).data('postId');
    var button = this;
    $(button).attr('disabled', true);
    $.ajax({
        url: 'assets/php/ajax.php?unlike',
        method: 'post',
        dataType: 'json',
        data: { post_id: post_id_v },
        success: function (response) {

            if (response.status) {

                $(button).attr('disabled', false);
                $(button).hide()
                $(button).siblings('.like_btn').show();
                //location.reload();
                $('#likecount' + post_id_v).text($('#likecount' + post_id_v).text() - 1);

            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');


            }



        }
    });
});

//for adding comment
$(".add-comment").click(function () {
    var button = this;


    if (comment_v == '') {
        return 0;
    }
    var post_id_v = $(this).data('postId');
    var cs = $(this).data('cs');
    var page = $(this).data('page');
    var comment_v = $('.comment-input'+post_id_v).val();


    $(button).attr('disabled', true);
    $('.comment-input'+post_id_v).attr('disabled', true);
    $.ajax({
        url: 'assets/php/ajax.php?addcomment',
        method: 'post',
        dataType: 'json',
        data: { post_id: post_id_v, comment: comment_v },
        success: function (response) {
            console.log(response);
            if (response.status) {

                $(button).attr('disabled', false);
                $('.comment-input'+post_id_v).attr('disabled', false);
                $('.comment-input'+post_id_v).val('');
                $("#" + cs).prepend(response.comment);
                if (page == 'wall') {
                    location.reload();
                }

            } else {
                $(button).attr('disabled', false);
                $('.comment-input'+post_id_v).attr('disabled', false);

                alert('something is wrong,try again after some time');


            }



        }
    });
});

//Notifications
$("#show_not").click(function () {

    $.ajax({
        url: 'assets/php/ajax.php?notread',
        method: 'post',
        dataType: 'json',
        success: function (response) {

            if (response.status) {
                $(".un-count").attr('style','display:none;');
            }



        }
    });

});

function getNotifications(){
    $.ajax({
        url: "assets/php/ajax.php?getNotifications",
        method: 'post',
        dataType: "json",
        success: function(response) {
            if(response.status){
                $(".un-count").attr('style','display:');
                $(".un-count").text(response.status);
            }else{
                $(".un-count").attr('style','display:none;');
            }
        },
        error: function() {
            console.log("Error retrieving notifications");
        }
    });
}

getNotifications();

$(document).ready(setInterval(()=>{
    getNotifications();
}, 1000));


//Searching
var sr = false;

$("#search").focus(function () {
    $("#search_result").show();


});



$("#close_search").click(function () {
    $("#search_result").hide();
});

$("#search").keyup(function () {
    var keyword_v = $(this).val();

    $.ajax({
        url: 'assets/php/ajax.php?search',
        method: 'post',
        dataType: 'json',
        data: { keyword: keyword_v },
        success: function (response) {
            console.log(response);
            if (response.status) {
                $("#sra").html(response.users);

            } else {


                $("#sra").html('<p class="text-center text-muted">no user found !</p>');




            }



        }
    });

});

//Messaging
$("#sendmsg").click(function () {
    var user_id = chatting_user_id;
    var msg = $("#msginput").val();
    console.log(user_id);
    if (!msg) return;

    $("#sendmsg").attr("disabled", true);
    $("#msginput").attr("disabled", true);
    $.ajax({
        url: 'assets/php/ajax.php?sendmessage',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id, msg: msg },
        success: function (response) {
            if (response.status) {
                $("#sendmsg").attr("disabled", false);
                $("#msginput").attr("disabled", false);
                $("#msginput").val('');
            } else {
                alert('someting went wrong, try again after some time');
            }



        }
    });

});

//send message function for other pages
function sendMsg(chId){
    var user_id = chId;
    var msg = $('.msgText'+chId).val();
    console.log(msg);
    if (!msg) return;

    $("#sendMsgWall").attr("disabled", true);
    $("#msgText").attr("disabled", true);
    $.ajax({
        url: 'assets/php/ajax.php?sendmessage',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id, msg: msg },
        success: function (response) {
            if (response.status) {
                $("#sendMsgWall").attr("disabled", false);
                $("#msgText").attr("disabled", false);
                $("#msgText").val('');
            } else {
                alert('someting went wrong, try again after some time');
            }
           
            setTimeout(function(){
                window.location.href = "./?messages";
              }, 1000);
        }
    });
}

//For Mobile screen
window.onresize = function() {
    let min_width = $(window).width();
    if(min_width<1000){
        $('#mobScreen').attr('style','display:none')
    }else{
        $('#mobScreen').attr('style','display:');
    }
};


//document mobile screen
//For Mobile screen
window.onload = function() {
    let min_width = $(window).width();
    if(min_width<1000){
        document.getElementById('mobScreen').style.display = 'none';
    }else{
        document.getElementById('mobScreen').style.display = '';
    }
};
//dark Theme

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

document.addEventListener('DOMContentLoaded', () => {

    let mode = getCookie('Mode');
    console.log(mode);
    const themeStylesheet = document.getElementById('theme');
    const themeToggle = document.getElementById('theme-toggle');
    if(mode=="Light"){
        themeStylesheet.href = 'css/style.css';
        themeToggle.innerText = 'Switch to dark mode';
    } else if(mode=="Dark"){
        themeStylesheet.href = 'css/dark.css';
        themeToggle.innerText = 'Switch to light mode';
    }
    themeToggle.addEventListener('click', () => {
        // if it's light -> go dark
        if(themeStylesheet.href.includes('style')){
            themeStylesheet.href = 'css/dark.css';
            themeToggle.innerText = 'Switch to light mode';
            document.cookie = "Mode=Dark; expires=Wed, 31 May 2023 12:00:00 UTC; path=/";
        } else {
            // if it's dark -> go light
            themeStylesheet.href = 'css/style.css';
            themeToggle.innerText = 'Switch to dark mode';
            document.cookie = "Mode=Light; expires=Wed, 31 May 2023 12:00:00 UTC; path=/";
        }
    })
});

//Play Sound
function playSound()
{
    var audio = new Audio('./sounds/message.mp3');
    audio.play();
}
var i=0;
//Message notifications
function getUnreadMessageCount(){
    $.ajax({
        url: "assets/php/ajax.php?getUnreadMessageCount",
        method: 'post',
        dataType: "json",
        success: function(response) {
            if(response.status){
                i++;
                console.log(response.status);
                $(".msg-count").attr('style','display:');
                $(".msg-count").text(response.status);
                if(i==1) playSound();
            }else{
                $(".msg-count").attr('style','display:none;');
            }
        },
        error: function() {
            console.log("Error retrieving Message Count");
        }
    });
}

$(document).ready(setInterval(()=>{
    getUnreadMessageCount();
}, 1000));

var chatting_user_id=first_chat;
var first_chat;


chatTab();

//Sync Messages
function synmsg() {
    $.ajax({
        url: "assets/php/ajax.php?getmessages",
        method: 'post',
        dataType: "json",
        data: {chatter_id: chatting_user_id},
        success: function(response) {
                $("#chatlist").html(response.chatlist);
                $("#user_chat").html(response.chat.msgs);
                if(response.chat.userdata){
                    $("#chatter_user_name").text(response.chat.userdata.first_name+" "+response.chat.userdata.last_name);
                    $("#chatter_user_pic").attr('src','images/profile_pic/'+response.chat.userdata.profile_pic);
                    $("#chatter_user_pic").attr('style','display:""');
                }
                first_chat = response.first_chat;
                console.log(first_chat);
        },
        error: function() {
            console.log("Error retrieving Message Count");
        }
    });
}

synmsg();

$(document).ready(setInterval(()=>{
    synmsg();
}, 1000));

function chatTab(id){
    $('#chatbox_main').attr('style','display:""')
    chatting_user_id = id;
    console.log(chatting_user_id);
    i=0;
}

if (window.location.href.match('./?messages') != null)
    window.onload =  function setChat(){
    setTimeout(function(){
        chatTab(first_chat);
      }, 2000);
}

//Save Posts
function savePost(postid){
    $.ajax({
        url: "assets/php/ajax.php?savepost",
        method: 'post',
        dataType: "json",
        data: {post_id: postid},
        success: function(response) {
                $("#saveIcon"+postid).attr('style','display:none');
                $("#savedIcon"+postid).attr('style','display:');
                console.log("#saveIcon"+postid);
               
        },
        error: function() {
            console.log("Error retrieving Message Count");
        }
    });
}