<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MQTT Publisher</title>
  <!-- Include Paho MQTT library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
</head>
<body>

<script>
  // Set up MQTT client
  const clientId = 'your_client_id';
  const topic = 'T1234';
  const message = 'Hello, MQTT Kelum!';

  const client = new Paho.MQTT.Client('mmsnoyon.com', 8883, clientId);

  // Set the callback handlers
  client.onConnectionLost = onConnectionLost;
  client.onMessageArrived = onMessageArrived;

  // Connect to the MQTT broker
  const connectOptions = {
    useSSL: true,
    //userName: 'your_username', // if required
    //password: 'your_password', // if required
    onSuccess: onConnect,
    onFailure: onFailure,
  };

  client.connect(connectOptions);

  // Called when the connection is successful
  function onConnect() {
    console.log('Connected to MQTT broker');
    
    // Publish a message
    const messageObject = new Paho.MQTT.Message(message);
    messageObject.destinationName = topic;
    client.send(messageObject);

    console.log(`Message published to ${topic}: ${message}`);

    // Disconnect after publishing (optional)
    client.disconnect();
  }

  // Called when the connection is lost
  function onConnectionLost(responseObject) {
    if (responseObject.errorCode !== 0) {
      console.error(`Connection lost: ${responseObject.errorMessage}`);
    }
  }

  // Called when a message arrives
  function onMessageArrived(message) {
    console.log(`Message received on topic ${message.destinationName}: ${message.payloadString}`);
  }

  // Called when the connection fails
  function onFailure(responseObject) {
    console.error(`Failed to connect: ${responseObject.errorMessage}`);
  }
</script>

</body>
</html>
