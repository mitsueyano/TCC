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
                <!-- Seção Calendário -->
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
            </div>
            <!-- Seção Modal -->
            <div id="modal" class="modal">
                <div class="modal-content" id="modal-content">
                    <div class="btn-close" id="btn-close"><span class="close" onclick="fecharModal()">&times;</span></div>
                    <span id="dataConsulta" class="dataConsulta"></span>  
                    <div class="container-agenda escondido"> 

                    <div class="flex idConsulta">
                        <div class="label-flexModal">
                            <span>ID da consulta:</span>
                        </div>
                        <div class="label-flexModalInfo">
                            <span id="idConsulta"></span>   
                        </div>  
                    </div>

                    <div class="flex">
                        <div class="label-flexModal">
                            <span>Hora da consulta:</span>
                        </div>
                        <div class="label-flexModalInfo">
                            <span id="horaConsulta"></span>   
                        </div>
                    </div> 

                    <div class="flex">
                        <div class="label-flexModal">
                            <span>Nome</span>
                        </div>
                        <div class="label-flexModalInfo">
                            <span id="nomeAnimal"></span>   
                        </div>
                    </div> 

                    <div class="flex">
                        <div class="label-flexModal">
                            <span>Dono:</span>
                        </div>
                        <div class="label-flexModalInfo">
                            <span id="dono"></span>   
                        </div>
                    </div> 

                    <div class="flex">
                        <div class="label-flexModal">
                            <span>Descrição:</span>
                        </div>
                        <div class="label-flexModalInfo fim">
                            <span id="descricao"></span>   
                        </div>
                    </div> 

                    </div>
                </div>
            </div>
            <div id="modalBackdrop"></div>
    </body>

    <script>
        // Função para adicionar event listeners
        function adicionarEventListeners() {
            const dias = document.querySelectorAll('.dia');
            dias.forEach(dia => {
                dia.addEventListener('click', () => {
                    var diaSelecionado = dia.textContent;
                    var mesSelecionado = mesAtual + 1; // Adicionado 1 para corresponder ao formato do mês (janeiro = 1)
                    var anoSelecionado = anoAtual;
                });
            });
        }
        
        // Calendário
        let elemento = document.querySelector('.numeroDias');   
        let mesAtual = new Date().getMonth();
        let anoAtual = new Date().getFullYear();

        // Script para calcular o primeiro dia do mês
        function calcularPrimeiroDiaDoMes(mes, ano) {
                const primeiroDiaDoMes = new Date(ano, mes, 1).getDay();
                return (primeiroDiaDoMes === 0) ? 7 : primeiroDiaDoMes;
        }

        function atualizarCalendario(mes, ano) {
            elemento.innerHTML = '';
            const primeiroDiaDoMes = calcularPrimeiroDiaDoMes(mes, ano);
            const ultimoDiaDoMes = new Date(ano, mes + 1, 0).getDate();

            // Preenche os dias em branco até o primeiro dia do mês.
            for (let i = 1; i <= primeiroDiaDoMes; i++) {
                const span = document.createElement('span');
                span.classList.add('dia', 'dia-vazio');
                elemento.appendChild(span);
            }

            // Adiciona os dias do mês ao calendário.
            for (let i = 1; i <= ultimoDiaDoMes; i++) {
                const span = document.createElement('span');
                span.textContent = i;
                span.id = i;
                span.classList.add('dia');
                if (i === new Date().getDate() && mes === new Date().getMonth() && ano === new Date().getFullYear()) {
                    span.classList.add('dia-atual');
                }

                var diaFimDeSemana = new Date(ano, mes, i);
                if (diaFimDeSemana.getDay() === 0 || diaFimDeSemana.getDay() === 6) {
                    span.classList.add('fim-de-semana');
                    }
                elemento.appendChild(span);
            }   
            document.getElementById('mes-atual').textContent = `${mes + 1}/${ano}`;

            // Adicionado os event listeners novamente
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
            semanaVazia()
        });

        atualizarCalendario(mesAtual, anoAtual);
        adicionarEventListeners();

        // Identifica o dia selecionado
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('dia')) {
                var dia = event.target.textContent;
                var mesAtualStr = mesAtual.toString().padStart(2, '0');
                var mesSelecionado = (mesAtual + 1).toString().padStart(2, '0');
                abrirModal(dia, mesSelecionado, anoAtual);
            }
        }); 
           
        // Script para o modal
        <?php
            include '../php/conectaBD.php';
            $query = "SELECT Agenda.idConsulta, Agenda.descricao, Usuarios.nome AS veterinario, Animais.nome AS nomeanimal, Animais.especie, Animais.raca, Clientes.nome AS nomecliente, Agenda.dataConsulta, Agenda.horaConsulta
                        FROM Animais
                        INNER JOIN Agenda ON Animais.idAnimal = Agenda.idAnimal
                        INNER JOIN Usuarios ON Agenda.veterinario = Usuarios.idUsuario
                        INNER JOIN Clientes ON Animais.idCliente = Clientes.idCliente
                        GROUP BY Agenda.dataConsulta, Agenda.horaConsulta";

            $result = mysqli_query($conexao, $query);
            $linhas = [];
            while($linha = $result->fetch_row()) {
                $linhas[] = $linha;
            } 
            $agenda = json_encode($linhas);
            echo "var agenda = " . $agenda . ";\n";
        ?>

        // Abre o modal 
        function abrirModal(dia, mesSelecionado, anoAtual){
            dataSelecionada = anoAtual + "-" + mesSelecionado + "-" + dia
            dataExibida = dia + "/" + mesSelecionado + "/" + anoAtual
            document.getElementById('dataConsulta').innerHTML = dataExibida
            agenda.forEach(r=>{
                if (dataSelecionada == r[7]){
                    var clone = document.querySelector('.container-agenda').cloneNode(true)
                    clone.querySelector("#idConsulta").innerHTML =  r[0];
                    clone.querySelector("#horaConsulta").innerHTML = r[8];
                    clone.querySelector("#nomeAnimal").innerHTML =  r[3];
                    clone.querySelector("#dono").innerHTML = r[6]
                    clone.querySelector("#descricao").innerHTML =  r[1];
                    

                    clone.classList.remove('escondido')
                    
                    document.querySelector('.modal-content').appendChild(clone)
                }
                })

            var modalBackdrop = document.getElementById("modalBackdrop");
            modal.style.display = "block";
            modalBackdrop.style.display = "block";
        }

        // Fecha o modal
        function fecharModal(){
            document.querySelectorAll('.container-agenda').forEach(div => {
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
            if (!event.target.closest("#modal, .dia, #modalContent")) {

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
       

        function obterPrimeiraSemanaEMaisDiasDoMes(mes, ano) {
            const primeiroDiaDoMes = new Date(ano, mes, 1);
            const diaDaSemanaDoPrimeiroDia = primeiroDiaDoMes.getDay(); // 0 para domingo, 1 para segunda, etc

            const primeiraSemana = [];
            let diaAtual = 1;

            // Preenche a primeira semana com os primeiros dias do mês.
            for (let i = 0; i < 7; i++) {
                if (i < diaDaSemanaDoPrimeiroDia) {
                    primeiraSemana.push(null);
                } else {
                    primeiraSemana.push(diaAtual);
                    diaAtual++;
                }
            }

            return {
                primeiraSemana,
                diaDaSemanaDoPrimeiroDia
            };
        }

        // Script para remover semana que estiver vazia
        function semanaVazia(){
            // Seleciona todos os elementos 'span' no calendário
            const elementosSpan = document.querySelectorAll('.dia');

            // Percorre por todos os elementos 'span'
            elementosSpan.forEach(elemento => {
                // Verifica se o elemento possui a classe 'dia-vazio'
                if (elemento.classList.contains('dia-vazio')) {
                    // Oculta apenas os elementos com a classe 'dia-vazio'
                    elemento.style.display = 'none';
                }
            });
        }
        const elementosSpan = document.querySelectorAll('.dia');
        elementosSpan.forEach(elemento => {
            if (elemento.classList.contains('dia-vazio')) {
                elemento.style.display = 'none';
            }
        });
    </script>
</html>