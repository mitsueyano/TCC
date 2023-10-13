<?php
    include '../php/conectaBD.php';
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Mensagem de erro - campos vazios
    if (empty($senha) || empty($login)) {
        $msg1 = "CampoVazio";
        $encoded = urlencode($msg1);
        header("Location: ../Index/Login.php?msg=" . $encoded);
        exit();
    }

    // Script SQL para verificação de login-senha
    $consulta = "SELECT Acesso.senha, loginusuario, idUsuario FROM Acesso WHERE loginusuario = '$login'";
    $resultado = mysqli_query($conexao, $consulta);

    if ($resultado && mysqli_num_rows($resultado) === 1) {
        $row = mysqli_fetch_assoc($resultado);
        $senhaCriptografada = $row['senha'];
        $loginCorreto = $row['loginusuario'];
        $idUsuario = $row['idUsuario'];
        $urlRecep = "../Index/Inicio.php";
        $urlVetArea = "../Index/vetArea/InicioVet.php";

        // Mensagem de erro - Login-Senha incorretos
        if ($login === $loginCorreto && password_verify($senha, $senhaCriptografada)) {
            if ($idUsuario == '3'){
                header("Location: " . $urlRecep);
            }
            else if ($idUsuario == '4'){
                header("Location: " . $urlVetArea);
            }
            exit();
        }
        else
        {
            $msg2 = "LoginIncorreto";
            $encoded = urlencode($msg2);
            header("Location: ../Index/Login.php?msg=" . $encoded);
            exit();
        }
    }
    else
    {
        $msg2 = "LoginIncorreto";
        $encoded = urlencode($msg2);
        header("Location: ../Index/Login.php?msg=" . $encoded);
        exit();
    }
    
?>