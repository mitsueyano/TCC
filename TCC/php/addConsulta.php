<?php
include 'conectaBD.php';

$dataConsulta = $_POST['dataConsulta'];

// Primeiro, substitua o hífen por barras para obter o formato "11/10/2023".
$dataConsulta = str_replace('-', '/', $dataConsulta);

// Em seguida, converta a data para o formato "Y-m-d".
$dataConsulta = date('Y-m-d', strtotime($dataConsulta));

$horaConsulta = $_POST['horaConsulta'];
$descricao = $_POST['descConsulta'];
$idAnimal = $_POST['idAnimal'];

$query = "INSERT INTO Agenda (dataConsulta, horaConsulta, veterinario, descricao, idAnimal)
            VALUES ('$dataConsulta', '$horaConsulta', 1, '$descricao', '$idAnimal')";
$resultado = mysqli_query($conexao, $query);

if (!$resultado) {
    echo "ERRO AO AGENDAR " . mysqli_error($conexao);
} else {
    echo "Agendamento concluído.";
}
?>
