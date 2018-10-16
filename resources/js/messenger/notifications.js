Notification.requestPermission().then(function(permission) {
    //do something
});

module.exports = {
    notifyUser: function(message){
        notifyUser(message);
    }
}

function notifyUser(message){
    if (!("Notification" in window)) {
        console.log("This browser does not support desktop notification");
    }
    else if (Notification.permission === "granted") {
        var notification = new Notification(message);
    }
    else if (Notification.permission !== "denied") {
        Notification.requestPermission(function (permission) {
            if (permission === "granted") {
                var notification = new Notification(message);
            }
        });
    }
}