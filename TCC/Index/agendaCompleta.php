<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início</title>
        <link rel="stylesheet" href="../Css/agendaCompleta.css">
    </head>
    <body>
        <div class="border-page"></div>
        <div class="page">
            <div class="bar">
                <div class="button"><a href="./Agenda.php">VOLTAR</a></div>
            </div>
            <div class="container">    
                <div class="calendario">
                    <div class="mes-nav">
                    <div class="options-container">  
                        <div class= "btnOptionsDiv">
                            <div class="buttonOptions" id="mes-anterior"><button>MÊS ANTERIOR</button></div>
                        </div>
                    </div>  
                        <h2 id="mes-atual"></h2>
                        <div class="options-container">  
                        <div class= "btnOptionsDiv">
                            <div class="buttonOptions"><button id="mes-seguinte">MÊS SEGUINTE</button></div>
                        </div>
                    </div>  
                    </div>
                    <div class="diasSemana">
                        <span>Domingo</span>
                        <span>Segunda</span>
                        <span>Terça</span>
                        <span>Quarta</span>
                        <span>Quinta</span>
                        <span>Sexta</span>
                        <span>Sábado</span>
                    </div>
                    <div class="numeroDias"></div>
                </div> 
                <span>Clique em um dia para mais opções</span>
                <div class="containerInfo">
                    
                </div>
            </div>
    </body>
    <script>

        document.addEventListener("DOMContentLoaded", function () {
            <?php
            if (isset($_GET['data']) && $_GET['data'] !== "null") {
                $jsonData = json_decode($_GET['data'], true);
                if ($jsonData !== null && is_array($jsonData)) {
            ?>
                    let elemento = document.querySelector('.containerInfo');
                    elemento.innerHTML = ''; // Limpa o conteúdo do elemento

                    <?php
                    foreach ($jsonData as $consulta) {
                    ?>
                        var span = document.createElement('span');
                        span.textContent = '<?php echo $consulta['idConsulta'] . " " . $consulta['descricao']; ?>';
                        elemento.appendChild(span);
                    <?php
                    }
                    ?>
            <?php
                }   
            }
            ?>
        });




        // Função para adicionar event listeners
        function adicionarEventListeners() {
            const dias = document.querySelectorAll('.dia');
            dias.forEach(dia => {
                dia.addEventListener('click', () => {
                    var diaSelecionado = dia.textContent;
                    var mesSelecionado = mesAtual + 1; // Adicionado 1 para corresponder ao formato do mês (janeiro = 1)
                    var anoSelecionado = anoAtual;

                    window.location.href = "../php/pesquisarDia.php?diaSelecionado=" + diaSelecionado + "&mesSelecionado=" + mesSelecionado + "&anoSelecionado=" + anoSelecionado;
                });
            });
        }

        // Calendário
        let elemento = document.querySelector('.numeroDias');
        let mesAtual = new Date().getMonth();
        let anoAtual = new Date().getFullYear();

        function atualizarCalendario(mes, ano) {
            elemento.innerHTML = '';
            const ultimoDiaDoMes = new Date(ano, mes + 1, 0).getDate();
            for (let i = 1; i <= ultimoDiaDoMes; i++) {
                const span = document.createElement('span');
                span.textContent = i;
                span.id = i;
                span.classList.add('dia');
                if (i === new Date().getDate() && mes === new Date().getMonth() && ano === new Date().getFullYear()) {
                    span.classList.add('dia-atual');
                }
                elemento.appendChild(span);
            }
            document.getElementById('mes-atual').textContent = `${mes + 1}/${ano}`;

            // Após atualizar o calendário, adicionado os event listeners novamente
            adicionarEventListeners();
        }

        // Script para o mês anterior
        document.getElementById('mes-anterior').addEventListener('click', () => {
            mesAtual--;
            if (mesAtual < 0) {
                mesAtual = 11;
                anoAtual--;
            }
            atualizarCalendario(mesAtual, anoAtual);
        });

        // Script para o mês seguinte
        document.getElementById('mes-seguinte').addEventListener('click', () => {
            mesAtual++;
            if (mesAtual > 11) {
                mesAtual = 0;
                anoAtual++;
            }
            atualizarCalendario(mesAtual, anoAtual);
        });

        atualizarCalendario(mesAtual, anoAtual);
        adicionarEventListeners();

    </script>
</html>