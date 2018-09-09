var pusher = new Pusher('ea6b376da831c806c735', {
    cluster: 'eu',
    forceTLS: true
});

var channel = pusher.subscribe('messages');

channel.bind('receive-message', function(data) {
    if (data.user_id == document.getElementById('user_id').value) {
        RenderSentMessage(data.message);
        updateScroll();
    } else{
        RenderReceivedMessage(data.message, data.user_name);
        updateScroll();
    }
});

function SendMessage(){
    var messageInput = document.getElementById('message');

    var message   = document.getElementById('message').value;
    var user_id   = document.getElementById('user_id').value;
    var user_name = document.getElementById('user_name').value;
    var _token    = document.getElementsByName('_token')[0].value;

    if (message != '') {
        $.ajax('/message/send', {
            method: 'POST',
            data: {
                message: message,
                user_id: user_id,
                user_name: user_name,
                _token: _token,
            }
        })
        .then(
            function success(data) {
                messageInput.value = '';
            }
        );
    }

    return false;
}

function updateScroll(){
    var element = document.getElementById("messages");
    element.scrollTop = element.scrollHeight;
}

function RenderReceivedMessage(message, username){
    var messageBox = document.getElementById('messages');

    var messageWrapper = document.createElement('div');
    var messageBubble  = document.createElement('div');
    var userNameBox    = document.createElement('small');

    var userNameNode = document.createTextNode(username + ":\n\n");
    var messageNode  = document.createTextNode(message);

    messageWrapper.className = 'fullwidth';
    messageBubble.className  = 'message_received';

    userNameBox.appendChild(userNameNode);
    messageBubble.appendChild(userNameBox);
    messageBubble.appendChild(messageNode);
    messageWrapper.appendChild(messageBubble);

    messageBox.appendChild(messageWrapper);
}

function RenderSentMessage(message){
    var messageBox = document.getElementById('messages');

    var messageWrapper = document.createElement('div');
    var messageBubble  = document.createElement('div');

    var messageNode = document.createTextNode(message);

    messageWrapper.className = 'fullwidth';
    messageBubble.className  = 'message_sent';

    messageBubble.appendChild(messageNode);
    messageWrapper.appendChild(messageBubble);

    messageBox.appendChild(messageWrapper);
}

