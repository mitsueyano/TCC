<?php
include 'conectaBD.php';
$login = $_POST['login'];
$senha = $_POST['senha'];
$consulta = "SELECT senha, nome FROM usuarios WHERE loginusuario = '$login'";
$resultado = mysqli_query($conexao, $consulta);
if ($resultado && mysqli_num_rows($resultado) === 1) {
    $row = mysqli_fetch_assoc($resultado);
    $senhaCriptografada = $row['senha'];
    $nome = $row['nome'];
    $url = "Inicio.php?usuario=" . urlencode($nome);
    if (password_verify($senha, $senhaCriptografada)) {
        header("Location: " . $url);
        exit();
    }
} 
?>