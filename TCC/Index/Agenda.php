<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início</title>
        <link rel="stylesheet" href="../Css/Agenda.css">
    </head>
    <body>
        <div class="border-page"></div>
        <div class="page">
            <div class="logo">
                <img src="../img/CA.png" alt="logo">
            </div>
            <div class="bar">
                <div class="button"><a href="./Inicio.php">INÍCIO</a></div>
                <div class="button selected"><a href="./Agenda.php">AGENDA</a></div>
                <div class="button"><a href="./cadastro.php">CADASTRO</a></div>
            </div>
            <div class="container"> 
                <div class="gerenciamento-container">
                    <div class="search-container">
                    <div class="options-container">  
                        <div class= "btnOptionsDiv">
                            <div class="buttonOptions"><a href="./novaConsulta.php">NOVA CONSULTA</a></div>
                        </div>
                        <div class= "btnOptionsDiv">
                            <div class="buttonOptions"><a href="./agendaCompleta.php">VER AGENDA COMPLETA</a></div>
                        </div>
                    </div> 
                        <form method="post" action="agenda.php" class="search-items">
                            <input type="text" name="termo_pesquisa" placeholder="Procurar ID de consulta">
                            <button type="submit" class="search-btn">
                                <img src="../img/searchWhite.png" alt="Imagem 1" class="imagem-normal">
                                <img src="../img/search.png" alt="Imagem 2" class="imagem-hover">
                            </button>
                        </form>
                    </div>  
                    <!-- Seção Modal -->
                    <div id="modal" class="modal">
                            <div class="modal-content modal-content-reg" id="modal-content">
                                <div class="btn-close" id="btn-close"><span class="close" onclick="fecharModal()">&times;</span>
                            </div>
                            <span id="msg"></span>
                        </div>
                    </div>
                    <div id="modalBackdrop"></div>
                    <?php
                        include '../php/conectaBD.php';
                        $termo_pesquisa = "";
                        if (isset($_POST["termo_pesquisa"])) {
                            $termo_pesquisa = $_POST["termo_pesquisa"];
                        }
                            // Consulta SQL para buscar animais com base no termo de pesquisa
                            $sql = "SELECT Agenda.idConsulta, Agenda.dataConsulta, Agenda.horaConsulta, Agenda.veterinario, Agenda.descricao, Agenda.idAnimal FROM Agenda
                                    WHERE agenda.idConsulta LIKE '%$termo_pesquisa%'";

                            $result = $conexao->query($sql);

                            if ($result->num_rows > 0):
                    ?>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr class="table-rows">
                                    <th>ID da consulta</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Veterinário</th>
                                    <th>Descrição</th>
                                    <th>ID do Animal</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php 
                            $i = 0;
                            while ($array = $result->fetch_assoc()):
                                $data = explode('-', $array["dataConsulta"]);
                                $dataCompleta = $data[2] . "/" . $data[1] . "/" . $data[0];
                            $i++; 
                            ?>

                                <tr class="table-rows">
                                    <td class="consultaPesquisa<?php echo $i?> consultaConfere"><?php echo $array["idConsulta"]; ?></td>
                                    <td><?php echo $dataCompleta; ?></td>
                                    <td><?php echo $array["horaConsulta"]; ?></td>
                                    <td><?php echo $array["veterinario"]; ?></td>
                                    <td><?php echo $array["descricao"]; ?></td>
                                    <td><?php echo $array["idAnimal"]; ?></td>
                                    <td class="btnTabelaContainer"> 
                                        <form method="POST" action="../php/deletarConsulta.php" class="btn-tabela form-consulta<?php echo $array["idConsulta"]; ?>">     
                                        <input type="hidden" id="inputIdConsulta">                
                                        <input type="hidden" name="idConsulta" value="<?php echo $array["idConsulta"] ?>">                  
                                        <button type="button" onclick='confirmarConsulta(`<?php echo $array["idConsulta"] ?>`)'><img src="../img/lixo.png" alt="lixo.png"></button>
                                        </form>
                                    </td>
                                    <td class="btnTabelaContainer"></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                    <?php
                        else:
                            echo "Nenhum resultado encontrado.";
                        endif;
                        $conexao->close();
                    ?>
                </div>
                <!-- Seção Modal -->
                <div id="modal" class="modal">
                    <div class="modal-content modal-content-reg" id="modal-content">
                        <div class="btn-close" id="btn-close"><span class="close" onclick="fecharModal()">&times;</span>
                    </div>
                    <span id="msg"></span>
                </div>
            </div>
            <div id="modalBackdrop"></div>

             <!-- Seção Modal Confirmação - Deletar consulta -->
             <div id="modalConsulta" class="modalConsulta">
                    <div class="modal-content" id="modal-content">
                        <span id="msgConsulta"></span>
                        <div class="btn-modal-div-co">
                            <span class="btn-modal cancelar" onclick="fecharModalConsulta()">Cancelar</span>
                            <span class="btn-modal" onclick="removerConsulta()">Remover</span>
                        </div>  
                    </div>
                </div>
            </div>
    </body>
