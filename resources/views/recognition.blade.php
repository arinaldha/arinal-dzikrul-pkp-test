<!DOCTYPE html>
<html>

<head>
    <title>Face Recognition Client</title>
    <script>
        function recognizeFace() {
            var fileInput = document.getElementById('fileInput');
            var file = fileInput.files[0];
            var formData = new FormData();
            formData.append('image', file);

            fetch('/api/recognize', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // Handle response from API
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
</head>

<body>
    <input type="file" id="fileInput">
    <button onclick="recognizeFace()">Recognize Face</button>
</body>

</html>