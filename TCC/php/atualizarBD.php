<?php
include '../php/conectaBD.php';
$clienteId = $_POST["idCliente"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$contato = $_POST["contato"];
$enderecoE = $_POST["estado"];
$enderecoC = $_POST["cidade"];
$enderecoB = $_POST["bairro"];
$enderecoR = $_POST["rua"];
$enderecoN = $_POST["numero"];
$enderecoRN = $enderecoR . ', ' . $enderecoN;

$queryAtualizarCliente = "UPDATE Clientes SET 
    nome = '$nome',
    email = '$email',
    contato = '$contato',
    enderecoE = '$enderecoE',
    enderecoC = '$enderecoC',
    enderecoB = '$enderecoB',
    enderecoRN = '$enderecoRN'
WHERE idCliente = $clienteId";

$resultadoAtualizarCliente = mysqli_query($conexao, $queryAtualizarCliente);
if (!$resultadoAtualizarCliente) {
    echo "ERRO AO CADASTRAR CLIENTE: " . mysqli_error($conexao);
}
?>