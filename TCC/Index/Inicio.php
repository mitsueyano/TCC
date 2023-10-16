<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início</title>
        <link rel="stylesheet" href="../Css/Inicio.css">
    </head>
    <body>
        <div class="border-page"></div>
        <div class="page">
            <div class="bar">
                <div class="button selected"><a href="./Inicio.php">INÍCIO</a></div>
                <div class="button"><a href="./Agenda.php">AGENDA</a></div>
                <div class="button"><a href="./cadastro.php">CADASTRO</a></div>
            </div>
            <div class="container">     
                <div class="tablebar">
                <div class="options-container">  
                            <div class= "btnOptionsDiv tablebar-button">
                                <div class="buttonOptions"><a href="">ESCANEAR QR CODE</a></div>
                            </div>
                        </div> 
                </div>  
                <!-- Seção TABELA -->
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
                                <th scope="col">Saída</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php         
                                include '../php/conectaBD.php';
                                $queryAgenda = "SELECT Agenda.*, Usuarios.nome, Animais.nome, statusConsulta.statusConsulta, Animais.idCliente
                                                FROM Animais
                                                INNER JOIN Agenda ON Animais.idAnimal = Agenda.idAnimal
                                                INNER JOIN Usuarios ON Agenda.veterinario = Usuarios.idUsuario
                                                INNER JOIN statusConsulta ON Agenda.idStatus = statusConsulta.idStatus
                                                GROUP BY Agenda.dataConsulta, Agenda.horaConsulta;";
                                $resultAgenda = mysqli_query($conexao, $queryAgenda);        
                                if ($resultAgenda->num_rows>0):
                                    while($arrayAgenda = mysqli_fetch_row($resultAgenda) ):
                                       
                            ?>
                            <tr class="table-rows" id="<?php echo $arrayAgenda[0];?>" onmouseenter="mostrarInfo(this.id)">
                            <input type="hidden" value="<?php echo $arrayAgenda[10];?>" name="idCliente" id="idCliente">
                                <td><?php echo $arrayAgenda[0];?></td>
                                <td><?php echo $arrayAgenda[2];?></td>
                                <td><?php echo $arrayAgenda[7];?></td>
                                <td><?php echo $arrayAgenda[8];?></td>
                                <td><?php echo $arrayAgenda[4];?></td>
                                <td><?php echo $arrayAgenda[9];?></td>
                                <td class="more-list-container"> 
                                    <div class="list-box">
                                        <button class="more-btn checkout" onclick="abrirModalCO(<?php echo $arrayAgenda[5]; ?>)">Check-out</button>
                                    </div>
                                </td>

                                <td class="more-list-container"> 
                                    <div class="list-box">
                                        <button class="more-btn registros" onclick="abrirModal(<?php echo $arrayAgenda[5]; ?>)"><img src="../img/registros.png" alt=""></button>
                                    </div>
                                </td>
                            </tr>
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
                <!-- Seção INFORMAÇÕES ADICIONAIS -->
                <div class="container-info">
                    <div class="flex">
                        <div class="label-flex">
                            <span>ID consulta: </span>
                        </div>
                        <div class="label-flex">
                            <span id="infoId"></span>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="label-flex">
                            <span>Nome: </span>
                        </div>
                        <div class="label-flex">
                            <span id="infoNome"></span>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="label-flex">
                            <span>Dono: </span>
                        </div>
                        <div class="label-flex">
                            <span id="infoDono"></span>   
                        </div>  
                    </div> 
                    <div class="flex">
                        <div class="label-flex">
                            <span>Espécie: </span>
                        </div>
                        <div class="label-flex">
                            <span id="infoEspecie"></span>      
                        </div>
                    </div>
                    <div class="flex">
                        <div class="label-flex">
                            <span>Raça: </span>
                        </div>
                        <div class="label-flex">
                            <span id="infoRaca"></span>   
                        </div>
                    </div>   
                    
                </div>
                <!-- Seção - DATA E HORA -->
                <div class="data">
                    <div class="dia" id="data-atual"></div> 
                    <div class="hora" id="hora-atual"></div>
                </div>
            </div>
            <!-- Seção Modal 'Histórico Médico' -->
            <div id="modal" class="modal">
                <div class="modal-content modal-content-reg" id="modal-content">
                    <div class="btn-close" id="btn-close"><span class="close" onclick="fecharModal()">&times;</span></div>
                    <div class="container-registros escondido">
                        <div class="flex dataConsulta">
                            <div class="label-flexModal">
                                <span id="infoDataConsulta"></span>   
                            </div>
                        </div>

                        <div class="flex">
                            <div class="label-flexModal">
                                <span>Veterinário: </span>
                            </div>
                            <div class="label-flexModalInfo">
                                <span id="infoVet"></span>   
                            </div>
                        </div>   

                            
                        <div class="flex">
                            <div class="label-flexModal">
                                <span>Diagnóstico: </span>
                            </div>
                            <div class="label-flexModalInfo">
                                <span id="infoDiagnostico"></span>   
                            </div>
                        </div> 

                        <div class="flex">
                            <div class="label-flexModal">
                                <span>Tratamento: </span>
                            </div>
                            <div class="label-flexModalInfo">
                                <span id="infoTratamento"></span>   
                            </div>
                        </div> 

                        <div class="flex">
                            <div class="label-flexModal obs">
                                <span>Observações: </span>
                            </div>
                            <div class="label-flexModalInfo">
                                <span id="infoObservacoes"></span>   
                            </div>
                        </div> 
                    </div>          
                </div>
            </div>

            <!-- Seção Modal 'Check-out' -->
            <div id="modalCO" class="modalCO">
                <div class="modal-content" id="modal-content">
                    <form action="../php/checkOut.php" method="POST" id="formCO">
                        <input type="hidden" id="idConsultaCO" name="idConsulta">
                    </form>
                <div class="btn-close" id="btn-close"><span class="close" onclick="fecharModalCO()">&times;</span></div>
                <span id="checkoutConfirmar" class="checkoutConfirmar">Deseja confirmar o checkout de <span id="nomeCO" class="nomeCO"></span>?</span>
                <div class="btn-modal-div-co">
                    <span class="btn-modal agendar" onclick="agendar()">Agendar retorno</span>
                    <span class="btn-modal" onclick="confirmar()">Confirmar</span>
                </div>  
                </div>
            </div>
        </div>
        <div id="modalBackdrop"></div>
        <script>
            document.addEventListener("DOMContentLoaded", function(){
                <?php
                    if (isset($_GET['ConsultaFinalizada']) && $_GET['ConsultaFinalizada'] === 'sucesso') {
                        echo 'alert("Check-out realizado com sucesso.")';
                    }
                ?>
            });

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

            // Script para informações adicionais - Campo inferior esquerdo da tela
            <?php
                include '../php/conectaBD.php';
                $queryAnimalInfo = "SELECT Agenda.*, Usuarios.nome, Animais.nome, Clientes.nome, Animais.especie, Animais.raca
                                    FROM Animais
                                    INNER JOIN Clientes ON Clientes.idCliente = Animais.idCliente
                                    INNER JOIN Agenda ON Animais.idAnimal = Agenda.idAnimal
                                    INNER JOIN Usuarios ON Agenda.veterinario = Usuarios.idUsuario
                                    GROUP BY Agenda.dataConsulta, Agenda.horaConsulta;";
                $result = mysqli_query($conexao, $queryAnimalInfo);
                $linhas = [];
                while($linha = $result->fetch_row()) {
                    $linhas[] = $linha;
                } 
                $animal = json_encode($linhas);
                echo "var animal = " . $animal . ";\n";
            ?>

            function mostrarInfo(id){
                animal.forEach(g=>{
                    if (g[0] == id){
                        document.querySelector("#infoId").innerHTML =  g[0];
                        document.querySelector("#infoDono").innerHTML =  g[9];
                        document.querySelector("#infoNome").innerHTML =   g[8];    
                        document.querySelector("#infoEspecie").innerHTML =   g[10];    
                        document.querySelector("#infoRaca").innerHTML =  g[11];    
                    }
                })
            }

            // Script para o modal
            <?php
                include '../php/conectaBD.php';
                $query = "SELECT Agenda.idConsulta, Agenda.descricao, Usuarios.nome AS veterinario, Animais.nome AS nomeanimal, Animais.especie, Animais.raca, Clientes.nome AS nomecliente, clientes.idCliente
                        FROM Animais
                        INNER JOIN Agenda ON Animais.idAnimal = Agenda.idAnimal
                        INNER JOIN Usuarios ON Agenda.veterinario = Usuarios.idUsuario
                        INNER JOIN Clientes ON Animais.idCliente = Clientes.idCliente
                        GROUP BY Agenda.dataConsulta, Agenda.horaConsulta;";

                $result = mysqli_query($conexao, $query);
                $linhas = [];
                while($linha = $result->fetch_row()) {
                    $linhas[] = $linha;
                } 
                $agenda = json_encode($linhas);
                echo "var agenda = " . $agenda . ";\n";



                $queryRegistros = "SELECT historicoMedico.* , Usuarios.nome FROM historicoMedico
                JOIN Animais ON historicoMedico.idAnimal = Animais.idAnimal
                JOIN Usuarios ON historicoMedico.veterinario = Usuarios.idUsuario
                ";
                 $resultRegistros = mysqli_query($conexao, $queryRegistros);
                 $linhasRegistros = [];
                 while($linhaRegistros = $resultRegistros->fetch_row()) {
                    $linhasRegistros[] = $linhaRegistros;
                } 
                $agendaRegistros = json_encode($linhasRegistros);
                echo "var agendaRegistros = " . $agendaRegistros . ";\n";

            ?>
            // Abre o modal com as informações
            function abrirModal(id){
                agendaRegistros.forEach(r=>{
                    if (r[9] == id){
                        var clone = document.querySelector('.container-registros').cloneNode(true)
                        clone.querySelector("#infoDataConsulta").innerHTML = r[1];
                        clone.querySelector("#infoVet").innerHTML = r[10];
                        clone.querySelector("#infoDiagnostico").innerHTML = r[6];
                        clone.querySelector("#infoTratamento").innerHTML =  r[7];
                        clone.querySelector("#infoObservacoes").innerHTML =  r[8];

                        clone.classList.remove('escondido')
                        
                        document.querySelector('.modal-content-reg').appendChild(clone)
                    }
                })

                var btn = document.querySelector(".more-btn");
                var modalBackdrop = document.getElementById("modalBackdrop");
                modal.style.display = "block";
                modalBackdrop.style.display = "block";
            }
            // Fecha o modal
            function fecharModal(){
                document.querySelectorAll('.container-registros').forEach(div => {
                    if (!div.classList.contains('escondido')) {
                        div.outerHTML = ""
                    }
                })
                var span = document.getElementsByClassName("close");
                var modalBackdrop = document.getElementById("modalBackdrop");
                modal.style.display = "none";
                modalBackdrop.style.display = "none";
            }
            //Animação do modal
            window.onclick = function(event) {
                if (!event.target.closest("#modal, .more-btn, #modalContent, #modalCO")) {

                    const divTremor = document.getElementById('modal');
                    const divTremorCO = document.getElementById('modalCO');

                    function startTremor() {
                        divTremor.classList.add('shake');
                        divTremorCO.classList.add('shake');
                    }

                    function stopTremor() {
                        divTremor.classList.remove('shake');
                        divTremorCO.classList.remove('shake');
                    }
                    startTremor();
                    setTimeout(stopTremor, 500);
                }
                
            }

            // Abre o modal CHECK-OUT
            function abrirModalCO(id){
                agenda.forEach(g=>{
                    if (g[0] == id){
                        document.querySelector("#nomeCO").innerHTML = g[3];
                        document.querySelector("#idConsultaCO").value = g[0];
                        document.getElementById("idCliente").value = g[7];
                    }
                })

                var btn = document.querySelector(".more-btn");
                var modalBackdrop = document.getElementById("modalBackdrop");
                modalCO.style.display = "block";
                modalBackdrop.style.display = "block";
            }

            // Script agendar retorno
            function agendar(id){
                var idCliente
                idCliente = document.getElementById('idCliente').value
                window.location.href = "../index/novaConsulta.php" + '?data=%7B"id"%3A'+ idCliente +'%2C"nome"%3A""%7D&idCampo=' + idCliente + '&idResposta=' + idCliente
            }
            // Fecha o modal CHECK-OUT
            function fecharModalCO(){
                var span = document.getElementsByClassName("close");
                var modalBackdrop = document.getElementById("modalBackdrop");
                modalCO.style.display = "none";
                modalBackdrop.style.display = "none";
            }

            // Script Check-out
            function confirmar(){
                formCO.submit()
            }

        </script>
    </body>
</html>