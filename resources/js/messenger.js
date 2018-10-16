// Get requirements
require('./bootstrap');
require('./messenger/speech');
require('./messenger/notifications');
require('./messenger/read_messages');
require('./messenger/send_receive_messages');

// Scroll down on init
scrollToLastMessage();

function scrollToLastMessage(){
    var messageContainer = document.getElementById("messages");
    messageContainer.scrollTop = messageContainer.scrollHeight;
}
