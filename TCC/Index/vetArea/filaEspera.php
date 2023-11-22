<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início</title>
        <link rel="stylesheet" href="../../css/vetArea/filaEspera.css">
    </head>
    <body>
        <div class="border-page"></div>
        <div class="page">
            <div class="logo">
                <img src="../../img/CA.png" alt="logo">
            </div>
            <div class="bar">
                <div class="button"><a href="./InicioVet.php">INÍCIO</a></div>
                <div class="button selected"><a href="./filaEspera.php">FILA DE ESPERA</a></div>
            </div>
            <div class="container">     
                <!-- Seção tabela -->
                <span id="alerta"></span>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Veterinário</th>
                                <th scope="col">Animal</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php         
                                include '../../php/conectaBD.php';
                                $timezone = new DateTimeZone('America/Sao_Paulo');
                                $currentDateTime = new DateTime('now', $timezone);
                                $currentDate = $currentDateTime->format('Y-m-d');

                                $queryAgenda = "SELECT Agenda.*, Usuarios.nome, Animais.nome, statusConsulta.statusConsulta, Animais.idCliente, Clientes.nome
                                                FROM Animais
                                                INNER JOIN Agenda ON Animais.idAnimal = Agenda.idAnimal
                                                INNER JOIN Clientes ON Animais.idCliente = Clientes.idCliente
                                                INNER JOIN Usuarios ON Agenda.veterinario = Usuarios.idUsuario
                                                INNER JOIN statusConsulta ON Agenda.idStatus = statusConsulta.idStatus
                                                WHERE dataConsulta = '$currentDate'
                                                AND Agenda.idStatus = '1' OR Agenda.idStatus = '2'
                                                GROUP BY Agenda.horaConsulta";
                                $resultAgenda = mysqli_query($conexao, $queryAgenda);        
                                if ($resultAgenda->num_rows>0):
                                    while($arrayAgenda = mysqli_fetch_row($resultAgenda)):
                            ?>
                            <tr class="table-rows" id="<?php echo $arrayAgenda[0];?>">
                            <input type="hidden" value="<?php echo $arrayAgenda[10];?>" name="idCliente" id="idCliente">
                                <td><?php echo $arrayAgenda[0];?></td>
                                <td><?php echo $arrayAgenda[2];?></td>
                                <td><?php echo $arrayAgenda[7];?></td>
                                <td><?php echo $arrayAgenda[8];?></td>
                                <td><?php echo $arrayAgenda[4];?></td>
                                <td><?php echo $arrayAgenda[9];?></td>
                                <td class="more-list-container"> 
                                    <div class="list-box">
                                        <button class="more-btn" onclick="abrirModal(`<?php echo $arrayAgenda[0]?>`, `<?php echo $arrayAgenda[8]?>`, `<?php echo $arrayAgenda[11]?>`)">Chamar</button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Seção Modal -->
                            <div id="modal" class="modal">
                                <div class="modal-content" id="modal-content">
                                    <form action="../../php/vetArea/confirmarPresenca.php" method="POST" id="formulario">
                                        <input type="hidden" id="idConsulta" name="idConsulta" value="">
                                    </form>
                                    <span id="confirmar" class="confirmar"></span>
                                    <span id="id" class="id"></span>
                                    <span id="nomeAnimal" class="nomeAnimal"></span>
                                    <span id="nomeDono" class="nomeDono"></span>
                                    
                                    <div class="btn-modal-div">
                                        <span class="btn-modal cancelar" onclick="fecharModal()">Cancelar</span>
                                        <span class="btn-modal" onclick="confirmar()">Confirmar</span>
                                    </div>  
                                </div>
                            </div>
                            <div id="modalBackdrop"></div>
                            <?php
                                endwhile;
                                else:
                            ?>
                            <div class="center">
                                <span> Nenhuma entrada cadastrada.</span>
                            </div>
                            <?php 
                                endif;
                                mysqli_free_result($resultAgenda);
                            ?>
                        </tbody>
                    </table>     
                </div>
                <!-- Seção - DATA E HORA -->
                <div class="data">
                    <div class="dia" id="data-atual"></div> 
                    <div class="hora" id="hora-atual"></div>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
        document.addEventListener("DOMContentLoaded", function(){
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
                
        ?>
            var btn = document.querySelectorAll('.more-btn') 
            var alerta = document.getElementById('alerta')
            btn.forEach(function(button) {
                button.disabled = true;
                button.style.backgroundColor = "#616161"; 
                button.style.pointerEvents = "none"
                alerta.textContent = "Finalize a consulta atual antes de chamar o próximo animal ao consultório."
                alerta.style.color = "#FF0000"
                alerta.style.fontFamily = "'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif"   
            });
        <?php
                
                }
            }
            
        ?>
        });

        var modal = document.getElementById('modal')
        // Abre o modal
        function abrirModal(idConsulta, nomeAnimal, nomeDono){
            var btn = document.querySelector(".more-btn");
            var modalBackdrop = document.getElementById("modalBackdrop");
            modal.style.display = "block";
            modalBackdrop.style.display = "block";
            document.getElementById('confirmar').textContent = "Aguardando..."
            document.getElementById('id').textContent = "ID: " + idConsulta
            document.getElementById('nomeAnimal').textContent = "Nome do animal: " + nomeAnimal
            document.getElementById('nomeDono').textContent = "Dono: " + nomeDono
            document.querySelector("#idConsulta").value = idConsulta

        }
        // Fecha o modal
        function fecharModal(){
            var span = document.getElementsByClassName("close");
            var modalBackdrop = document.getElementById("modalBackdrop");
            modal.style.display = "none";
            modalBackdrop.style.display = "none";
        }

        //Animação do modal
        window.onclick = function(event) {
            if (!event.target.closest(".more-btn, #modalContent, #modal")) {

                const divTremor = document.getElementById('modal');

                function startTremor() {
                    divTremor.classList.add('shake');
                }

                function stopTremor() {
                    divTremor.classList.remove('shake');
                }
                startTremor();
                setTimeout(stopTremor, 500);
            }   
        }

        // Envia o formulário
        function confirmar() {
            const formulario = document.getElementById("formulario");
            formulario.submit();
        }

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
</script>
