<!DOCTYPE html>
<html>

<head>
    <title>WebSocket Client</title>
    <script>
        var socket = new WebSocket("ws://localhost:6001");

        socket.onopen = function(event) {
            console.log("WebSocket connection opened");

            // Kirim pesan ke server setelah koneksi terbuka
            socket.send(JSON.stringify({
                action: 'hello'
            }));
        };

        socket.onmessage = function(event) {
            console.log("Received message from server:", event.data);
        };

        socket.onclose = function(event) {
            console.log("WebSocket connection closed");
        };

        socket.onerror = function(event) {
            console.error("WebSocket error:", event);
        };
    </script>
</head>

<body>
    <h1>WebSocket Client</h1>
</body>

</html>