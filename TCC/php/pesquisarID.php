<?php 
include 'conectaBD.php';
$idCampo = $_GET['id'];

$query = "SELECT * FROM clientes WHERE idCliente = '$idCampo'";
    $resultado = mysqli_query($conexao, $query);
    if ($resultado) {
        while ($row = $resultado->fetch_assoc()) {
            $idCliente = $row['idCliente'];
            $nomeCliente = $row['nome'];

            $json = array(
            'id' => $idCliente,
            'nome' => $nomeCliente,
            );
        }
        $jsonString = json_encode($json);
    } else {
        echo "Erro na consulta: " . $conexao->error;
    }
    header("Location: ../Index/novaConsulta.php?data=" . urlencode($jsonString) . "&idCampo=" . $idCampo . "&idResposta=" . $idCliente);
?>
?>