<?php 
include 'conectaBD.php';
$idAnimal = $_GET['idAnimal'];
$queryData = "SELECT dataConsulta FROM Agenda WHERE idAnimal = '$idAnimal'";
$resultData = mysqli_query($conexao, $queryData);
if (!$resultData){
    echo "ERRO AO BUSCAR DATA DE CONSULTA";
} else {
    while($row = $resultData->fetch_assoc()) {
        $dataConsultaRow = $row['dataConsulta'];

        $partes = explode("-", $dataConsultaRow);

        if (count($partes) === 3) {
            $ano = $partes[0];
            $mes = $partes[1];
            $dia = $partes[2];

            // Converte em ano/mês/dia
            $dataConsulta = $dia . '/' . $mes . '/' . $ano;

        } else {
            echo "Formato de data inválido.";
        }

        $dataFormatada = date('d/m/Y');
        
        if ($dataFormatada == $dataConsulta) {
            $query = "UPDATE Agenda SET idStatus = '1'
                      WHERE dataConsulta = '$dataConsultaRow' AND idAnimal = $idAnimal";
            $result = mysqli_query($conexao, $query);
            header('Location: ../Index/Inicio.php');

            if (!$result) {
                echo "ERRO AO ATUALIZAR STATUS";
            }                                    
        }
        else {
            header('Location: ../Index/Inicio.php?Consulta=inexistente');
        }
    } 
}
?>
