<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início</title>
        <link rel="stylesheet" href="../Css/novaConsulta.css">
    </head>
    <body>
        <div class="border-page"></div>
        <div class="page">
            <div class="bar">
                <div class="button"><a href="./agenda.php">VOLTAR</a></div>
            </div>
            <div class="container">     
            <div class="form-container">
                <label class="titulo">Nova consulta</label>   
                    <form action="../php/cadastrarCliente.php" method="post" onsubmit="return confirmarCadastro()">
                        <div class="flex">
                            <div class="label-form">
                                <!-- Formulário - seção CLIENTE -->
                                <label>ID do cliente:</label>
                            </div>
                            <div class="input-form">
                                <input type="text" name="idCliente" id="idCliente">
                                <button type="button" onclick="pesquisar()" class="pesquisar">Pesquisar ID</button>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="label-form">
                                <label>Nome do cliente:</label>
                            </div>
                            <div class="input-form">
                                <input type="text" name="nomeCliente" id="nomeCliente">
                            </div>
                        </div>
                        <!-- Formulário - seção ANIMAL -->
                        <div class="flex">
                            <div class="label-form">
                                <label>Animal:</label>
                            </div>
                            <div class="input-form">
                                <select name="" id="">
                                    <?php 
                                    // Preenche "nome do cliente" e "animais" de acordo com o ID inserido
                                    include '../php/conectaBD.php';
                                        $idCliente = $_GET['idResposta'];
                                        $queryIDAnimais = "SELECT idAnimal FROM animais WHERE idCliente = '$idCliente'";
                                        $resultadoIDAnimais = mysqli_query($conexao, $queryIDAnimais);
                                        $i = 0;
                                        $quant = 0;
                                        if ($resultadoIDAnimais) {
                                            while ($row = $resultadoIDAnimais->fetch_assoc()) {
                                                $idAnimal = $row['idAnimal'];     
                                                $queryAnimais = "SELECT * FROM animais WHERE idAnimal = $idAnimal";
                                                $resultadoAnimais = mysqli_query($conexao, $queryAnimais);
                                                $quant++;
                                                if($resultadoAnimais){  
                                                    while($i <= $quant && $row = $resultadoAnimais->fetch_assoc()){
                                                        $i++;
                                                        $nomeAnimal = $row['nome'];
                                    ?>
                                                        <option value="<?php echo $nomeAnimal?>" onchange="animal()" id="nomeAnimal"><?php echo $nomeAnimal?></option>      
                                    <?php
                                                    } 
                                                        
                                                }                                                                
                                            }
                                        } else {
                                            echo "Erro na consulta: " . $conexao->error;
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="label-form">
                                <label>ID do animal:</label>
                            </div>
                            <div class="input-form">
                                <input type="text" name="idAnimal" id="idAnimal">
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
    </body>
    <script>    
        function animal(){
            //Preenchimento do ID do animal
        }

        document.addEventListener("DOMContentLoaded", function () {
            // Ao carregar a página, confere se existe algum dado a ser preenchido
        <?php
            if (isset($_GET['data']) && isset($_GET['idCampo']) && isset($_GET['idResposta'])):
                $data = $_GET['data'];
                $idCampo = $_GET['idCampo'];
                $idResposta = $_GET['idResposta'];

                if ($data != 'null'){                  
        ?>
                    // Confere se o ID digitado é o mesmo recebido na URL
                    document.getElementById("idCliente").value = '<?php echo $_GET['idCampo'] ?>';   
                    var campoId = document.getElementById("idCliente").value;

                        if (campoId == '<?php echo $idResposta ?>') {
                    // Faz a decodificação do Json recebido e preenche os dados
                            <?php
                                if ($idCampo == $idResposta) {
                                    $jsonData = json_decode($_GET['data'], true);
                                    $idCliente = $jsonData['id'];
                                    $nomeCliente = $jsonData['nome'];
                                }
                            ?>
                            campoId = '<?php echo $_GET['idCampo']; ?>';
                            document.getElementById("nomeCliente").value  = '<?php echo $nomeCliente;?>';
                            document.getElementById("nomeCliente").readOnly = true;
                        }
        <?php  
                    //Se não houver campos Json válidos, exibir mensagem de erro
                } else {
        ?>
                    if ( document.getElementById("idCliente").value == ""){
                        window.alert("Cliente não encontrado");
                        document.getElementById("nomeCliente").readOnly = false;
                    }
                    // Se o ID digitado não for o mesmo recebido, executa o redirecionamento
                    else{
                        pesquisar();
                    }
        <?php  
                }
                
            endif;
        ?>
        });

        // Script de redirecionamento
        function pesquisar(){
            var campoId = document.getElementById("idCliente").value;
            window.location.href = "../php/pesquisarID.php?id=" + campoId;
        }
    </script>
</html>