window.moment = require('moment');
var pusher_connect = require('./pusher_connect');
var read_messages = require('./read_messages');
var notifications = require('./notifications');

module.exports = {
    sendMessage: function(data){
        sendMessage(data);
    },
    renderReceivedMessage: function(message, username){
        return renderReceivedMessage(message, username)
    },    
    renderSentMessage: function(message, id){
        return renderSentMessage(message, id);
    },    
    scrollToLastMessage: function(){
        return scrollToLastMessage()
    }
};

function sendMessage(data){
    if (message != '') {
        $.ajax('/api/message/send', {
            method: 'POST',
            data: {
                message: data.message,
                group_id: data.group_id,
                user_id: data.user_id,
                user_name: data.user_name,
                message_type: data.type
            }
        })
        .then(
            function success(data) {
                $('#message').val('');
            }
        );
    }

    return false;
}

function renderReceivedMessage(message, username){
    var messageBox     = document.getElementById('messages'),
        messageWrapper = document.createElement('div'),
        messageBubble  = document.createElement('div'),
        breakElement   = document.createElement('br'),
        userNameBox    = document.createElement('small'),
        dateBox        = document.createElement('small');

    var userNameNode = document.createTextNode(username + ":\n\n"),
        messageNode  = document.createTextNode(message),
        dateNode     = document.createTextNode(moment().fromNow()); // This uses moment.js 

    messageWrapper.className = 'fullwidth';
    messageBubble.className  = 'message_received';

    userNameBox.appendChild(userNameNode);
    dateBox.appendChild(dateNode);
    messageBubble.appendChild(userNameBox);
    messageBubble.appendChild(breakElement);
    messageBubble.appendChild(messageNode);
    messageBubble.appendChild(breakElement);
    messageBubble.appendChild(dateBox);
    messageWrapper.appendChild(messageBubble);

    messageBox.appendChild(messageWrapper);   

    return messageBox;
};

function renderSentMessage(message, id){
    var messageBox     = document.getElementById('messages'),
        messageWrapper = document.createElement('div'),
        messageBubble  = document.createElement('div'),
        breakElement   = document.createElement('br'),
        messageNode    = document.createTextNode(message),
        dateBox        = document.createElement('small'),
        dateNode       = document.createTextNode(moment().fromNow() + ' '), // This uses moment.js 
        readBox        = document.createElement('small'),
        readNode       = document.createElement('i');

    messageWrapper.className = 'fullwidth';
    messageBubble.className  = 'message_sent';

    readBox.id = 'messageRead' + id;
    readNode.className = 'fas fa-check';

    dateBox.appendChild(dateNode);
    readBox.appendChild(readNode);

    messageBubble.appendChild(messageNode);
    messageBubble.appendChild(breakElement);
    messageBubble.appendChild(dateBox);
    messageBubble.appendChild(readBox);
    messageWrapper.appendChild(messageBubble);

    messageBox.appendChild(messageWrapper);

    return messageBox;
};

function scrollToLastMessage(){
    var messageContainer = document.getElementById("messages");
    messageContainer.scrollTop = messageContainer.scrollHeight;

    return true;
};

var group_id = $('#group_id').val();

pusher_connect.channel.bind('receive-message-' + group_id, function(data) {
    if (data.user_id == document.getElementById('user_id').value) {
        renderSentMessage(data.message, data.id);
        scrollToLastMessage();
    } else{
        renderReceivedMessage(data.message, data.user_name);
        read_messages.messagesRead();
        scrollToLastMessage();
        notifications.notifyUser(data.message);
    }
});

$( "#messageInput" ).submit(function( event ) {
    var formData = {
        message:   $('#message').val(),
        user_id:   $('#user_id').val(),
        group_id:  $('#group_id').val(),
        user_name: $('#user_name').val(),
        type:      $('#message_type').val()
    }

    sendMessage(formData);
    event.preventDefault();
});

