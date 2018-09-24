// Get Laravel js requirements
require('./bootstrap');

// Set variables
var group_id = $('#group_id').val();

// Scroll down on init
scrollToLastMessage();
messagesRead();

// Pusher listening for messages
var pusher = new Pusher('ea6b376da831c806c735', {
    cluster: 'eu',
    forceTLS: true
});

var channel = pusher.subscribe('messages');

channel.bind('read-messages', function(data) {
    var data = $.parseJSON( data );
    $.each(data, function( key, message ) {
        updateMessageReadStatus(message);
    });  
});

channel.bind('receive-message-' + group_id, function(data) {
    if (data.user_id == document.getElementById('user_id').value) {
        RenderSentMessage(data.message);
        scrollToLastMessage();
    } else{
        RenderReceivedMessage(data.message, data.user_name);
        scrollToLastMessage();
    }
});

// Send message when form submitted
$( "#messageInput" ).submit(function( event ) {
    sendMessage();
    event.preventDefault();
});

// Functions for sending and rendering messages
function sendMessage(){
    var messageInput = $('#message'),
        message      = $('#message').val(),
        user_id      = $('#user_id').val(),
        group_id     = $('#group_id').val(),
        user_name    = $('#user_name').val(),
        _token       = $('[name="_token"]').val();

    if (message != '') {
        $.ajax('/api/message/send', {
            method: 'POST',
            data: {
                message: message,
                group_id: group_id,
                user_id: user_id,
                user_name: user_name,
                _token: _token,
            }
        })
        .then(
            function success(data) {
                messageInput.val('');
            }
        );
    }

    return false;
}

function scrollToLastMessage(){
    var messageContainer = document.getElementById("messages");
    messageContainer.scrollTop = messageContainer.scrollHeight;
}

function RenderReceivedMessage(message, username){
    var messageBox     = document.getElementById('messages'),
        messageWrapper = document.createElement('div'),
        messageBubble  = document.createElement('div'),
        breakElement   = document.createElement('br'),
        userNameBox    = document.createElement('small'),
        dateBox        = document.createElement('small');

    var userNameNode = document.createTextNode(username + ":\n\n"),
        messageNode  = document.createTextNode(message),
        dateNode     = document.createTextNode(getDateInFormat());

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
}

function RenderSentMessage(message){
    var messageBox     = document.getElementById('messages'),
        messageWrapper = document.createElement('div'),
        messageBubble  = document.createElement('div'),
        breakElement   = document.createElement('br'),
        messageNode    = document.createTextNode(message),
        dateBox        = document.createElement('small'),
        dateNode       = document.createTextNode(getDateInFormat());

    messageWrapper.className = 'fullwidth';
    messageBubble.className  = 'message_sent';

    dateBox.appendChild(dateNode);

    messageBubble.appendChild(messageNode);
    messageBubble.appendChild(breakElement);
    messageBubble.appendChild(dateBox);
    messageWrapper.appendChild(messageBubble);

    messageBox.appendChild(messageWrapper);
}

function getDateInFormat(){
    var d = new Date(),
        year    = d.getFullYear(),
        month   = d.getMonth(),
        day     = d.getDate(),
        hours   = d.getHours(),
        minutes = d.getMinutes(),
        seconds = d.getSeconds();

    return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
}

// Message read
function messagesRead(){
    var user_id  = $('#user_id').val(),
        group_id = $('#group_id').val(),
        _token   = $('[name="_token"]').val();

    $.ajax('/api/message/read', {
        method: 'POST',
        data: {
            group_id: group_id,
            user_id: user_id,
            _token: _token,
        }
    });
}

function updateMessageReadStatus(message){
    var messageReadElement = $('#messageRead' + message.id);

    messageReadElement.html('<i class="fas fa-check-double"></i>');
}