Notification.requestPermission().then(function(permission) {
    //do something
});
 function notifyUser(){
    if (!("Notification" in window)) {
        alert("This browser does not support desktop notification");
    }
     else if (Notification.permission === "granted") {
        var notification = new Notification("Hee Henk!");
    }
     else if (Notification.permission !== "denied") {
        Notification.requestPermission(function (permission) {
            if (permission === "granted") {
                var notification = new Notification("Hi there!");
            }
        });
    }
}
 $( "#notify" ).click(function( event ) {
    notifyUser();
    event.preventDefault();
});