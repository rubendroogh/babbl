var sendReceive = require('./send_receive_messages');

var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition
var SpeechRecognitionEvent = SpeechRecognitionEvent || webkitSpeechRecognitionEvent

var recognition = new SpeechRecognition();
var startedMessage = 0;

recognition.lang = 'nl-NL';
recognition.interimResults = false;
recognition.maxAlternatives = 1;

recognition.start();

document.body.onclick = function() {
    try {
        recognition.start();
    }
    catch(e) {}
}

recognition.onresult = function(event) {
    var input = event.results[0][0].transcript;

    if (startedMessage == 1) {
        var data = {
            message:   input,
            user_id:   $('#user_id').val(),
            group_id:  $('#group_id').val(),
            user_name: $('#user_name').val(),
            type:      'string'
        }

        sendReceive.sendMessage(data);
        startedMessage = 0;
    }

    if (input == 'stuur bericht') {
        startedMessage = 1;
    }
}
