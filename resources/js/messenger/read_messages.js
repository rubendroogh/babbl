messagesRead();

var pusher = new Pusher('ea6b376da831c806c735', {
    cluster: 'eu',
    forceTLS: true
});

var channel = pusher.subscribe('messages');

channel.bind('receive-message-' + group_id, function(data) {
    if (data.user_id != document.getElementById('user_id').value) {
        
    }
});

