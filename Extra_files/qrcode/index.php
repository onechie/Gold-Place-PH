<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://unpkg.com/html5-qrcode"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/styles/qr-code.css">
    <link rel="stylesheet" href="../../assets/styles/default.css">
    <title>Document</title>
</head>

<body>
    <div id="qr-reader" class='w-auto border-0 fw-light'>
    </div>
    <script>
        var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
            fps: 20,
            qrbox: 200,
        });

        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code scanned = ${decodedText}`, decodedResult);
            alert(decodedText);
        }
        
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>

</html>