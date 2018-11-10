var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
    cluster: 'eu',
    forceTLS: true
})

var channel = pusher.subscribe('messages');

module.exports = {
    pusher: pusher,    
    channel: channel
}