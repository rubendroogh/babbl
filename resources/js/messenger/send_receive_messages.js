window.moment = require('moment');
var pusher_connect = require('./pusher_connect');
var read_messages = require('./read_messages');
var notifications = require('./notifications');

module.exports = {  
    scrollToLastMessage: function(){
        return scrollToLastMessage()
    }
};

function scrollToLastMessage(){
    var messageContainer = document.getElementById("content-container");
    messageContainer.scrollTop = messageContainer.scrollHeight;

    return true;
};

var group_id = $('#group_id').val();
