messagesRead();

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

