<template>
    <div>
        <div class="menu-icon" v-on:click="toggleMenu" :class="{open : menuOut}">
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
        </div>
        <div class="mobile-menu-overlay" :class="{'overlay-darken' : menuOut}" v-on:click="toggleMenu"></div>
        <nav class="mobile-menu" :class="{'menu-out' : menuOut}">
            <ul>
                <li v-for="item in menuItems">
                    <a :href="item.href">{{item.name}}</a>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
export default {
    props: {
        menuItems: {
            type: Array
        }
    },

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
