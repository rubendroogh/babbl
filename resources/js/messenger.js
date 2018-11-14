// Get requirements
require('./bootstrap');
// require('./messenger/speech');
var read_messages = require('./messenger/read_messages');
var notifications = require('./messenger/notifications');
var pusher_connect = require('./messenger/pusher_connect');

function scrollToLastMessage(){
    var messageContainer = document.getElementById("content-container");
    messageContainer.scrollTop = messageContainer.scrollHeight;
}

window.Vue = require('vue');

var app = new Vue({
    el: '#app',
	
	data(){
		return {
			messages: [],
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
                    message: $('#js-message-input').val(),
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
                        $('#js-message-input').val('');
                        scrollToLastMessage();
                    });
            }
        }
    },

	filters: {
		formatToTime: function(value) {
			return moment(value).format('HH:mm');
		}
    },
    
    updated(){
        var container = document.getElementById('app');
        container.scrollTop = container.scrollHeight;
    }
});

pusher_connect.channel.bind('receive-message-' + group_id, function(data) {
    console.log('message');
    if (data.user_id != document.getElementById('user_id').value) {
        app.messages.push(data);
        // read_messages.messagesRead();
        // scrollToLastMessage();
        if (document.hidden) {
            message = { 
                title: data.user_name,
                text: data.message
            };
            notifications.notifyUser(message);
        }
    }
});
