// Get requirements
require('./bootstrap');
require('./messenger/send_receive_messages');
require('./messenger/speech');

// Scroll down on init
scrollToLastMessage();

function scrollToLastMessage(){
    var messageContainer = document.getElementById("messages");
    messageContainer.scrollTop = messageContainer.scrollHeight;
}
