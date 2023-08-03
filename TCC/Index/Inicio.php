<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início</title>
        <link rel="stylesheet" href="./Inicio.css">
    </head>
    <body>
        <div class="border-page"></div>
        <div class="page">
            <div class="bar">
                <div class="button selected"><a href="./Inicio.php">INÍCIO</a></div>
                <div class="button"><a href="./Agenda.php">AGENDA</a></div>
                <div class="button"><a href="aqui">CADASTRO</a></div>
            </div>
            <div class="container">     
                <div class="tablebar">
                    <div class="tablebar-button selected"><a href="./Inicio.php">ESCANEAR QR CODE</a></div>
                    <div class="tablebar-button"><a href="./Agenda.php">NOVA CONSULTA</a></div>  
                </div>  
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Dono</th>
                                <th scope="col">Animal</th>
                                <th scope="col">Situação</th>
                                <th scope="col">Saída</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php         
                                include 'conectaBD.php';
                                $query = "select * From agenda";
                                $result = mysqli_query($conexao, $query);                    
                                if ($result->num_rows>0):
                                    while($array = mysqli_fetch_row($result)):
                            ?>
                            <tr class="table-rows" id="<?php echo $array[0];?>" onmouseenter="mostrarInfo(this.id)">
                                <td><?php echo $array[0];?></td>
                                <td><?php echo $array[1];?></td>
                                <td><?php echo $array[2];?></td>
                                <td><?php echo $array[3];?></td>
                                <td><?php echo $array[4];?></td>
                                <td class="checkout-btn"> 
                                    <a href="editar.php" class="checkout">Check-out</a>
                                </td>
                                <td class="more-list-container"> 
                                    <div class="list-box">
                                        <button class="more-btn">...</button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                endwhile;
                                else:
                            ?>
                            <tr>
                                <td colspan="3"> Nenhuma entrada cadastrada.</td>
                            </tr>
                            <?php 
                                endif;
                                mysqli_free_result($result);
                            ?>
                        </tbody>
                    </table>     
                </div>
                <div class="container-info">
                    <span id="infoId"></span>
                    <span id="infoNome"></span>
                    <span id="infoDono"></span>      
                    <button id="btn-modal" onclick="abrirModal()" class="btn-open-modal">abrir modal</button>    
                </div>
                <div class="data">
                    <div class="dia" id="data-atual"></div> 
                    <div class="hora" id="hora-atual"></div>
                </div>
            </div>
            <div id="modal" class="modal">
                <div class="modal-content" id="modal-content">
                    <div class="btn-close"><span class="close" onclick="fecharModal()">&times;</span></div>
                    <span>Texto do modal</span>
                </div>
            </div>
        </div>
        <div id="modalBackdrop"></div>
        <script>
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
            <?php
                include 'conectaBD.php';
                $query = "select * From agenda";
                $result = mysqli_query($conexao, $query);
                $linhas = [];
                while($linha = $result->fetch_row()) {
                    $linhas[] = $linha;
                } 
                $agenda = json_encode($linhas);
                echo "var agenda = " . $agenda . ";\n";
            ?>
            function mostrarInfo(id){
                agenda.forEach(g=>{
                    if (g[0] == id){
                        document.querySelector("#infoId").innerHTML = g[0];
                        document.querySelector("#infoNome").innerHTML = g[1];
                        document.querySelector("#infoDono").innerHTML = g[2];
                    }
                })
            }
            function abrirModal(){
                var btn = document.getElementById("btn-modal");
                var modalBackdrop = document.getElementById("modalBackdrop");
                modal.style.display = "block";
                modalBackdrop.style.display = "block";
            }
            function fecharModal(){
                var span = document.getElementsByClassName("close");
                var modalBackdrop = document.getElementById("modalBackdrop");
                modal.style.display = "none";
                modalBackdrop.style.display = "none";
            }
            var modal = document.getElementById("modal");
            var botao = document.getElementById("btn-modal");
            var modalContent = document.getElementById("modal-content");
            window.onclick = function(event) {
                if (!event.target.closest("#modal, #botao, #modalContent") && event.target !== botao) {
                    modal.style.display = "none";
                    modalBackdrop.style.display = "none";
                }
            }
        </script>
    </body>
</html>