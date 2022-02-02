<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>A : <span id="a"></span></h1>
  <h1>B : <span id="b"></span></h1>
  <h1>C : <span id="c"></span></h1>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="paho.javascript-1.0.3/paho-mqtt.js"></script>
<script>
  client = new Paho.MQTT.Client("127.0.0.1", Number(8883), "clientId");
  client.onConnectionLost = onConnectionLost;
  client.onMessageArrived = onMessageArrived;

  client.connect({
    onSuccess: onConnect
  });

  function onConnect() {
    console.log("onConnect");
    client.subscribe("TEST");
    client.subscribe("TEST2");
    // message = new Paho.MQTT.Message("Hello MQTT");
    // message.destinationName = "TEST/MQTT";
    // client.send(message);
  }

  function onConnectionLost(responseObject) {
    if (responseObject.errorCode !== 0) {
      console.log("onConnectionLost:" + responseObject.errorMessage);
    }
  }

  function onMessageArrived(message) {
    let data = JSON.parse(message.payloadString)
    console.log(data);
    $("#a").html(data.a)
    $("#b").html(data.b)
    $("#c").html(data.c)
  }
</script>