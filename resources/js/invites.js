require('./bootstrap');

window.Vue = require('vue');
Vue.component('main-menu', require('./components/MainMenu.vue'));

new Vue({
	el: '#app',
});
