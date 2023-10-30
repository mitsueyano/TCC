<?php
    $msg1 = "LoginIncorreto";
    $msg2 = "CampoVazio";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Css/Login.css">
</head>
<body>
    <div class="container">
        <form action="../php/conectaLogin.php" method="post" class="login-box">
        <div class="logo">
            <img src="../img/logo.png" alt="logo">
        </div>
            <?php
            if (isset($_GET['msg']) && $_GET['msg'] === $msg1):
            ?>
            <img src="../Img/warning.png" alt="warning-icon" class="warning">
            <span class="msg">Login ou Senha incorretos. Tente Novamente.</span>
            <?php 
                endif;
            ?>
            <label class="span-form">LOGIN:</label>
            <div class="input-with-image">
                <img src="../Img/user.png" alt="user-icon" class="img-input">
                <input type="text" name="login" class="input-form" placeholder="<?php echo isset($_GET['msg']) && $_GET['msg'] === $msg2 ? 'Campo obrigatório.' : ''; ?>">
            </div>
            <label class="span-form">SENHA:</label>
            <div class="input-with-image">
                <img src="../Img/password.png" alt="padlock-icon" class="img-input">
                <input type="password" name="senha" class="input-form" placeholder="<?php echo isset($_GET['msg']) && $_GET['msg'] === $msg2 ? 'Campo obrigatório.' : ''; ?>">
            </div>
            <input type="submit" value="Entrar" class="submit-form"> 
        </form>
    </div>
</body>
</html>