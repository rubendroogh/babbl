var pusher = new Pusher('c4229bd9d8566c211080', {
    cluster: 'eu',
    forceTLS: true
})

var channel = pusher.subscribe('messages');

module.exports = {
    pusher: pusher,    
    channel: channel
}