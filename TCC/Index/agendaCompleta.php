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
            <div class="logo">
                <img src="../img/CA.png" alt="logo">
            </div>
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
                    <div class="headerModal">
                        <span id="dataConsulta" class="dataConsulta"></span>  
                        <div class="btn-close" id="btn-close">
                            <a href="./novaConsulta.php?data=" class="close add">Agendar nova consulta</a>
                            <span class="close" onclick="fecharModal()">&times;</span>
                        </div>
                    </div>
                    <div class='divAviso'></div>
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
                    var diaSelecionado = dia.childNodes[0].textContent.replace(/\D/g, ''); // Identifica o primeiro filho do elemento dia e remove caracteres não numéricos
                    var mesSelecionado = mesAtual + 1; // Adicionado 1 para corresponder ao formato do mês (janeiro = 1)
                    var anoSelecionado = anoAtual;

                    var diaTotal = diaSelecionado + "/" + mesSelecionado + "/" + anoSelecionado;

                    diaSelecionado = parseInt(diaSelecionado);
                    mesSelecionado = parseInt(mesSelecionado);
                    anoSelecionado = parseInt(anoSelecionado);

                    // Script para adicionar zeros à esquerda, se necessário.
                    var diaString = diaSelecionado.toString().padStart(2, '0');
                    var mesString = mesSelecionado.toString().padStart(2, '0');
                    var anoString = anoSelecionado.toString();

                    diaConsulta = diaString + "-" + mesString + "-" + anoString;

                    document.querySelector('.add').href = "./novaConsulta.php?paraAgendar=" + diaConsulta;

                    // Script para remover o botão 'Agendar nova consulta' caso o dia selecionado seja menor que o dia atual
                    let diaAtualConf = new Date().getDate();
                    let mesAtualConf = new Date().getMonth();
                    let anoAtualConf = new Date().getFullYear();

                    dataAtualConf = new Date(anoAtualConf, mesAtualConf, diaAtualConf)
                    dataSelecionadaConf = new Date(anoSelecionado, mesSelecionado - 1, diaSelecionado)

                    if (dataSelecionadaConf <= dataAtualConf){
                        document.querySelector('.add').classList.add('escondido')
                    }
                    else(
                        document.querySelector('.add').classList.remove('escondido')
                    )
                    
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
                span.classList.add('dia', 'dia-vazio' + i);
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

                // Adiciona div para quantidade de consultas em cada dia do mês
                if (!span.classList.contains('fim-de-semana')){

                    const innerSpan = document.createElement('div')
                    innerSpan.classList.add('quantConsulta' + i)
                    span.appendChild(innerSpan);
                    elemento.appendChild(span);

                    const spanQuant = document.createElement('span')
                    spanQuant.classList.add('quant' + i)
                    innerSpan.appendChild(spanQuant)
                }
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
            quantAgendados(mesAtual, anoAtual)
            semanaVazia()
        });

        // Script para o mês seguinte
        document.getElementById('mes-seguinte').addEventListener('click', () => {
            mesAtual++;
            if (mesAtual > 11) {
                mesAtual = 0;
                anoAtual++;
            }
            atualizarCalendario(mesAtual, anoAtual);
            quantAgendados(mesAtual, anoAtual)
            semanaVazia()
        });

        atualizarCalendario(mesAtual, anoAtual);
        adicionarEventListeners();

        // Identifica o dia selecionado
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('dia')) {
                var dia = event.target.firstChild.textContent.trim();
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
            $numLinhas = mysqli_num_rows($result);
            while($linha = $result->fetch_row()) {
                $linhas[] = $linha;
            } 
            $agenda = json_encode($linhas);
            echo "var agenda = " . $agenda . ";\n";
        ?>

        // Abre o modal 
        function abrirModal(dia, mesSelecionado, anoAtual) {
            dataSelecionada = anoAtual + "-" + mesSelecionado + "-" + dia.toString().padStart(2, '0');
            dataExibida = dia.toString().padStart(2, '0') + "/" + mesSelecionado + "/" + anoAtual;
            document.getElementById('dataConsulta').innerHTML = dataExibida;

            var consultasDoDia = agenda.filter(r => dataSelecionada === r[7]);
            // Script para identificar se há consultas para o dia selecionado
            if (consultasDoDia.length === 0) {
                var divAviso = document.querySelector('.divAviso');
                var aviso = document.createElement('span');
                aviso.classList.remove('escondido')
                aviso.textContent = "Não há consultas para este dia.";
                divAviso.appendChild(aviso);
            } else {
                consultasDoDia.forEach(r => {
                    var clone = document.querySelector('.container-agenda').cloneNode(true);
                    clone.querySelector("#idConsulta").innerHTML = r[0];
                    clone.querySelector("#horaConsulta").innerHTML = r[8];
                    clone.querySelector("#nomeAnimal").innerHTML = r[3];
                    clone.querySelector("#dono").innerHTML = r[6];
                    clone.querySelector("#descricao").innerHTML = r[1];

                    clone.classList.remove('escondido');
                    document.querySelector('.modal-content').appendChild(clone);
                });
            }
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
            var aviso = document.querySelector('.divAviso');
            if (aviso) {
                aviso.innerHTML = "";
            }

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

        function PrimeiraSemanaVazia(mes, ano) {
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

        // Script para remover fileira da semana vazia
        function semanaVazia(){
            i = 0
            const elementosSpan = document.querySelectorAll('.dia');
            elementosSpan.forEach(elemento => {
                if (elemento.classList.contains('dia-vazio' + 7)) { // Percorre por todos os dias
                    while (i <= 8){
                        i++
                        var diaVazio = document.querySelector('.dia-vazio' + i) // Seleciona a semana vazia inteira
                        checkDisplay = getComputedStyle(elemento).display;
                        if (checkDisplay != 'none'){
                            diaVazio.style.display = 'none' // Remove a semana vazia
                        }
                        
                    }
                }
            });
        }

        i = 0
        const elementosSpan = document.querySelectorAll('.dia');
        elementosSpan.forEach(elemento => {
            if (elemento.classList.contains('dia-vazio' + 7)) {
                while (i <= 7){
                    i++
                    var diaVazio = document.querySelector('.dia-vazio' + i)
                    checkDisplay = getComputedStyle(elemento).display;
                    if (checkDisplay != 'none'){
                        diaVazio.style.display = 'none'
                    }
                }
            }

        });


        // Script para adicionar quantidade de agendamentos aos dias do mês
        function quantAgendados(mesAtual, anoAtual){
            mesAtual = mesAtual + 1
            const elementosSpan = document.querySelectorAll('.dia');
            i = 0;
            elementosSpan.forEach(() => {
                i++;
                const elementoQuant = document.querySelector('.quant' + i);
                const divConsulta = document.querySelector('.quantConsulta' + i)
                if (elementoQuant) {
                    dataSelecionada = anoAtual + "-" + mesAtual.toString().padStart(2, '0') + "-" + i.toString().padStart(2, '0');
                    var consultasDoDia = agenda.filter(r => dataSelecionada === r[7]);

                    var dataSplit = dataSelecionada.split("-")
                    var diaSplit = dataSplit[2]
                    var mesSplit = dataSplit[1]
                    var anoSplit = dataSplit[0]

                    quantidade = consultasDoDia.length;
                    divConsulta.textContent = quantidade;
                    divConsulta.style.pointerEvents = 'none'
                    divConsulta.style.width = '17px'
                    divConsulta.style.height = '17px'
                    divConsulta.style.borderRadius = '100%'
                    divConsulta.style.display = 'flex'
                    divConsulta.style.justifyContent = 'center'
                    divConsulta.style.alignItems = 'center'
                    divConsulta.style.marginLeft = '10px'
                    divConsulta.style.marginTop = '1px'
                    divConsulta.style.color = 'black'
                    divConsulta.style.fontWeight = 'normal'
                    divConsulta.style.fontSize = '15px'
                    

                    if (divConsulta) {
                        if (quantidade === 0) {
                            divConsulta.style.backgroundColor = '#bbbdbf';
                        } else if (quantidade <= 7) {
                            divConsulta.style.backgroundColor = '#95c99b';
                        } else if (quantidade <= 16) {
                            divConsulta.style.backgroundColor = '#f9ffa6';
                        } else {
                            divConsulta.style.backgroundColor = '#fc7c7c';
                        }
                    }

                }

            })

        }
        quantAgendados(mesAtual, anoAtual)

    </script>
</html>