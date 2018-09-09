var pusher = new Pusher('ea6b376da831c806c735', {
    cluster: 'eu',
    forceTLS: true
});

var channel = pusher.subscribe('messages');

channel.bind('receive-message', function(data) {
    if (data.user_id == document.getElementById('user_id').value) {
        RenderSentMessage(data.message);
    } else{
        RenderReceivedMessage(data.message, data.user_name);
    }
});

document.getElementById("messageInput").addEventListener("submit", function(event){
    event.preventDefault();
    SendMessage();
});

function SendMessage(){
    $.ajax('/message/send', {
        method: 'POST',
        data: {
            message: document.getElementById('message').value,
            user_id: document.getElementById('user_id').value,
            user_name: document.getElementById('user_name').value,
            _token: document.getElementsByName('_token')[0].value,
        }
    })
    .then(
        function success(data) {
            document.getElementById('message').value = '';
        }
    );
}

function RenderReceivedMessage(message, username){
    document.getElementById('messages').innerHTML += "<div class='fullwidth'><div class='message_received'><small>" + username + ":\n\n</small>" + message + "</div></div>";
}

function RenderSentMessage(message){
    document.getElementById('messages').innerHTML += "<div class='fullwidth'><div class='message_sent'>" + message + "</div></div>";
}

