var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition
var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList
var SpeechRecognitionEvent = SpeechRecognitionEvent || webkitSpeechRecognitionEvent

var commands = [ 'send' ];
var grammar = '#JSGF V1.0; grammar commands; public <command> = ' + commands.join(' | ') + ' ;'

var recognition = new SpeechRecognition();
var speechRecognitionList = new SpeechGrammarList();

speechRecognitionList.addFromString(grammar, 1);

recognition.grammars = speechRecognitionList;
recognition.lang = 'en-US';
recognition.interimResults = false;
recognition.maxAlternatives = 1;

recognition.start();

document.body.onclick = function() {
    recognition.start();
}

recognition.onresult = function(event) {
    var input = event.results[0][0].transcript;
    var startedMessage = 0;
    recognition.stop();

    if (startedMessage == 1) {
        console.log('messagesend');
        console.log(event.results[0][0].transcript);
    }

    if (input == 'send message') {
        console.log('say your message');
        startedMessage = 1;
        recognition.start();
    }

    console.log(event.results[0][0].transcript);
}

recognition.onspeechend = function() {
    recognition.stop();
}