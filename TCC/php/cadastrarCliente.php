<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR CODE</title>
    <script type="text/javascript" src="../Index/qrCode/qrcode.js"></script>
</head>
<body>
    <div id="qrCode"></div>
    <button type="button" onclick="imprimir()"> Imprimir </button>
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
    
    ?>

    document.addEventListener("DOMContentLoaded", function(){
    
        // Script para criar o QRCode
            var userInput = '<?php echo $nome?>';

            qrCode = new QRCode("qrCode", {
                text: userInput,
                width: 256,
                height: 256,
                colorDark: "black",
                colorLight: "white",
                correctLevel: QRCode.CorrectLevel.H
            });
    });
    function imprimir(){

        var pegarDados = document.getElementById('qrCode').innerHTML
        var janela = window.open('', '', 'width=800, height=600');
        janela.document.write('<html> <head>');
        janela.document.write('<title> PDF </title> </head>');
        janela.document.write('<body>');
        janela.document.write(pegarDados);
        janela.document.write('</body> </hmtl>');
        janela.document.close();
        janela.print();

    }

    // REMOVER
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
            }
        }

        exit;
    ?>
</script>
</html>