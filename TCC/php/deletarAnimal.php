<?php
    include '../php/conectaBD.php';
    
    $idAnimal = $_POST['idAnimal'];
    echo $idAnimal;
    
    // Script SQL para deletar animal de acordo com o ID
    $queryAnimais = "DELETE FROM animais WHERE idAnimal = $idAnimal";
    $resultadoAnimais = mysqli_query($conexao, $queryAnimais);
    
    if (!$resultadoAnimais) {
        echo "ERRO AO DELETAR CLIENTE: " . mysqli_error($conexao);
    }
    
    // Redireciona para página "cadastro.php" com a mensagem de sucesso
    header("Location: ../index/cadastro.php?animalDeletado=sucesso");
    exit;
?>
