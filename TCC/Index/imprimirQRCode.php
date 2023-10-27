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
                <div class="logo">
                    <img src="../img/logo.png" alt="">
                </div>
                <div class="contato">
                    <span>Entre em contato conosco:</span>
                    <div class="flex">
                        <img src="../img/whatsapp.png" alt="">
                        <span>(01) 123654789</span>
                    </div>
                    <div class="flex">
                        <img src="../img/gmail.png" alt="">
                        <span>CACuidadoAnimal@gmail.com</span>
                    </div>
                </div>
                <div class="info">
                    <div class="infoCliente">
                        <span id="nomeCliente"></span>
                        <span id="contatoCliente"></span>
                    </div>
                    <span class="msg">Este QR Code é a chave para informações essenciais. Mantenha-o seguro!</span>
                    <div class="qrCodeContainer" id="qrCodeContainer"></div>
                </div>
                <div class="submit-container">  
                    <div class="btnSubmitDiv">
                        <div class="buttonOptions print-hidden"><button type="button" onclick="print()">IMPRIMIR</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
include '../php/conectaBD.php';
$idCliente = $_GET['idCliente'];
$query = "SELECT Animais.*, Clientes.nome as nome_cliente, Clientes.contato
            FROM Animais
            JOIN Clientes ON Animais.idCliente = Clientes.idCliente
            WHERE Animais.idCliente = '$idCliente'";
$i = 0;
$result = $conexao->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $idAnimal = $row['idAnimal'];
        $nomeAnimal = $row['nome'];
        $nomeCliente = $row['nome_cliente'];
        $contato = $row['contato'];
        $i++;
        $nomeAnimal =  strtoupper($nomeAnimal);
?>
<script>

    var nomeAnimal = document.createElement('span')
    nomeAnimal.classList.add('nomeAnimal')
    nomeAnimal.textContent = '<?php echo $nomeAnimal?>'

    // Script para gerar o QRCode
    var qrCodeContainer = document.getElementById('qrCodeContainer')
    var div = document.createElement('div')
    var spanNome = document.createElement('span')
    div.classList.add("box");
    div.id = "box<?php echo $i?>"
    qrCodeContainer.appendChild(div)
    var img = document.createElement('img')
    img.classList = "qrCodeFoto"
    img.src = 'http://api.qrserver.com/v1/create-qr-code/?data=http://localhost/tcc/TCC/php/scanRedirecionamento.php?idAnimal=<?php echo $idAnimal ?>&size=160x160'
    document.getElementById('box<?php echo $i?>').appendChild(img)

    div.appendChild(nomeAnimal)

</script>

<?php
    }
} else {
    echo "Nenhum animal encontrado.";
}
?>
<script>
        var nomeCliente = document.createElement('span')
        nomeCliente.classList.add('nomeCliente')
        nomeCliente.textContent = '<?php echo $nomeCliente?>' + " - "
        document.querySelector('#nomeCliente').appendChild(nomeCliente)

        var contatoCliente = document.createElement('span')
        contatoCliente.textContent = '<?php echo $contato?>'
        document.querySelector('#contatoCliente').appendChild(contatoCliente)
        
</script>
</html>