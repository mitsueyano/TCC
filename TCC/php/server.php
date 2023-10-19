<?php
include '../php/conectaBD.php';

// Script para exibição da tabela na página Index/Inicio.php
$queryAgenda = "SELECT Agenda.*, Usuarios.nome, Animais.nome as nome_animal, statusConsulta.statusConsulta, Animais.idCliente
                FROM Animais
                INNER JOIN Agenda ON Animais.idAnimal = Agenda.idAnimal
                INNER JOIN Usuarios ON Agenda.veterinario = Usuarios.idUsuario
                INNER JOIN statusConsulta ON Agenda.idStatus = statusConsulta.idStatus
                WHERE Agenda.idStatus != 0
                GROUP BY Agenda.dataConsulta, Agenda.horaConsulta;";
$resultAgenda = mysqli_query($conexao, $queryAgenda);

// Cria um array para os resultados
$data = array();

if ($resultAgenda->num_rows > 0) {
    while ($arrayAgenda = mysqli_fetch_assoc($resultAgenda)) {
        $data[] = $arrayAgenda;
    }
}

// Transforma o array em JSON
echo json_encode($data);
?>
