var pusher = new Pusher('ea6b376da831c806c735', {
    cluster: 'eu',
    forceTLS: true
})

var channel = pusher.subscribe('messages');

module.exports = {
    pusher: pusher,    
    channel: channel
}