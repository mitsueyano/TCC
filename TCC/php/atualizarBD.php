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
    $ids = [];
    if ($resultadoAnimais){
        while ($row = $resultadoAnimais->fetch_assoc()){
            $quant++;
            $ids[] = $row['idAnimal'];
        }
    }
    while ($i <= $quant){

        if (isset($_POST['especie_' . $ids[$i - 1]])) {
            $especieAnimal[$i - 1] = $_POST['especie_' . $ids[$i - 1]];

            if (isset($_POST['racasGato_' . $ids[$i - 1]])) {
                if (isset($_POST['racasGato_' . $ids[$i - 1]]) == "Gato" && $especieAnimal[$i - 1] == "Gato" ){
                    $racasAnimal[$i - 1] = $_POST['racasGato_' . $ids[$i - 1]];
                }
            }
            if (isset($_POST['racasCachorro_' . $ids[$i - 1]])) {
                if (isset($_POST['racasCachorro_' . $ids[$i - 1]]) == "Cachorro" && $especieAnimal[$i - 1] == "Cachorro" ){
                    $racasAnimal[$i - 1] = $_POST['racasCachorro_' . $ids[$i - 1]];
                }
            }
            if ($especieAnimal[$i - 1] == "Outras" ) {
                if (isset($_POST['outraEspecie_' . $ids[$i - 1]])) {
                    $especieAnimal[$i - 1] = $_POST['outraEspecie_' . $ids[$i - 1]];
                    $racasAnimal[$i - 1] = $_POST['outraRaca_' . $ids[$i - 1]];
                } 
            }
        }   

        if (isset($_POST['nomeAnimal_' . $ids[$i - 1]])) {
            $nomeAnimal = $_POST['nomeAnimal_' . $ids[$i - 1]];
        }    

        if (isset($_POST['dataNascto_' . $ids[$i - 1]])) {
            $dataNascto = $_POST['dataNascto_' . $ids[$i - 1]];
        }    
        var_dump($especieAnimal);
        $queryAtualizarAnimal = "UPDATE Animais SET 
            nome = '$nomeAnimal',
            especie = '{$especieAnimal[$i - 1]}',
            raca = '{$racasAnimal[$i - 1]}',
            dataNascto = '$dataNascto'
            WHERE idAnimal = '{$ids[$i - 1]}'";
        echo $ids[$i - 1];
        $i++;
        $resultadoAtualizarAnimal = mysqli_query($conexao, $queryAtualizarAnimal);
        if (!$resultadoAtualizarAnimal) {
            echo "ERRO AO CADASTRAR ANIMAL: ". $nomeAnimal . " - " . mysqli_error($conexao);
        }
    }
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
    header("Location: ../index/cadastro.php?alteracao=sucesso");
    exit;
?>