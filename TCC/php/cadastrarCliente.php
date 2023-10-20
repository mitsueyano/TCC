<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR CODE</title>
    <link rel="stylesheet" type="text/css" href="../Css/cadastrarCliente.css" media="all">
    <script type="text/javascript" src="../Index/qrCode/qrcode.js"></script>
</head>
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
<script>
    <?php
    include '../php/conectaBD.php';
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $contato = $_POST["contato"];
    $enderecoE = $_POST["estado"];
    $enderecoC = $_POST["cidade"];
    $enderecoB = $_POST["bairro"];
    $enderecoR = $_POST["rua"];
    $enderecoN = $_POST["numero"];
    $enderecoRN = $enderecoR . ', ' . $enderecoN; //Adiciona rua e número em uma mesma string
    $i = 0;
    
    ?>
    document.addEventListener("DOMContentLoaded", function(){
    
        <?php
        $queryCliente = "INSERT INTO Clientes (nome, email, contato, enderecoE, enderecoC, enderecoB, enderecoRN) VALUES ('$nome', '$email', '$contato', '$enderecoE', '$enderecoC', '$enderecoB', '$enderecoRN')"; //Query para cadastrar cliente
        $resultadoCliente = mysqli_query($conexao, $queryCliente);

        if (!$resultadoCliente) {
            echo "ERRO AO CADASTRAR CLIENTE: " . mysqli_error($conexao);
        } else {
            $idCliente = mysqli_insert_id($conexao); // Obtém o ID do cliente gerado automaticamente para inserir nos animais correspondentes
            $animaisJson = $_POST["animaisJson"]; // Recebe uma string JSON
            $animais = json_decode($animaisJson, true); // Transforma a string JSON recebida em uma esrutura PHP

            foreach ($animais as $animal) { //Percorre por cada índice da matriz e seus respectivos arrays
                $nomeAnimal = $animal[0];
                $especie = $animal[1];
                $raca = $animal[2];
                $dataNascto = $animal[3];

                $queryAnimal = "INSERT INTO Animais (idCliente, nome, especie, raca, dataNascto) VALUES ($idCliente, '$nomeAnimal', '$especie', '$raca', '$dataNascto')"; //Query para cadastrar animal
                $resultadoAnimal = mysqli_query($conexao, $queryAnimal);
                
                if (!$resultadoAnimal) {
                    echo "ERRO AO CADASTRAR ANIMAL: " . mysqli_error($conexao);
                }
                $i++

        ?>
                // Script para gerar o QRCode
                var qrCodeContainer = document.getElementById('qrCodeContainer')
                var div = document.createElement('div')
                var spanNome = document.createElement('span')
                div.classList.add("box");
                div.id = "box<?php echo $i?>"
                qrCodeContainer.appendChild(div)

                var userInput = "<?php echo 'animal: ' . $nomeAnimal . ' dono: ' . $nome?>";
                qrCode = new QRCode("box<?php echo $i?>", {
                    text: userInput,
                    width: 180,
                    height: 180,
                    colorDark: "black",
                    colorLight: "white",
                    correctLevel: QRCode.CorrectLevel.H
                });

        <?php
            }
        }
    ?>

    });

</script>
</html>