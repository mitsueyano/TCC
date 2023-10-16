<?php
include '../conectaBD.php';
$peso = $_POST['peso'];
$temperatura = $_POST['temperatura'];
$diagnostico = $_POST['diagnostico'];
$tratamento = $_POST['tratamento'];
$observacoes = $_POST['observacoes'];
$idConsulta = $_POST['idConsulta'];
$dataConsulta = $_POST['dataConsultaAgendada'];
$veterinario = $_POST['veterinario'];
$horaConsulta = $_POST['horaConsulta'];
$idAnimal = $_POST['idAnimal'];


$queryHistorico = "INSERT INTO HistoricoMedico (idConsulta, dataConsulta, horaConsulta, veterinario, peso, temperatura, diagnostico, tratamento, observacoes, idAnimal)
                    VALUES ('$idConsulta', '$dataConsulta', '$horaConsulta', '$veterinario', '$peso', '$temperatura', '$diagnostico', '$tratamento', '$observacoes', '$idAnimal')";
$queryAlterarStatus = "UPDATE Agenda
                        SET idStatus = 3
                        WHERE idConsulta = '$idConsulta'";

$resultadoHistorico = mysqli_query($conexao, $queryHistorico);
if (!$resultadoHistorico){
    echo "ERRO AO FINALIZAR CONSULTA: " . mysqli_error($conexao);
}
else{
    echo "Consulta finalizada.";
    $resultadoAlterarStatus = mysqli_query($conexao, $queryAlterarStatus);
    if (!$resultadoAlterarStatus){
        echo "ERRO AO ALTERAR STATUS " . mysqli_error($conexao);
    }
    else{
        header("Location: ../../Index/vetArea/filaEspera.php");
    }
}
?>