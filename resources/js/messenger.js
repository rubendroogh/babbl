// Get requirements
require('./bootstrap');
// require('./messenger/speech');
var read_messages = require('./messenger/read_messages');
var notifications = require('./messenger/notifications');
var pusher_connect = require('./messenger/pusher_connect');

window.Vue = require('vue');

var app = new Vue({
    el: '#app',
	
	data(){
		return {
            messages: [],
            inputMessage: ''
		}
	},

	created(){
        var group_id = $('#group_id').val();
		var options = {
			method: 'GET',
			url: '/groups/' + group_id + '/messages',
			json: true
		}
		
		axios(options)
            .then(response => this.messages = response.data);
        this.scrollToBottom();
            
        $('.messages').removeClass('hidden');
        $('.no-messages').removeClass('hidden');
        $('#js-loading').addClass('hidden');
	},

	computed: {
		
    },
    
    methods: {
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
