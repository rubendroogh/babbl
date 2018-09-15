<template>
	<div class="fullwidth">
		<div class="message_sent">
			{{ message.content }}
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				message: {
					id: '',
					content: ''
				}
			}
		}
	}
</script>