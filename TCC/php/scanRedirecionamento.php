<?php 
include 'conectaBD.php';
$idAnimal = $_GET['idAnimal'];
$queryData = "SELECT dataConsulta FROM Agenda WHERE idAnimal = '$idAnimal'";
$resultData = mysqli_query($conexao, $queryData);
if (!$resultData) {
    echo "ERRO AO BUSCAR DATA DE CONSULTA";
} else {
    $consultasAgendadas = false;

    while ($row = $resultData->fetch_assoc()) {
        $dataConsultaRow = $row['dataConsulta'];
        $partes = explode("-", $dataConsultaRow);

        if (count($partes) === 3) {
            $dataConsulta = date("Y-m-d", strtotime($dataConsultaRow));
            date_default_timezone_set('America/Sao_Paulo');
            $hoje = date("Y-m-d");


            if ($dataConsulta == $hoje) {

                $idAnimal = $_GET['idAnimal'];
                $query = "UPDATE Agenda SET idStatus = '1' WHERE dataConsulta = '$dataConsultaRow' and idAnimal = '$idAnimal'";
                $result = mysqli_query($conexao, $query);

                if (!$result) {
                    echo "ERRO AO ATUALIZAR STATUS";
                } else {
                    $consultasAgendadas = true;
                }
            }
        } else {
            echo "Formato de data inválido.";
        }
    }



    if ($consultasAgendadas) {
        header('Location: ../Index/Inicio.php');
    } else {
        header('Location: ../Index/Inicio.php?Consulta=inexistente');
    }
}
?>
