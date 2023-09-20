<?php
    include '../php/conectaBD.php';
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $contato = $_POST["contato"];
    $cep = $_POST["cep"];
    /*$query = "insert into Clientes (nome, email, contato) values ('$nome', '$email', '$contato')";
    echo $nome, $email, $contato, $cep;

    $resultado = mysqli_query($conexao, $query);
    if (!$resultado){
        echo "ERRO AO CADASTRAR";
    }
*/
echo $nome, $email, $contato, $cep;
?>