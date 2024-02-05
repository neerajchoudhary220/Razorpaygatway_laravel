<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UT/title">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pusher</title>

</head>

<body>
    <b>Event</b> <span id="eventName"></span><br>
    <b>Msg:</b><p id="msg"></p>
</body>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
      Pusher.logToConsole = true;

var pusher = new Pusher('4639cab0086e6184381f', {
  cluster: 'ap2'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
    console.log(data);
    document.getElementById('eventName').innerText = data.event;
document.getElementById('msg').innerText =data.data;
// console.log(`data:`,data);

});
</script>

</html>
