<html>
   <head>
      <title>JavaScript MQTT WebSocket Example</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
	
        <script type = "text/javascript" language = "javascript">
            var mqtt;
            var reconnectTimeout = 2000;
            var host="mmsnoyon.com";       // Noyon PORT 9001
            //var host="steve-laptop"; //change this
            //var host="test.mosquitto.org";
            //var port=9001;
            var port=8883;
            
            function onConnect() 
            {
                // Once a connection has been made, make a subscription and send a message.
                console.log("Connected ");
                //mqtt.subscribe("sensor1");
                message = new Paho.MQTT.Message("Hello World...Kelum");
                message.destinationName = "T1234";
                mqtt.send(message);
            }
            function MQTTconnect()
            {
		console.log("connecting to "+ host +" "+ port);
                var x=Math.floor(Math.random() * 10000); 
		var cname="orderform-"+x;
		mqtt = new Paho.MQTT.Client(host,port,cname);
		//document.write("connecting to "+ host);
		var options = 
                    {
                        useSSL: true,
                	timeout: 3,
			onSuccess: onConnect,
                    };  		 
		mqtt.connect(options); //connect
            }	 
	  </script>
   </head>
     <body>
   <h1>Main Body</h1>
 	<script>
            MQTTconnect();
	</script>
   </body>	
</html>