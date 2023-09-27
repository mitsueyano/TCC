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
    $enderecoRN = $enderecoR . ', ' . $enderecoN;
    $query = "insert into Clientes (nome, email, contato, enderecoE, enderecoC, enderecoB, enderecoRN) values ('$nome', '$email', '$contato', '$enderecoE', '$enderecoC', '$enderecoB', '$enderecoRN')";
    echo $nome, $email, $contato;

    $resultado = mysqli_query($conexao, $query);
    if (!$resultado){
        echo "ERRO AO CADASTRAR";
    }

    
?>