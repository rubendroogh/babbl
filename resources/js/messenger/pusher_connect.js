module.exports = {
    pusher: new Pusher('ea6b376da831c806c735', {
        cluster: 'eu',
        forceTLS: true
    }),    
    channel: pusher.subscribe('messages')
}