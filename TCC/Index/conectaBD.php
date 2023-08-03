<?php 
$server = 'localhost';
$user = 'root';
$password = '';
$banco = 'veterinario';
$conexao = mysqli_connect($server, $user, $password, $banco);
if(!$conexao)
{
    echo "Não conectado ao banco de dados"; 
}
?>