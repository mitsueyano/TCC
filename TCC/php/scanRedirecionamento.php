
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
        ?>

        <script>

            var Horario = new Date();
            var dataFormatada = Horario.toLocaleDateString('pt-BR');
            console.log(dataFormatada)
            console.log ('<?php echo $dataConsulta?>')
        
            if (dataFormatada == '<?php echo $dataConsulta?>'){
                
                <?php                                      
                    $idAnimal = $_GET['idAnimal'];
                    $query = "UPDATE Agenda SET idStatus = '1'
                                WHERE dataConsulta = '$dataConsultaRow'
                            ";
                    $result = mysqli_query($conexao, $query);

                    if (!$result){
                        echo "ERRO AO ATUALIZAR STATUS";
                    }                                    
                ?>
            }
            else{
                '<?php echo "Não há consultas agendadas para hoje" ?>'
            }


        </script>


<?php
    } 
}
header('Location: ../Index/Inicio.php')
?>