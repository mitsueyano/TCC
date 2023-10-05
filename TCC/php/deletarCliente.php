<?php
    include '../php/conectaBD.php';
    
    $idCliente = $_POST['idCliente'];
    echo $idCliente;
    
    $queryClientes = "DELETE FROM Clientes WHERE idCliente = $idCliente";
    $resultadoAnimais = mysqli_query($conexao, $queryClientes);


    if (!$resultadoAnimais) {
        echo "ERRO AO DELETAR ANIMAL: " . mysqli_error($conexao);
    }
    header("Location: ../index/cadastro.php?clienteDeletado=sucesso");
    exit;
?>
