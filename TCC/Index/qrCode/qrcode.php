<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR CODE</title>
    <script type="text/javascript" src="qrcode.js"></script>
</head>
<body>
    <input type="text" id="valor">
    <button onclick="createQrCode()">Gerar QR Code</button>
    <div id="qrCode"></div>
</body>
<script>

    function createQrCode(){
        var userInput = document.getElementById('valor').value

        var qrCode = new QRCode("qrCode", {
            text: userInput,
            width: 256,
            height: 256,
            colorDark: "black",
            colorLight: "white",
            correctLevel: QRCode.CorrectLevel.H
        });
    }

</script>
</html>