</html>
<script>
   

    document.addEventListener('DOMContentLoaded', function() {
        <?php
            if (isset($_GET['consultaDeletada']) && $_GET['consultaDeletada'] === 'sucesso') {
                $msg = "CONSULTA DELETADA."
                ?>
                abrirModal()
                document.getElementById('msg').textContent = '<?php echo $msg ?>'
        <?php
            }
        ?>

        var i = 1
            const linhas = document.querySelectorAll('.consultaConfere');
            linhas.forEach(linhas => {
                var consultaPesquisa = document.querySelector('.consultaPesquisa' + i).textContent
                if (consultaPesquisa == '<?php echo $termo_pesquisa?>'){
                    linha = document.querySelector('.consultaPesquisa' + i)
                    elemento = linha.parentElement
                    elemento.style.fontWeight = 'bold'
                    elemento.style.fontSize = '2.6vh'
                }
                i++
            });
    })

    function confirmarConsulta(idConsulta){
        abrirModalConsulta()
        document.querySelector('#msgConsulta').textContent = "Deseja remover a consulta " + idConsulta + "?"
        document.querySelector("#inputIdConsulta").value = idConsulta
    }
    function removerConsulta(){
            var idConsultaForm = document.querySelector("#inputIdConsulta").value
            document.querySelector('.form-consulta' + idConsultaForm).submit()
    }
    
    // Seção Modal
    var modal = document.getElementById('modal')
    // Abre o modal - Cliente
    function abrirModal(){
        var modalBackdrop = document.getElementById("modalBackdrop");
        modal.style.display = "block";
        modalBackdrop.style.display = "block";          
    }
    // Fecha o modal - Cliente
    function fecharModal(){
        var modalBackdrop = document.getElementById("modalBackdrop");
        modal.style.display = "none";
        modalBackdrop.style.display = "none";
    }

    //Animação do modal
    window.onclick = function(event) {
        if (!event.target.closest(".more-btn, #modalContent, #modal, #modalConsulta, img    ")) {

            const divTremor = document.getElementById('modal');
            const divTremorConsulta = document.getElementById('modalConsulta');

            function startTremor() {
                divTremor.classList.add('shake');
                divTremorConsulta.classList.add('shake');
            }

            function stopTremor() {
                divTremor.classList.remove('shake');
                divTremorConsulta.classList.remove('shake');
            }
            startTremor();
            setTimeout(stopTremor, 500);
        }   
    }

    // Seção MODAL - Deletar consulta
    var modalConsulta = document.getElementById('modalConsulta')
    // Abre o modal Consulta
    function abrirModalConsulta(){
        var modalBackdrop = document.getElementById("modalBackdrop");
        modalConsulta.style.display = "block";
        modalBackdrop.style.display = "block"; 
    }
    // Fecha o modal Consulta
    function fecharModalConsulta(){
        var modalBackdrop = document.getElementById("modalBackdrop");
        modalConsulta.style.display = "none";
        modalBackdrop.style.display = "none";
    }

</script>


