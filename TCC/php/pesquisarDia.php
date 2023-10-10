<?php
include 'conectaBD.php';

if (isset($_GET['diaSelecionado']) && isset($_GET['mesSelecionado']) && isset($_GET['anoSelecionado'])) {
    $diaSelecionado = $_GET['diaSelecionado'];
    $mesSelecionado = $_GET['mesSelecionado'];
    $anoSelecionado = $_GET['anoSelecionado'];

    $dataConsulta = "$anoSelecionado-$mesSelecionado-$diaSelecionado";

    $query = "SELECT * FROM Agenda WHERE dataConsulta = '$dataConsulta'";
    $resultado = mysqli_query($conexao, $query);

    if (!$resultado) {
        echo "ERRO AO AGENDAR " . mysqli_error($conexao);
    } else {
        $json = array();

        while ($row = $resultado->fetch_assoc()) {

            $idConsulta = $row['idConsulta'];
            $dataConsulta = $row['dataConsulta'];
            $horaConsulta = $row['horaConsulta'];
            $descricao = $row['descricao'];

            $json = array(
                'idConsulta' => $idConsulta,
                'dataConsulta' => $dataConsulta,
                'horaConsulta' => $horaConsulta,
                'descricao' => $descricao,
            );

            $consultas[] = $json; 
        }

        // Converte o array de consultas em JSON
        $jsonString = json_encode($consultas);

        
        header("Location: ../Index/agendaCompleta.php?data=" . urlencode($jsonString));
    }
} else {
    echo "ERRO AO PESQUISAR DIA";
}
?>
