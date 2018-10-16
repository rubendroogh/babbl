var pusher_connect = require('./pusher_connect.js');

module.exports = {
    messagesRead: function(){
        messagesRead();
    },
    updateMessageReadStatus: function(message){
        return updateMessageReadStatus(message);
    }
}

messagesRead();

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
};

function updateMessageReadStatus(message){
    var messageReadElement = $('#messageRead' + message.id);
    messageReadElement.html('<i class="fas fa-check-double"></i>');

    return messageReadElement;
};

pusher_connect.channel.bind('read-messages', function(data) {
    var data = $.parseJSON( data );
    $.each(data, function( key, message ) {
        updateMessageReadStatus(message);
    });  
});
