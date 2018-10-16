Notification.requestPermission().then(function(permission) {
    //do something
});

module.exports = {
    notifyUser: function(message){
        notifyUser(message);
    }
}

/*
    message contains text and title properties
*/
function notifyUser(message){
    var options = {
        body: message.text,
        icon: '../img/logo192x192.png',
        vibrate: [200, 100, 200]
    };

    if (!("Notification" in window)) {
        console.log("This browser does not support desktop notification");
    }
    else if (Notification.permission === "granted") {
        new Notification(message.title, options);
    }
    else if (Notification.permission !== "denied") {
        Notification.requestPermission(function (permission) {
            if (permission === "granted") {
                new Notification(message.title, options);
            }
        });
    }
}