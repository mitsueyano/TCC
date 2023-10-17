<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início</title>
        <link rel="stylesheet" href="../../Css/vetArea/InicioVet.css">
    </head>
    <body>
        <div class="border-page"></div>
        <div class="page">
            <div class="bar">
                <div class="button selected"><a href="../../Index/vetArea/InicioVet.php">INÍCIO</a></div>
                <div class="button"><a href="../../Index/vetArea/filaEspera.php">FILA DE ESPERA</a></div>
            </div>
            <div class="container">     
                <!-- Container "Em consultório" -->
                <span class="titulo">Em consultório</span>
                <div class="container-consultorio">
                    <!-- Seção dados da consulta e do animal -->
                    <div class="dados">
                        <div class="flex-dados">
                            <div class="label-dados">
                                <label>Nome do animal:</label>
                            </div>
                            <div class="input-dados">
                                <input type="text" name="nomeAnimal" id="nomeAnimal">
                            </div>
                            <div class="label-dados">
                                <label>Espécie:</label>
                            </div>
                            <div class="input-dados">
                                <input type="text" name="especie" id="especie">
                            </div>
                            <div class="label-dados">
                                <label>Raça:</label>
                            </div>
                            <div class="input-dados">
                                <input type="text" name="raca" id="raca">
                            </div>
                            <div class="label-dados">
                                <label>Data de nascimento:</label>
                            </div>
                            <div class="input-dados">
                                <input type="text" name="dataNascto" id="dataNascto">
                            </div>
                            <div class="label-dados">
                                    <label>Descrição da consulta:</label>
                            </div>
                            <div class="input-dados">
                                <input type="text" name="descricao" id="descricao">
                            </div>
                        </div>
                    </div>
                    <!-- Seção formulário do veterinário -->
                    <div class="partes">
                        <form action="../../php/vetArea/finalizarConsulta.php" method="POST">
                            <input type="hidden" name="veterinario" value="1">
                            <input type="hidden" id="idConsulta" name="idConsulta">
                            <input type="hidden" id="idAnimal" name="idAnimal">
                            <input type="hidden" id="dataConsultaAgendada" name="dataConsultaAgendada">
                            <input type="hidden" id="horaConsulta" name="horaConsulta">
                            <div class="infoAtual">
                                <div class="flex">
                                    <div class="label-form">
                                        <label>Peso atual:</label>
                                    </div>
                                    <div class="input-form">
                                        <input type="text" name="peso" id="peso" required>
                                    </div>
                                    <div class="label-form">
                                        <label>Temperatura:</label>
                                    </div>
                                    <div class="input-form">
                                        <input type="text" name="temperatura" id="temperatura" required>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Diagnóstico:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" name="diagnostico" id="diagnostico" required>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                        <label>Tratamento:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" name="tratamento" id="tratamento" required>
                                </div>
                            </div>
                            <div class="flex-observacoes">
                                <div class="label-form">
                                        <label>Observações:</label>
                                </div>
                                <div class="input-form">
                                    <textarea name="observacoes"></textarea>
                                </div>
                            </div>        
                            <div class="submit-container">  
                                <div class="btnSubmitDiv">
                                    <div class="buttonOptions"><button type="submit" class="submit" id="submit" >Finalizar consulta</button>
                                </div>
                            </div>
                        </div>  
                        </form>
                        <div class="historicoMedicoContainer">
                            <div class="historicoMedicoInfo">
                                <span class="tituloHistoricoM">Histórico médico</span>
                                <div class="historicoMedico" id="historicoMedico">  
                                    <!-- Campo para info do histórico médico -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- Seção - DATA E HORA -->
                 <div class="data">
                    <div class="dia" id="data-atual"></div> 
                    <div class="hora" id="hora-atual"></div>
                </div>
            </div>
    </body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        // Seção informações do animal
        <?php
            include '../../php/conectaBD.php';
            $queryConsultorio = "SELECT agenda.descricao AS descricao_consulta, agenda.dataConsulta AS data_consulta, agenda.horaConsulta AS hora_consulta, agenda.idConsulta AS id_consulta, agenda.idAnimal AS id_animal, agenda.idStatus, animais.nome AS nome_animal, animais.especie AS animal_especie, animais.raca AS animal_raca, animais.dataNascto AS animal_dataNascto, statusConsulta.idStatus
            FROM Agenda
            JOIN animais ON animais.idAnimal = agenda.idAnimal
            JOIN statusConsulta ON statusConsulta.idStatus = agenda.idStatus 
            WHERE agenda.idStatus = '2'
            ";   
            
            $resultadoConsultorio = mysqli_query($conexao, $queryConsultorio);
            if (!$resultadoConsultorio){
                echo "ERRO AO BUSCAR DADOS: ". mysqli_error($conexao);
            }
            else{
                $numLinhas = mysqli_num_rows($resultadoConsultorio);
                if ($numLinhas > 0){
                    while ($row = mysqli_fetch_assoc($resultadoConsultorio)){
                        $idAnimal = $row['id_animal'];
                        $nomeAnimal = $row['nome_animal'];
                        $especie = $row['animal_especie'];
                        $raca = $row['animal_raca'];
                        $dataNascto = $row['animal_dataNascto'];
                        $descricao = $row['descricao_consulta'];
                        $idConsulta = $row['id_consulta'];
                        $dataConsultaAgendada = $row['data_consulta'];
                        $horaConsulta = $row['hora_consulta']
        ?>
                        nomeAnimal = document.getElementById('nomeAnimal')
                        nomeAnimal.value = '<?php echo $nomeAnimal?>'

                        especie = document.getElementById('especie')
                        especie.value = '<?php echo $especie?>'

                        raca = document.getElementById('raca')
                        raca.value = '<?php echo $raca?>'

                        var dataNascto = '<?php echo $dataNascto?>'

                        // Converte a data de nascimento do animal
                        var partesdata = dataNascto.split('-');
                        var dia = partesdata[2];
                        var mes = partesdata[1] - 1; 
                        var ano = partesdata[0];
                        var dataNascto = new Date(ano, mes, dia).toLocaleDateString('pt-br')
                        var partes = dataNascto.split('/');
                        dataNascto = partes[0] + '/' + partes[1] + '/' + partes[2];                   

                        dataNasctoinput = document.getElementById('dataNascto')
                        dataNasctoinput.value = dataNascto

                        descricao = document.getElementById('descricao')
                        descricao.value = '<?php echo $descricao?>'     
                        
                        idConsulta = document.getElementById('idConsulta')
                        idConsulta.value = '<?php echo $idConsulta?>'     
    
                        dataConsultaAgendada = document.getElementById('dataConsultaAgendada')
                        dataConsultaAgendada.value = '<?php echo $dataConsultaAgendada?>'   
                        
                        horaConsulta = document.getElementById('horaConsulta')
                        horaConsulta.value = '<?php echo $horaConsulta?>'

                        idAnimal = document.getElementById('idAnimal')
                        idAnimal.value = '<?php echo $idAnimal?>'

        <?php 

                        // Seção Histórico Médico
                        $queryHistorico = "SELECT * FROM historicoMedico WHERE idAnimal = '$idAnimal'";
                        $resultadoHistorico = mysqli_query($conexao, $queryHistorico);
                        if (!$resultadoConsultorio){
                            echo "ERRO AO BUSCAR HISTÓRICO MÉDICO: " . mysqli_error($conexao);
                        }
                        else{
                            while ($row = mysqli_fetch_assoc($resultadoHistorico)){
                                $dataConsulta = $row['dataConsulta'];
                                $peso = $row['peso'];
                                $temperatura = $row['temperatura'];
                                $diagnostico = $row['diagnostico'];
                                $tratamento = $row['tratamento'];      
                                $observacoes = $row['observacoes'];
        ?>
                                var dataConsultaHistoricoM = '<?php echo $dataConsulta?>'
                                // Converte a data do histórico médico do animal
                                var partesdata = dataConsultaHistoricoM.split('-');
                                var dia = partesdata[2];
                                var mes = partesdata[1] - 1; 
                                var ano = partesdata[0];
                                var dataConsultaHistoricoM = new Date(ano, mes, dia).toLocaleDateString('pt-br')
                                var partes = dataConsultaHistoricoM.split('/');
                                dataConsultaHistoricoM = partes[0] + '/' + partes[1] + '/' + partes[2];                   


                                var container = document.getElementById('historicoMedico')
                                var dataConsultaHM = document.createElement('span')
                                dataConsultaHM.innerHTML =  dataConsultaHistoricoM
                                container.appendChild(dataConsultaHM)
                                dataConsultaHM.style.color = "#2c476e"
                                dataConsultaHM.style.fontWeight = "bold"

                                var peso = document.createElement('span')
                                peso.innerHTML =  "Peso: " + '<?php echo $peso?>'
                                container.appendChild(peso)

                                var temperatura = document.createElement('span')
                                temperatura.innerHTML =  "Temperatura: " + '<?php echo $temperatura?>'
                                container.appendChild(temperatura)

                                var diagnostico = document.createElement('span')
                                diagnostico.innerHTML =  "Diagnóstico: " + '<?php echo $diagnostico?>'
                                container.appendChild(diagnostico)

                                var tratamento = document.createElement('span')
                                tratamento.innerHTML =  "Tratamento: " + '<?php echo $tratamento?>'
                                container.appendChild(tratamento)

                                var observacoes = document.createElement('span')
                                observacoes.innerHTML =  "Observações: " + '<?php echo $observacoes?>'
                                observacoes.style.marginBottom = '15px'
                                container.appendChild(observacoes)
        <?php
                            }   
                        }
                    }
                }
                else{
        ?>          
                    // Aviso para caso não haja pacientes em consultório
                    var container = document.getElementById('historicoMedico')
                    var aviso = document.createElement('span')
                    aviso.innerHTML =  "Nenhum paciente em consultório."
                    container.appendChild(aviso)              
                    aviso.style.position = "absolute"
                    aviso.style.color = "#F00"
                    aviso.style.bottom = "50%"
                    aviso.style.left = "50%"
                    aviso.style.transform = "translateX(-50%)"
                    aviso.style.fontSize = "2.5vh "

                    var inputs = document.querySelectorAll('input')
                    var textArea = document.querySelector('textArea')
                    inputs.forEach(input => {
                        input.style.pointerEvents = 'none';
                    });
                    textArea.style.pointerEvents = 'none'

                    var btn = document.getElementById('submit') 
                    container = document.querySelector('.submit-container')
                    container.style.pointerEvents = "none"
                    btn.style.pointerEvents = "none"
                    btn.disabled = true;
                    btn.style.backgroundColor = "#616161"; 
                
        <?php
                }
            }
        
        ?>

        // Script para data e hora em tempo real
        function atualizarHora() {
                var elementoHora = document.getElementById('hora-atual');
                var Horario = new Date();

                var horaAtual = Horario.getHours();
                var minutoAtual = Horario.getMinutes();
                var segundoAtual = Horario.getSeconds();

                var horaFormatada = (horaAtual < 10 ? '0' : '') + horaAtual;
                var minutoFormatado = (minutoAtual < 10 ? '0' : '') + minutoAtual;
                var segundoFormatado = (segundoAtual < 10 ? '0' : '') + segundoAtual;

                elementoHora.textContent = horaFormatada + ':' + minutoFormatado + ':' + segundoFormatado;
                setTimeout(atualizarHora, 1000);
            }
            function atualizarData() {
                var elementoData = document.getElementById('data-atual');
                var Horario = new Date();
                var dataFormatada = Horario.toLocaleDateString('pt-BR');
                
                elementoData.textContent = dataFormatada;
            }
            atualizarHora();
            atualizarData();

    });

</script>