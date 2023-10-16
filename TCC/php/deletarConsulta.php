<?php
    include 'conectaBD.php';
    $idConsulta = $_POST['idConsulta'];


    // Script SQL para deletar consulta de acordo com o ID
    $query = "DELETE FROM Agenda WHERE idConsulta = $idConsulta";
    $resultado = mysqli_query($conexao, $query);


    if (!$resultado) {
        echo "ERRO AO DELETAR CONSULTA: " . mysqli_error($conexao);
    }
    // Redireciona para página "Agenda.php" com a mensagem de sucesso
    header("Location: ../index/Agenda.php?consultaDeletada=sucesso");
    exit;


?>