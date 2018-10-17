var sendReceive = require('./send_receive_messages');

var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition
var SpeechRecognitionEvent = SpeechRecognitionEvent || webkitSpeechRecognitionEvent

var recognition = new SpeechRecognition();

recognition.lang = 'nl-NL';
recognition.interimResults = false;
recognition.maxAlternatives = 1;

$('#speechButton').click(function() {
    $('#speechOverlay').fadeIn('fast', function(){});
    recognition.start();
});

recognition.onresult = function(event) {
    var input = event.results[0][0].transcript;
    var data = {
        message:   input,
        user_id:   $('#user_id').val(),
        group_id:  $('#group_id').val(),
        user_name: $('#user_name').val(),
        type:      'string'
    }
    $('#speechOverlay').fadeOut('fast', function(){});

    sendReceive.sendMessage(data);
}
