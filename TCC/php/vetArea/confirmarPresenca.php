<?php 
    include '../../php/conectaBD.php';
    $idConsulta = $_POST['idConsulta'];
    $queryConfirmar = "UPDATE Agenda SET
    idStatus = 2
    WHERE idConsulta = '$idConsulta'
    ";

    $resultado = mysqli_query($conexao, $queryConfirmar);
    if (!$resultado){
        echo "ERRO AO ATUALIZAR STATUS";
    } else{
        header('Location: ../../index/vetArea/InicioVet.php');
    }
?>