<?php 
include 'conectaBD.php';

// Verifica se o parâmetro 'id' existe na URL
if (isset($_GET['id'])) {
    $idCampo = $_GET['id'];

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
                
                header("Location: ../Index/novaConsulta.php?data=" . urlencode($jsonString) . "&idCampo=" . $idCampo . "&idResposta=" . $idCliente . "&paraAgendar=" . $paraAgendar);
            } else {
                header("Location: ../Index/novaConsulta.php?data=" . urlencode($jsonString) . "&idCampo=" . $idCampo . "&idResposta=" . $idCliente);
            }
        } else {
            echo "Cliente não encontrado";
        }
    } else {
        echo "Erro na consulta: " . $conexao->error;
    }
} else {
    echo "Parâmetro 'id' não especificado na URL";
}
?>
