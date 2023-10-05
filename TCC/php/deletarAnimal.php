<?php
    include '../php/conectaBD.php';
    
    $idAnimal = $_POST['idAnimal'];
    echo $idAnimal;
    
    $queryAnimais = "DELETE FROM animais WHERE idAnimal = $idAnimal";
    $resultadoAnimais = mysqli_query($conexao, $queryAnimais);
    

    if (!$resultadoAnimais) {
        echo "ERRO AO DELETAR CLIENTE: " . mysqli_error($conexao);
    }
    
    header("Location: ../index/cadastro.php?animalDeletado=sucesso");
    exit;
?>
