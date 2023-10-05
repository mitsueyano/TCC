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
                    </form> 
                </div>
            </div>
    </body>
    <script>
        function pesquisar(){
            var campoId = document.getElementById("idCliente").value;
            var nomeCliente = document.getElementById("nomeCliente").value;
            <?php
               if (isset($_GET['data']) && isset($_GET['idCampo']) && isset($_GET['idResposta'])) {
                    $data = $_GET['data'];
                    $idCampo = $_GET['idCampo'];
                    $idResposta = $_GET['idResposta'];
                }
            ?>
            if (campoId == <?php echo $idResposta ?>) {
                <?php
                    if ($idCampo == $idResposta) {
                        $jsonData = json_decode($_GET['data'], true);
                        $idCliente = $jsonData['id'];
                        $nomeCliente = $jsonData['nome'];
                    }
                ?>
                document.getElementById("idCliente").value = "<?php echo($idCliente); ?>";
                nomeCliente = document.getElementById("nomeCliente").value = "<?php echo($nomeCliente);?>";
            }
            else{
            window.location.href = "../php/pesquisarID.php?id=" + campoId;
            }
            
        }
    </script>
</html>