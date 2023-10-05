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
    header("Location: ../index/cadastro.php");
    exit;
?>