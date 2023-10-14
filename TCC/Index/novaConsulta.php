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
                    <form action="../php/addConsulta.php" method="post" onsubmit="return confirmarAgendamento()">
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
                                <select name="animal" id="animal" onchange="animalSelecionado()" value="Selecione">
                                <option value="Selecione">Selecione um animal</option>
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
                                                        <option value="<?php echo $nomeAnimal?>" id="nomeAnimal"><?php echo $nomeAnimal?></option>      
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
                        <div class="flex">
                            <div class="label-form">
                                <label>Espécie:</label>
                            </div>
                            <div class="input-form">
                                <input type="text" name="especie" id="especie">
                            </div>
                        </div>
                        <div class="flex">
                            <div class="label-form">
                                <label>Raça:</label>
                            </div>
                            <div class="input-form">
                                <input type="text" name="raca" id="raca">
                            </div>
                        </div>
                        <div class="consultaInfo">
                        <div class="flex">
                            <div class="label-form">
                                <label>Data da consulta:</label>
                            </div>
                            <div class="input-form">
                                <select name="dataConsulta" id="dataConsulta" class="dataConsulta"></select>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="label-form">
                                <label>Hora:</label>
                            </div>
                            <div class="input-form">
                            <select name="horaConsulta" id="horaConsulta" class="horaConsulta">
                            </select>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="label-form">
                                <label>Veterinário:</label>
                            </div>
                            <div class="input-form">
                            <select name="veterinario" id="veterinario" class="veterinario">
                                <?php
                                    $queryVet = "SELECT nome, idUsuario FROM Usuarios WHERE idCargo = 2";
                                        $resultadoVet = mysqli_query($conexao, $queryVet);
                                        if ($resultadoVet){
                                            while ($rowVet = $resultadoVet->fetch_assoc()){
                                                $idVet = $rowVet['idUsuario'];
                                                $nomeVet = $rowVet['nome'];
                                ?>
                                    <option value="<?php echo $idVet?>"><?php echo $nomeVet?></option>
                                <?php
                                            }
                                        }
                                ?>
                            </select>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="label-form">
                                <label>Descrição</label>
                            </div>
                            <div class="input-form">
                                <input type="text" name="descConsulta" id="descConsulta">
                            </div>
                        </div>
                        <div class="submit-container">  
                            <div class="btnSubmitDiv">
                                <div class="buttonOptions"><button type="submit" class="submit">AGENDAR</button></div>
                            </div>
                        </div>  
                        </div>
                    </form> 
                </div>
            </div>
    </body>
    <script>    
        function animalSelecionado(){
            <?php
            $query = "SELECT idAnimal, nome, especie, raca FROM animais WHERE idCliente = '$idCliente'";
            $resultado = mysqli_query($conexao, $query);
            if ($resultado){
                while($i <= $quant && $row = $resultado->fetch_assoc()){
                    $animal = $row['nome']; 
                    $idAnimal = $row['idAnimal'];
                    $especie = $row['especie'];
                    $raca = $row['raca'];
            ?>
                    if (document.getElementById("animal").value == "<?php echo $animal?>"){

                        document.getElementById("idAnimal").value = "<?php echo $idAnimal?>"
                        document.getElementById("idAnimal").readOnly = true;

                        document.getElementById("especie").value = "<?php echo $especie?>"
                        document.getElementById("especie").readOnly = true;

                        document.getElementById("raca").value = "<?php echo $raca?>"
                        document.getElementById("raca").readOnly = true;
                    }
                    else if (document.getElementById("animal").value == "Selecione"){
                        document.getElementById("idAnimal").value = ""
                        document.getElementById("idAnimal").readOnly = false;

                        document.getElementById("especie").value = ""
                        document.getElementById("especie").readOnly = false;

                        document.getElementById("raca").value = ""
                        document.getElementById("raca").readOnly = false;
                    }
            <?php
                }
            }
            ?>
        }        
        // Tratamento de erros onsubmit
        function confirmarAgendamento(){
            
            let verificar = false;
            var descConsulta = document.getElementById("descConsulta").value;
            if (descConsulta.trim() === "") {
                document.getElementById("descConsulta").placeholder = "Campo obrigatório.";
                verificar = true;
            }
            var idCliente = document.getElementById("idCliente").value;
             if (idCliente.trim() === "") {
                document.getElementById("idCliente").placeholder = "Campo obrigatório.";
                verificar = true;
            }
            if (verificar) {
                window.alert("Dados incompletos.");
                return false;
            }
            if (document.getElementById("animal").value == "Selecione") {
                window.alert("Nenhum animal selecionado.");
                return false;
            }
            var dataConsulta = document.getElementById("dataConsulta").value;
            var horaConsulta = document.getElementById("horaConsulta").value;
            if (dataConsulta.trim() === "" || horaConsulta.trim() === "" ) {
                window.alert("Data/Hora inválida.");
                return false;
            }

        }

        // Script de redirecionamento para pesquisar ID do cliente dados do animal
        function pesquisar(){
                var campoId = document.getElementById("idCliente").value;
                window.location.href = "../php/pesquisarID.php?id=" + campoId;
            }


        document.addEventListener("DOMContentLoaded", function () { 

            <?php 
                if (isset($_GET['agendamento']) && ($_GET['agendamento'] === 'sucesso')){
                        echo 'alert("Angendamento concluído.")';
                }
            ?>
       

            function formatDate(date) {
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();

                if (day < 10) {
                    day = '0' + day;
                }

                if (month < 10) {
                    month = '0' + month;
                }

                return day + '-' + month + '-' + year;
            }
            var dataConsultaSelect = document.getElementById('dataConsulta');
            var dataAtual = new Date();

            // Script para preencher select de dias
            for (var i = 0; i < 28; i++) { // 3 semanas = 21 dias
            dataAtual.setDate(dataAtual.getDate() + 1);
            var diaDaSemana = dataAtual.getDay();
            if (diaDaSemana != 0 && diaDaSemana != 6) {
                var option = document.createElement('option');
                option.value = formatDate(dataAtual);
                option.text = formatDate(dataAtual);
                dataConsultaSelect.appendChild(option);
            }   
            datasHorarios()        
        }

        // Ao carregar a página, confere se existe algum dado a ser preenchido (Script de ID)
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
                                    if ($jsonData['nome'] != null){
                                    $nomeCliente = $jsonData['nome'];
                                    }
                                }
                            ?>
                            campoId = '<?php echo $_GET['idCampo']; ?>';
                            <?php
                            if ($idCampo == $idResposta) {
                                $jsonData = json_decode($_GET['data'], true);
                                if ($jsonData['nome'] != null){
                                    $nomeCliente = $jsonData['nome'];
                            ?>
                            document.getElementById("nomeCliente").value = '<?php echo $nomeCliente;?>';
                            <?php 
                                }
                            }
                            ?>
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
            var dataConsultaSelect = document.getElementById('dataConsulta');
            // Script para mudar horários ao selecionar uma data
            dataConsultaSelect.addEventListener('change', datasHorarios)
            
            function datasHorarios(){
                var dataConsultaSelect = document.getElementById('dataConsulta');
                var dataSelecionada = dataConsultaSelect.value;


                // Converte a data em ano/mes/dia
                var partesData = dataSelecionada.split('-');
                var dia = partesData[0];
                var mes = partesData[1] - 1; 
                var ano = partesData[2];
                var diaDaSemana = new Date(ano, mes, dia).getDay();
                var diasDaSemana = ['domingo', 'segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado'];
                var diaSelecionado = diasDaSemana[diaDaSemana];
                if (diaDaSemana == 1 || diaSelecionado == 2 || diaSelecionado == 3){
                    
                    var vet = document.getElementById('veterinario')
                    vet.value = 1
                }
                else{
                    var vet = document.getElementById('veterinario')
                    vet.value = 2
                }
            
                // Array de horários disponíveis
                var horariosDisponiveis = {
                    "domingo": [],    
                    "segunda": ["08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30"],
                    "terça": ["08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30"],
                    "quarta": ["08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30"],
                    "quinta": ["08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30"],
                    "sexta": ["08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30"],
                    "sábado": []
                };

                // Conexão ao banco de dados para conferir se há data-hora já agendadas
                <?php
                    include '../php/ConectaBD.php';

                    $query = "SELECT distinct dataConsulta, horaConsulta from agenda";
                    $resultado = mysqli_query($conexao, $query);

                    if(!$resultado){
                        echo "ERRO NA CONSULTA " . mysqli_error($conexao);
                    }
                    else{
                        while ($row = $resultado->fetch_assoc()){
                            $dataConsulta = $row['dataConsulta'];
                            $horarioIndisponivel = $row['horaConsulta'];

                ?>  
                            // Recebe parâmetros da data-hora agendada(Indisponível)
                            horarioIndisponivel = '<?php echo $horarioIndisponivel?>';
                            data_HorarioIndisponivel = '<?php echo $dataConsulta?>';
                                
                            // Converte a data para receber o dia da semana
                            var partesDataIndisp = data_HorarioIndisponivel.split('-');
                            var diaIndisp = partesDataIndisp[2];
                            var mesIndisp = partesDataIndisp[1] - 1; 
                            var anoIndisp = partesDataIndisp[0];

                            // Recebe o dia da semana em índice
                            var diaDaSemanaIndisp = new Date(anoIndisp, mesIndisp, diaIndisp).getDay(); // Recebe o dia da semana
                            var diasDaSemanaIndisp = ['domingo', 'segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado']; // [0 = domingo, ..., 6 = sábado]
                            
                            // Identifica qual o dia da semana selecionado
                            var diaSelecionadoIndisp = diasDaSemanaIndisp[diaDaSemanaIndisp];

                            // Cria um array de 'horários disponiveis' com base no dia do agendamento
                            var horario_confere = horariosDisponiveis[diaSelecionadoIndisp];
                        

                            if (diaSelecionado in horariosDisponiveis) {

                                // Script para listar todos os horarios
                                var horario = horariosDisponiveis[diaSelecionado];
                                var horaConsulta = document.getElementById('horaConsulta');
                                horaConsulta.innerHTML = '';

                                horario.forEach(function (horarioConfere) {
                                    var option = document.createElement('option');
                                    option.value = horarioConfere;
                                    option.text = horarioConfere;
                                    option.id = horarioConfere;
                                    horaConsulta.appendChild(option);
                                });                              
                            }

                            // Converte a data que possui agendamento
                            var partesdata_HorarioIndisponivel = data_HorarioIndisponivel.split('-');
                            var diaIndisp = partesDataIndisp[2];
                            var mesIndisp = partesDataIndisp[1] - 1; 
                            var anoIndisp = partesDataIndisp[0];
                            var data_HorarioIndisponivel_convertido = new Date(anoIndisp, mesIndisp, diaIndisp).toLocaleDateString('pt-br')
                            var partes = data_HorarioIndisponivel_convertido.split('/');
                            
                            data_HorarioIndisponivel_convertido = partes[0] + '-' + partes[1] + '-' + partes[2];                           
                <?php   
                        }
                    }
                ?>
                
                if (dataSelecionada == data_HorarioIndisponivel_convertido) {
                    var horariosAgendados = [];                   
                    // Verifica se o dia selecionado possui agendamento no banco de dados
                    <?php 
                        $queryHorarios = "SELECT distinct dataConsulta, horaConsulta from agenda where dataConsulta = '$dataConsulta'";
                        $resultadoHorarios = mysqli_query($conexao, $queryHorarios);
        
                        if(!$resultadoHorarios){
                            echo "ERRO NA CONSULTA " . mysqli_error($conexao);
                        }
                        else{
                            while ($row = $resultadoHorarios->fetch_assoc()){
                                $hora = $row['horaConsulta'];                             
                ?>

                                // Cria um array com todos os horários agendados no dia selecionado
                                horariosAgendados.push("<?php echo $hora?>");
                <?php 
                            }
                        }
                ?>

                    // Remove o horário indisponível
                        horaConsulta.querySelectorAll("option").forEach(function (opt) {
                            if (horariosAgendados.includes(opt.value)){
                                opt.outerHTML = ""
                            }
                        });
                }
            }
                       
        });
    </script>
</html>