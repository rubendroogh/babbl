var pusher = new Pusher('ea6b376da831c806c735', {
    cluster: 'eu',
    forceTLS: true
});

var channel = pusher.subscribe('messages');

channel.bind('receive-message', function(data) {
    if (data.user_id == document.getElementById('user_id').value) {
        document.getElementById('messages').innerHTML += "<div class='fullwidth'><div class='message_sent'>" + data.message + "</div></div>";
    } else{
        document.getElementById('messages').innerHTML += "<div class='fullwidth'><div class='message_received'><small>" + data.user_name + ":\n\n</small>" + data.message + "</div></div>";
    }
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
        },

        function fail(data) {
            console.log(data);
        }
    );
}

