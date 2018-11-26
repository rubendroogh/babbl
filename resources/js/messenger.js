// Get requirements
require('./bootstrap');
// require('./messenger/speech');
var read_messages = require('./messenger/read_messages');
var notifications = require('./messenger/notifications');
var pusher_connect = require('./messenger/pusher_connect');

if (typeof webkitSpeechRecognition !== 'undefined') {
    var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition
    var SpeechRecognitionEvent = SpeechRecognitionEvent || webkitSpeechRecognitionEvent

    var recognition = new SpeechRecognition();

    recognition.lang = 'nl-NL';
    recognition.interimResults = true;
    recognition.maxAlternatives = 1;
}

window.Vue = require('vue');

var app = new Vue({
    el: '#app',
	
	data(){
		return {
            messages: [],
            inputMessage: '',
            voiceMode: false,
            messagesLoaded: false,
            voiceInput: '',
            imageIsSending: false,
            modalImage: '',
            showImageModal: false,
		}
	},

	created(){
		var options = {
			method: 'GET',
			url: '/groups/' + group_id.value + '/messages',
			json: true
		}
		
		axios(options)
            .then(response => this.messages = response.data);
        this.scrollToBottom();

        this.messagesLoaded = true;
	},

	computed: {
		
    },
    
    methods: {
        sendTextOrVoice: function () {
            if (this.inputMessage == '') {
                this.toggleVoiceUI();
            } else{
                this.sendMessage();
            }
        },
        toggleVoiceUI: function () {
            this.voiceMode = !this.voiceMode;
            if (this.voiceMode) {
                recognition.start();
                var _this = this;
                recognition.onresult = function(event) {
                    _this.voiceInput = event.results[0][0].transcript;
                }
            } else{
                recognition.stop();
            }
        },
        sendMessage: function(){
            var options = {
                method: 'POST',
                url: '/message/send',
                json: true,
                data: {
                    message: this.inputMessage,
                    group_id: $('#group_id').val(),
                    user_id: $('#user_id').val(),
                    message_type: $('#message_type').val()
                }
            }
            var _this = this;

            if ($('#js-message-input').val() != '') {
                axios(options)
                    .then(function(response){
                        _this.messages.push(response.data);
                        _this.inputMessage = '';
                    });
            }
        },
        sendImage() {
            var formData = new FormData();
            formData.append('image', image.files[0], image.files[0].name);
            formData.append('group_id', group_id.value);
            formData.append('user_id', user_id.value);
            formData.append('message_type', 'image');

            var options = {
                method: 'POST',
                url: '/message/send',
                json: true,
                data: formData
            }
            var _this = this;
            this.imageIsSending = true;
            axios(options)
                .then(function(response){
                    _this.messages.push(response.data);
                    _this.imageIsSending = false;
                });
        },
        toggleImageModal(img) {
            this.showImageModal = !this.showImageModal;
            this.modalImage = img;
        },
        scrollToBottom: function () {
            var container = document.getElementById('content-container');
            container.scrollTop = container.scrollHeight;
        }
    },

	filters: {
		formatToTime: function(value) {
			return moment(value).format('HH:mm');
		}
    },
    
    updated(){
        this.scrollToBottom();
    }
});

pusher_connect.channel.bind('receive-message-' + group_id.value, function(data) {
    data = JSON.parse(data);
    if (data.user_id != user_id.value) {
        data.status = 'received';
        app.messages.push(data);
        if (document.hidden) {
            message = { 
                title: data.user_name,
                text: data.message
            };
            notifications.notifyUser(message);
        }
    }
});
