<?php 
include 'conectaBD.php';

if (isset($_GET['idCO'])) {
    $idCO= $_GET['idCO'];

    $queryDelete = "DELETE FROM agenda WHERE idConsulta = '$idCO'";
    $resultadoDelete = mysqli_query($conexao, $queryDelete);

    if (!$resultadoDelete){
        echo "ERRO AO REMOVER CONSULTA: " . mysqli_error($conexao);
    }
}

// Verifica se o parâmetro 'id' existe na URL
if (isset($_GET['id'])) {
    $idCampo = $_GET['id'];
    if (isset($_GET['animalCO'])) {
        $animal = $_GET['animalCO'];
    }

    // Script SQL para verificação - pesquisa de ID
    $query = "SELECT * FROM clientes WHERE idCliente = '$idCampo'";
    $resultado = mysqli_query($conexao, $query);

    if ($resultado) {
        if ($resultado->num_rows > 0) {

            // Cria um array JSON com dados do Cliente
            $row = $resultado->fetch_assoc();
            $idCliente = $row['idCliente'];
            $nomeCliente = $row['nome'];

            $json = array(
                'id' => $idCliente,
                'nome' => $nomeCliente,
            );

            $jsonString = json_encode($json);


            // Verifica se o parâmetro 'paraAgendar' existe na URL
            if (isset($_GET['paraAgendar'])) {
                $paraAgendar = $_GET['paraAgendar'];
                
                header("Location: ../Index/novaConsulta.php?data=" . urlencode($jsonString) . "&idCampo=" . $idCampo . "&idResposta=" . $idCliente . "&paraAgendar=" . $paraAgendar . "&animalCO=" . $animal);
            } else {
                header("Location: ../Index/novaConsulta.php?data=" . urlencode($jsonString) . "&idCampo=" . $idCampo . "&idResposta=" . $idCliente . "&animalCO=" . $animal);
            }
        } else {
            if (isset($_GET['paraAgendar'])) {
                $paraAgendar = $_GET['paraAgendar'];
                header("Location: ../Index/novaConsulta.php?cliente=inexistente&paraAgendar=" . $paraAgendar);
            } else {
                header("Location: ../Index/novaConsulta.php?cliente=inexistente");
            }
        }
    } else {
        echo "Erro na consulta: " . $conexao->error;
    }
} else {
    echo "Parâmetro 'id' não especificado na URL";
}
?>
