<template>
    <div>
        <div class="menu-icon" v-on:click="toggleMenu" :class="{open : menuOut}">
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
        </div>
        <div class="mobile-menu-overlay" :class="{'overlay-darken' : menuOut}" v-on:click="toggleMenu"></div>
        <nav class="mobile-menu" :class="{'menu-out' : menuOut}">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Invites</a></li>
                <li><a href="">User settings</a></li>
                <li><a href="">Logout</a></li>
            </ul>
        </nav>
    </div>
</template>
<script>
export default {
    data(){
		return {
			menuOut: false
		}
	},

	methods: {
		toggleMenu() {
			this.menuOut = !this.menuOut;
		}
	}
}
</script>
