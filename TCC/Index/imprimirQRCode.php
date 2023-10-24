<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR CODE</title>
    <link rel="stylesheet" type="text/css" href="../Css/imprimirQRCode.css" media="all">
<body>
    <div class="border-page">
        <div class="page">
            <div id="container">
                <div class="qrCodeContainer" id="qrCodeContainer"></div>
                <div class="submit-container">  
                    <div class="btnSubmitDiv">
                        <div class="buttonOptions"><button type="button" onclick="print()">IMPRIMIR</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
include '../php/conectaBD.php';
$idCliente = $_GET['idCliente'];
$query = "Select * from Animais where idCliente = '$idCliente'";
$i = 0;
$result = $conexao->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $idAnimal = $row['idAnimal'];
        $i++;

?>
<script>
 // Script para gerar o QRCode
 var qrCodeContainer = document.getElementById('qrCodeContainer')
                var div = document.createElement('div')
                var spanNome = document.createElement('span')
                div.classList.add("box");
                div.id = "box<?php echo $i?>"
                qrCodeContainer.appendChild(div)
                var img = document.createElement('img')
                img.src = 'http://api.qrserver.com/v1/create-qr-code/?data=http://localhost/tcc/TCC/php/scanRedirecionamento.php?idAnimal=<?php echo $idAnimal ?>&size=160x160'
                document.getElementById('box<?php echo $i?>').appendChild(img)
</script>

<?php
    }
} else {
    echo "Nenhum animal encontrado.";
}

?>
</html>