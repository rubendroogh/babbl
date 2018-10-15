var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition
var SpeechRecognitionEvent = SpeechRecognitionEvent || webkitSpeechRecognitionEvent

var recognition = new SpeechRecognition();
var startedMessage = 0;

recognition.lang = 'en-US';
recognition.interimResults = false;
recognition.maxAlternatives = 1;

recognition.start();

document.body.onclick = function() {
    recognition.start();
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

        sendMessage(data);
        startedMessage = 0;
    }

    if (input == 'send message') {
        console.log('say your message');
        startedMessage = 1;
    }
}
