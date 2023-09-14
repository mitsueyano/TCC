<?php
    include 'conectaBD.php';
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    if (empty($senha) || empty($login)) {
        $msg1 = "CampoVazio";
        $encoded = urlencode($msg1);
        header("Location: Login.php?msg=" . $encoded);
        exit();
    }

    $consulta = "SELECT Acesso.senha, loginusuario FROM Acesso WHERE loginusuario = '$login'";
    $resultado = mysqli_query($conexao, $consulta);

    if ($resultado && mysqli_num_rows($resultado) === 1) {
        $row = mysqli_fetch_assoc($resultado);
        $senhaCriptografada = $row['senha'];
        $loginCorreto = $row['loginusuario'];
        $url = "Inicio.php";

        if ($login === $loginCorreto && password_verify($senha, $senhaCriptografada)) {
            header("Location: " . $url);
            exit();
        }
        else
        {
            $msg2 = "LoginIncorreto";
            $encoded = urlencode($msg2);
            header("Location: Login.php?msg=" . $encoded);
            exit();
        }
    }
    else
    {
        $msg2 = "LoginIncorreto";
        $encoded = urlencode($msg2);
        header("Location: Login.php?msg=" . $encoded);
        exit();
    }
    
?>