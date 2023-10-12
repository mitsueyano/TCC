<?php
include 'conectaBD.php';

$dataConsulta = $_POST['dataConsulta'];

// Separa a data recebida
$partes = explode("-", $dataConsulta);

if (count($partes) === 3) {
    $ano = $partes[2];
    $mes = $partes[1];
    $dia = $partes[0];
    
    // Converte em ano/mês/dia
    $dataConsulta = $ano . '-' . $mes . '-' . $dia;

} else {
    echo "Formato de data inválido.";
}

echo $dataConsulta;

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
