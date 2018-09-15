var pusher = new Pusher('ea6b376da831c806c735', {
    cluster: 'eu',
    forceTLS: true
});

var channel = pusher.subscribe('messages');

channel.bind('receive-message', function(data) {
    if (data.user_id == document.getElementById('user_id').value) {
        RenderSentMessage(data.message);
        scrollToLastMessage();
    } else{
        RenderReceivedMessage(data.message, data.user_name);
        scrollToLastMessage();
    }
});

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
        userNameBox    = document.createElement('small');

    var userNameNode = document.createTextNode(username + ":\n\n"),
        messageNode  = document.createTextNode(message);

    messageWrapper.className = 'fullwidth';
    messageBubble.className  = 'message_received';

    userNameBox.appendChild(userNameNode);
    messageBubble.appendChild(userNameBox);
    messageBubble.appendChild(messageNode);
    messageWrapper.appendChild(messageBubble);

    messageBox.appendChild(messageWrapper);   
}

function RenderSentMessage(message){
    var messageBox = document.getElementById('messages'),
        messageWrapper = document.createElement('div'),
        messageBubble  = document.createElement('div'),
        messageNode = document.createTextNode(message);

    messageWrapper.className = 'fullwidth';
    messageBubble.className  = 'message_sent';

    messageBubble.appendChild(messageNode);
    messageWrapper.appendChild(messageBubble);

    messageBox.appendChild(messageWrapper);
}

