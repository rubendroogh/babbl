require('./bootstrap');
window.Vue = require('vue');
require('axios');
const moment = require('moment');

$( document ).ready(function() {
	new Vue({
		el: '#app',
		
		data(){
			return {
				search: '',
				chats: [],
			}
		},
	
		created(){
			var options = {
				method: 'GET',
				url: 'http://babbl.local/api/user/groups',
				headers: {
					'Accept': 'application/json',
					'Authorization': "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImUzNTg0ZTExMGEyN2MyNTAwZmJiZmI3YWQ5YTNjNjUxNTFiMWI3MDRkODcyMmJiM2ZjYWQyODVhZDMxYmUwODAwNjA2YjY5YWI4ZTlmMjFkIn0.eyJhdWQiOiIxIiwianRpIjoiZTM1ODRlMTEwYTI3YzI1MDBmYmJmYjdhZDlhM2M2NTE1MWIxYjcwNGQ4NzIyYmIzZmNhZDI4NWFkMzFiZTA4MDA2MDZiNjlhYjhlOWYyMWQiLCJpYXQiOjE1NDE3NjEyODIsIm5iZiI6MTU0MTc2MTI4MiwiZXhwIjoxNTczMjk3MjgxLCJzdWIiOiIyIiwic2NvcGVzIjpbIioiXX0.fkVWTYWwB7LagR_Of-39obMoC_lOx0R_2HwcmPiWIOa0aQ2n0_zZyw98IXpDD5gnFbg5rnYOTBbDGFgvs4U7OpUx8xLxwtDTOoArsj2yy_O9_-MUF1w1hyGBHKnZMEgEksq4AWzy2f-jZhjQJoFIL9JyoKUlaNA6DdIWMKvKKSpAw64vzjcHCGzmVxgup2BPS-7-TNkXVmzQJ4F546p0Zoh9sUnXNjbUvP3nYuJZ6FPoSey20HU5PEbh831IKT94e03afySJOXcX5nYPVbrLZ7heRylIrqLX1yqJKLTUjnm4p94bd8e__qJDtTR5VoJ7gFilmEqCI6lJ6K0wc_apx-TvN5v8vcae_g5IcojCgbLHyERhG4ymJHoQcFFIliZGA9yo97xWIsjs8NUHOJ24JbDMvyQNBuDQ4Zb4JO0_wkEtlpglPiMvmyRf1P8vNLfBHOcnmbdACo0d1OsAgREirjqRTRxAOCJv3zxJ7Y8XUlc83buBZnkC5L2SIog9XfI3RvJGhB_Q8ONHlSPQQvnrz5aIA3E6tgEKHD8p9XBUu9RFMfJsKzywuxKVcZRJOJSAka6blldmu33Vr_WbnACVl_oF7-LQ78i2sRrjMmxX_PPA6kfYMI3jxrws4FwCfd_gaKCO3rZW4cF3iXNQzdm2Ah2ywest1ojh1VsZAJXDHN8"
				},
				json: true
			}
			
			axios(options)
				.then(response => this.chats = response.data);
		},
	
		methods: {
		},
	
		mounted () {
			
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
});

