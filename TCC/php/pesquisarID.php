<?php 
include 'conectaBD.php';
$idCampo = $_GET['id'];

// Script SQL para verificação - pesquisa de ID
$query = "SELECT * FROM clientes WHERE idCliente = '$idCampo'";
    $resultado = mysqli_query($conexao, $query);
    if ($resultado) {
        // Cria um array JSON com dados do Cliene
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

    // Redireciona para a página "novaConsulta.php" com os dados na URL
    header("Location: ../Index/novaConsulta.php?data=" . urlencode($jsonString) . "&idCampo=" . $idCampo . "&idResposta=" . $idCliente);
?>
