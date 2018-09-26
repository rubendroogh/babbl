var pusher = new Pusher('ea6b376da831c806c735', {
    cluster: 'eu',
    forceTLS: true
});

var channel = pusher.subscribe('messages');
var group_id = $('#group_id').val();

channel.bind('receive-message-' + group_id, function(data) {
    if (data.user_id == document.getElementById('user_id').value) {
        RenderSentMessage(data.message);
        scrollToLastMessage();
    } else{
        RenderReceivedMessage(data.message, data.user_name);
        scrollToLastMessage();
    }
});

$( "#messageInput" ).submit(function( event ) {
    sendMessage();
    event.preventDefault();
});

function sendMessage(){
    var messageInput = $('#message'),
        message      = $('#message').val(),
        user_id      = $('#user_id').val(),
        group_id     = $('#group_id').val(),
        user_name    = $('#user_name').val();

    if (message != '') {
        $.ajax('/api/message/send', {
            method: 'POST',
            data: {
                message: message,
                group_id: group_id,
                user_id: user_id,
                user_name: user_name
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

function scrollToLastMessage(){
    var messageContainer = document.getElementById("messages");
    messageContainer.scrollTop = messageContainer.scrollHeight;
}