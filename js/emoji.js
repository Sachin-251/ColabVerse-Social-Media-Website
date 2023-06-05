function toggleEmojiPopup() {
    var popup = document.getElementById("emojiPopup");
    popup.classList.toggle("visible");
}

function insertEmoji(emoji) {
    var message = document.getElementById("msginput");
    message.value += emoji;
}