<?php
include 'conectaBD.php';

$dataConsulta = $_POST['dataConsulta'];
$horaConsulta = $_POST['horaConsulta'];
$descricao = $_POST['descConsulta'];
$idAnimal = $_POST['idAnimal'];

$query = "INSERT INTO Agenda (dataConsulta, horaConsulta, veterinario, descricao, idAnimal)
            VALUES ('$dataConsulta', '$horaConsulta', 1, '$descricao', '$idAnimal')";
$resultado = mysqli_query($conexao, $query);

if(!$resultado){
    echo "ERRO AO AGENDAR " . mysqli_error($conexao);
}
else{
    echo "Agendamento concluído.";
}

?>