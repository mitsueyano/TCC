<?php
include '../php/conectaBD.php';
$idCliente = $_POST["idCliente"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$contato = $_POST["contato"];
$enderecoE = $_POST["estado"];
$enderecoC = $_POST["cidade"];
$enderecoB = $_POST["bairro"];
$enderecoR = $_POST["rua"];
$enderecoN = $_POST["numero"];
$enderecoRN = $enderecoR . ', ' . $enderecoN;
$especieAnimal = array();
$racasAnimal = array();
$quant = 0;
$i = 1;

$queryAtualizarCliente = "UPDATE Clientes SET 
    nome = '$nome',
    email = '$email',
    contato = '$contato',
    enderecoE = '$enderecoE',
    enderecoC = '$enderecoC',
    enderecoB = '$enderecoB',
    enderecoRN = '$enderecoRN'
WHERE idCliente = $idCliente";


$queryAnimais = "SELECT * FROM Animais WHERE idCliente = " . $idCliente;
$resultadoAnimais = mysqli_query($conexao, $queryAnimais);
if ($resultadoAnimais){
    while ($row = $resultadoAnimais->fetch_assoc()){
        $quant++;
    }
}
while ($i <= $quant){

    if (isset($_POST['especie_' . $i])) {
        $especieAnimal[$i] = $_POST['especie_' . $i];

        if (isset($_POST['racasGato_' . $i])) {
            if (isset($_POST['racasGato_' . $i]) == "Gato" && $especieAnimal[$i] == "Gato" ){
                $racasAnimal[$i] = $_POST['racasGato_' . $i];
            }
        }
        if (isset($_POST['racasCachorro_' . $i])) {
            if (isset($_POST['racasCachorro_' . $i]) == "Cachorro" && $especieAnimal[$i] == "Cachorro" ){
                $racasAnimal[$i] = $_POST['racasCachorro_' . $i];
            }
        }
        if ($especieAnimal[$i] == "Outras" ) {
            if (isset($_POST['outraEspecie_' . $i])) {
                $especieAnimal[$i] = $_POST['outraEspecie_' . $i];
                $racasAnimal[$i] = $_POST['outraRaca_' . $i];
            } 
        }
    }   

    if (isset($_POST['nomeAnimal_' . $i])) {
        $nomeAnimal = $_POST['nomeAnimal_' . $i];
    }    

    if (isset($_POST['dataNascto_' . $i])) {
        $dataNascto = $_POST['dataNascto_' . $i];
    }    

    $queryAtualizarAnimal = "UPDATE Animais SET 
        nome = '$nomeAnimal',
        especie = '{$especieAnimal[$i]}',
        raca = '{$racasAnimal[$i]}',
        dataNascto = '$dataNascto'

    WHERE idAnimal = $i";

    $i++;
    $resultadoAtualizarAnimal = mysqli_query($conexao, $queryAtualizarAnimal);
    if (!$resultadoAtualizarAnimal) {
        echo "ERRO AO CADASTRAR ANIMAL: ". $nomeAnimal . " - " . mysqli_error($conexao);
    }
}
var_dump($_POST);
$resultadoAtualizarCliente = mysqli_query($conexao, $queryAtualizarCliente);
if (!$resultadoAtualizarCliente) {
    echo "ERRO AO CADASTRAR CLIENTE: " . mysqli_error($conexao);
}
else {
    if($animaisJson = $_POST["animaisJson"]){ // Recebe uma string JSON
        $animais = json_decode($animaisJson, true); // Transforma a string JSON recebida em uma esrutura PHP

        foreach ($animais as $animal) { //Percorre por cada índice da matriz e seus respectivos arrays
            $nomeAnimal = $animal[0];
            $especie = $animal[1];
            $raca = $animal[2];
            $dataNascto = $animal[3];

            $queryAddNovoAnimal = "INSERT INTO Animais (idCliente, nome, especie, raca, dataNascto) VALUES ($idCliente, '$nomeAnimal', '$especie', '$raca', '$dataNascto')"; //Query para cadastrar animal
            $resultadoAnimal = mysqli_query($conexao, $queryAddNovoAnimal);

            if (!$resultadoAnimal) {
                echo "ERRO AO CADASTRAR ANIMAL: " . mysqli_error($conexao);
            }
        }
    }
}
?>