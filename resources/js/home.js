require('./bootstrap');
require('axios');
window.Vue = require('vue');
const moment = require('moment');

new Vue({
	el: '#app',
	
	data(){
		return {
			search: '',
			chats: [],
			menuOut: false
		}
	},

	created(){
		var options = {
			method: 'GET',
			url: '/user/groups',
			json: true
		}
		
		axios(options)
			.then(response => this.chats = response.data);
		
		$('.group').removeClass('hidden');
		$('.no-result').removeClass('hidden');
		$('#js-loading').addClass('hidden');
	},

	methods: {
		toggleMenu() {
			this.menuOut = !this.menuOut;
		}
	},

	computed: {
		filteredList() {
			return this.chats.filter(chat => {
				return chat.name.toLowerCase().includes(this.search.toLowerCase())
			})
		}
	},

	filters: {
		formatToTime: function(value) {
			return moment(value).format('HH:mm');
		}
	}
});

