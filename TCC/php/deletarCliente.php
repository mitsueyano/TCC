<?php
    include '../php/conectaBD.php';
    
    $idCliente = $_POST['idCliente'];
    echo $idCliente;

    // Script SQL para deletar cliente de acordo com o ID
    $queryClientes = "DELETE FROM Clientes WHERE idCliente = $idCliente";
    $resultadoAnimais = mysqli_query($conexao, $queryClientes);


    if (!$resultadoAnimais) {
        echo "ERRO AO DELETAR ANIMAL: " . mysqli_error($conexao);
    }
    // Redireciona para página "cadastro.php" com a mensagem de sucesso
    header("Location: ../index/cadastro.php?clienteDeletado=sucesso");
    exit;
?>
