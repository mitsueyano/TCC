<?php
include 'conectaBD.php';
$idConsulta = $_POST['idConsulta'];
echo $idConsulta;

$queryDelete = "DELETE FROM agenda WHERE idConsulta = '$idConsulta'";
$resultadoDelete = mysqli_query($conexao, $queryDelete);

if (!$resultadoDelete){
    echo "ERRO AO REMOVER CONSULTA: " . mysqli_error($conexao);
}
else{
    echo "Consulta removida.";
    header("Location: ../index/Inicio.php?ConsultaFinalizada=sucesso");
}

?>