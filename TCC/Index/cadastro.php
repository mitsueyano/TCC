<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início</title>
        <link rel="stylesheet" href="../Css/cadastro.css">
    </head>
    <body>
        <div class="border-page"></div>
        <div class="page">
            <div class="logo">
                <img src="../img/CA.png" alt="logo">
            </div>
            <div class="bar">
                <div class="button"><a href="./Inicio.php">INÍCIO</a></div>
                <div class="button"><a href="./Agenda.php">AGENDA</a></div>
                <div class="button selected"><a href="./cadastro.php">CADASTRO</a></div>
            </div>
            <div class="container"> 
                <div class="gerenciamento-container">
                    <div class="search-container">
                        <form method="post" action="cadastro.php" class="search-items">
                            <input type="text" name="termo_pesquisa" placeholder="Procurar Cliente / Animal / ID">
                            <button type="submit" class="search-btn">
                                <img src="../img/searchWhite.png" alt="Imagem 1" class="imagem-normal">
                                <img src="../img/search.png" alt="Imagem 2" class="imagem-hover">
                            </button>
                        </form>
                        <div class="options-container">  
                            <div class= "btnOptionsDiv">
                                <div class="buttonOptions"><a href="./novoCadastro.php">NOVO CADASTRO</a></div>
                            </div>
                        </div>  
                    </div>  
                    <div class="filtro-Div">
                        <span class="filtro-span filtrarPor">Filtrar por: </span>
                        <div class="cb-div">
                            <input type="checkbox" name="cbCliente" id="cbCliente" class="cb">
                            <span class="filtro-span">Cliente</span>
                        </div>
                        <div class="cb-div">
                            <input type="checkbox" name="cbAnimal" id="cbAnimal" class="cb">
                            <span class="filtro-span">Animal</span>
                        </div>
                    </div>  

                    <?php
                        include '../php/conectaBD.php';

                            $termo_pesquisa = "";
                            if(isset($_POST["termo_pesquisa"])){
                                $termo_pesquisa = $_POST["termo_pesquisa"];
                            }
                            // Consulta SQL para buscar animais com base no termo de pesquisa
                            $sqlAnimais = "SELECT animais.nome AS nome_animal, animais.especie AS animal_especie, animais.raca AS animal_raca, animais.idAnimal AS id_animal, clientes.nome AS nome_dono, clientes.idCliente AS id_dono 
                                    FROM animais
                                    JOIN clientes ON animais.idCliente = clientes.idCliente
                                    WHERE animais.nome LIKE '%$termo_pesquisa%'
                                    OR animais.especie LIKE '%$termo_pesquisa%'
                                    OR animais.raca LIKE '%$termo_pesquisa%'
                                    OR clientes.nome LIKE '%$termo_pesquisa%'
                                    OR animais.idAnimal = '$termo_pesquisa'";
                            $resultAnimais = $conexao->query($sqlAnimais);
                            if ($resultAnimais->num_rows > 0):
                    ?>

                                <div class="table-container" id="tabelaAnimais">
                                    <table>
                                        <thead>
                                            <tr class="table-rows">
                                                <th>ID do Animal</th>
                                                <th>Nome do Animal</th>
                                                <th>Espécie</th>
                                                <th>Raça</th>
                                                <th>Nome do Dono</th>
                                                <th>ID do Dono</th> 
                                                <th></th>
                                                <th></th>                                   
                                            </tr>
                                        </thead>
                                        <tbody>
                        <?php 
                                            // Preenche os dados dos animais
                                            while ($array = $resultAnimais->fetch_assoc()): 
                                                $nomeAnimal = $array['nome_animal'];
                        ?>  
                                                <tr class="table-rows">
                                                    <td><?php echo $array["id_animal"]; ?></td>
                                                    <td><?php echo $array["nome_animal"]; ?></td>
                                                    <td><?php echo $array["animal_especie"]; ?></td>
                                                    <td><?php echo $array["animal_raca"]; ?></td>
                                                    <td><?php echo $array["nome_dono"]; ?></td>
                                                    <td><?php echo $array["id_dono"]; ?></td>
                                                    <td class="btnTabelacontainer"> 
                                                        <form method="POST" action="editar.php" class="btn-tabela">
                                                            <input type="hidden" name="idCliente" value="<?php echo $array["id_dono"] ?>">
                                                            <button type="submit"><img src="../img/editar.png" alt="editar.png"></button>
                                                        </form>
                                                    </td>
                                                    <td class="btnTabelaContainer"> 
                                                        <form method="POST" action="../php/deletarAnimal.php" class="btn-tabela form-animal<?php echo $array["id_animal"]; ?>">
                                                            <input type="hidden" id="inputIdAnimal">        
                                                            <input type="hidden" name="idAnimal" value="<?php echo $array["id_animal"] ?>">
                                                        <button type="button" onclick='confirmarAnimal(`<?php echo $nomeAnimal; ?>`, `<?php echo $array["id_animal"]; ?>`)'><img src="../img/lixo.png" alt="lixo.png"></button> 
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>

                    <?php
                            else:
                                echo "Nenhum resultado de Animal encontrado.";
                            endif;
                        $conexao->close();
                        
                    ?>

                    <?php
                        include '../php/conectaBD.php';
                        $termo_pesquisa = "";
                        if(isset($_POST["termo_pesquisa"])){
                            $termo_pesquisa = $_POST["termo_pesquisa"];
                        }
                        // Consulta SQL para buscar clientes com base no termo de pesquisa
                        $sqlClientes = "SELECT idCliente as id_cliente, nome as nome_cliente, email as email_cliente, contato as contato_cliente, enderecoE as enderecoE_cliente, enderecoC as enderecoC_cliente, enderecoB as enderecoB_cliente, enderecoRN as enderecoRN_cliente FROM Clientes
                                WHERE idCliente LIKE'%$termo_pesquisa%'
                                OR nome LIKE '%$termo_pesquisa%'
                                OR email = '$termo_pesquisa'
                                OR enderecoE = '$termo_pesquisa'
                                OR enderecoC = '$termo_pesquisa'
                                OR enderecoB = '$termo_pesquisa'
                                ";
                        $resultClientes = $conexao->query($sqlClientes);
                        if ($resultClientes->num_rows > 0):
                    ?>

                            <div class="table-container" id="tabelaClientes">
                                <table>
                                    <thead>
                                        <tr class="table-rows">
                                            <th>ID do Cliente</th>
                                            <th>Nome do Cliente</th>
                                            <th>Email</th>
                                            <th>Contato</th>
                                            <th>Estado</th>
                                            <th>Cidade</th> 
                                            <th>Bairro</th> 
                                            <th>Rua</th> 
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    <?php 
                                        // Preenche os dados do cliente
                                        while ($array = $resultClientes->fetch_assoc()): 
                                            $nomeCliente= $array['nome_cliente'];
                    ?>
                                            <tr class="table-rows">
                                                <td><?php echo $array["id_cliente"]; ?></td>
                                                <td><?php echo $array["nome_cliente"]; ?></td>
                                                <td><?php echo $array["email_cliente"]; ?></td>
                                                <td><?php echo $array["contato_cliente"]; ?></td>
                                                <td><?php echo $array["enderecoE_cliente"]; ?></td>
                                                <td><?php echo $array["enderecoC_cliente"]; ?></td>
                                                <td><?php echo $array["enderecoB_cliente"]; ?></td>
                                                <td><?php echo $array["enderecoRN_cliente"]; ?></td>
                                                
                                                <td class="btnTabelacontainer"> 
                                                    <form method="POST" action="editar.php" class="btn-tabela">
                                                        <input type="hidden" name="idCliente" value="<?php echo $array["id_cliente"] ?>">
                                                        <button><img src="../img/editar.png" alt="editar.png"></button>
                                                    </form>
                                                </td>
                                                <td class="btnTabelaContainer"> 
                                                    <form method="POST" action="../php/deletarCliente.php" class="btn-tabela form-cliente<?php echo $array["id_cliente"]; ?>">         
                                                        <input type="hidden" id="inputIdCliente">        
                                                        <input type="hidden" name="idCliente" value="<?php echo $array["id_cliente"] ?>">                  
                                                    <button type="button" onclick='confirmarCliente(`<?php echo $nomeCliente; ?>`, `<?php echo $array["id_cliente"]; ?>`)'><img src="../img/lixo.png" alt="lixo.png"></button>
                                                    </form>
                                                </td>
                                            </tr>
                                    </tbody>
                    <?php 
                                        endwhile; 
                    ?>
                                </table>
                            </div>

                    <?php
                        else:
                            echo "<br>Nenhum resultado de Cliente encontrado.";
                        endif;
                        $conexao->close();
                    ?>
                </div>

                <!-- Seção Modal -->
                <div id="modal" class="modal">
                    <div class="modal-content" id="modal-content">
                        <div class="btn-close" id="btn-close">
                            <span class="close" onclick="fecharModal()">&times;</span>
                        </div>
                        <span id="msg"></span>
                    </div>
                </div>

                <!-- Seção Modal Confirmação - Animal -->
                <div id="modalCOAnimal" class="modalCOAnimal">
                    <div class="modal-content" id="modal-content">
                        <span id="msgAnimal"></span>
                        <div class="btn-modal-div-co">
                            <span class="btn-modal cancelar" onclick="fecharModalAnimal()">Cancelar</span>
                            <span class="btn-modal" onclick="removerAnimal()">Remover</span>
                        </div>  
                    </div>
                </div>

                 <!-- Seção Modal Confirmação - Cliente -->
                 <div id="modalCOCliente" class="modalCOCliente">
                    <div class="modal-content" id="modal-content">
                        <span id="msgCliente"></span>
                        <div class="btn-modal-div-co">
                            <span class="btn-modal cancelar" onclick="fecharModalCliente()">Cancelar</span>
                            <span class="btn-modal" onclick="removerCliente()">Remover</span>
                        </div>  
                    </div>
                </div>

            </div>
            <div id="modalBackdrop"></div>
    </body>
    
    <script>
        // Resultado do redirecionamento dos botões "Editar" e "Deletar"
        document.addEventListener("DOMContentLoaded", function () {
            <?php
                if (isset($_GET['animalDeletado']) && $_GET['animalDeletado'] === 'sucesso') {
                    $msg = "ANIMAL DELETADO COM SUCESSO."
            ?>
                    abrirModal()
                    document.getElementById('msg').textContent = '<?php echo $msg ?>'
            <?php
                }
                if (isset($_GET['clienteDeletado']) && $_GET['clienteDeletado'] === 'sucesso') {
                    $msg = "CLIENTE DELETADO COM SUCESSO."
            ?>
                    abrirModal()
                    document.getElementById('msg').textContent = '<?php echo $msg ?>'
            <?php
                }
                if (isset($_GET['alteracao']) && $_GET['alteracao'] === 'sucesso') {
                    $msg = "ALTERAÇÕES SALVAS."
            ?>
                    abrirModal()
                    document.getElementById('msg').textContent = '<?php echo $msg ?>'
            <?php
                }
                if (isset($_GET['cadastroCliente']) && $_GET['cadastroCliente'] === 'sucesso') {
                    $msg = "CLIENTE CADASTRADO."
            ?>
                    abrirModal()
                    document.getElementById('msg').textContent = '<?php echo $msg ?>'
            <?php
                }
            ?>
        });

        // Filtro de pesquisa
        var cbCliente = document.getElementById("cbCliente");
        var cbAnimal = document.getElementById("cbAnimal");

        const tabelaAnimais = document.getElementById("tabelaAnimais");
        const tabelaClientes = document.getElementById("tabelaClientes");

        // Script para verificar os estados dos checkboxes e atualizar a exibição
        function atualizarExibicao() {
            if (cbCliente.checked && cbAnimal.checked) {
                tabelaAnimais.classList.remove("escondido");
                tabelaClientes.classList.remove("escondido");
            } else if (cbCliente.checked) {
                tabelaAnimais.classList.add("escondido");
                tabelaClientes.classList.remove("escondido");
            } else if (cbAnimal.checked) {
                tabelaAnimais.classList.remove("escondido");
                tabelaClientes.classList.add("escondido");
            } 
            else{
                tabelaAnimais.classList.remove("escondido");
                tabelaClientes.classList.remove("escondido");
            }
        }
        cbCliente.addEventListener("change", atualizarExibicao);
        cbAnimal.addEventListener("change", atualizarExibicao);

        // Seção MODAL
        var modal = document.getElementById('modal')
        // Abre o modal
        function abrirModal(){
            var modalBackdrop = document.getElementById("modalBackdrop");
            modal.style.display = "block";
            modalBackdrop.style.display = "block";          
        }
        // Fecha o modal
        function fecharModal(){
            var span = document.getElementsByClassName("close");
            var modalBackdrop = document.getElementById("modalBackdrop");
            modal.style.display = "none";
            modalBackdrop.style.display = "none";
        }

        // Seção MODAL - ANIMAL
        var modalCOAnimal = document.getElementById('modalCOAnimal')
        // Abre o modal Animal
        function abrirModalAnimal(){
            var modalBackdrop = document.getElementById("modalBackdrop");
            modalCOAnimal.style.display = "block";
            modalBackdrop.style.display = "block"; 
        }
        // Fecha o modal Animal
        function fecharModalAnimal(){
            var modalBackdrop = document.getElementById("modalBackdrop");
            modalCOAnimal.style.display = "none";
            modalBackdrop.style.display = "none";
        }

        // Seção MODAL - CLIENTE
        var modalCOCliente = document.getElementById('modalCOCliente')
        // Abre o modal Cliente
        function abrirModalCliente(){
            var modalBackdrop = document.getElementById("modalBackdrop");
            modalCOCliente.style.display = "block";
            modalBackdrop.style.display = "block"; 
        }
        // Fecha o modal Cliente
        function fecharModalCliente(){
            var modalBackdrop = document.getElementById("modalBackdrop");
            modalCOCliente.style.display = "none";
            modalBackdrop.style.display = "none";
        }

        //Animação do modal
        window.onclick = function(event) {
            if (!event.target.closest(".more-btn, #modalContent, #modal, #modalCOAnimal, img, #modalCOCliente, #modalAviso")) {

                const divTremor = document.getElementById('modal');
                const divTremorCOAnimal = document.getElementById('modalCOAnimal');
                const divTremorCOCliente = document.getElementById('modalCOCliente');

                function startTremor() {
                    divTremor.classList.add('shake');
                    divTremorCOAnimal.classList.add('shake');
                    divTremorCOCliente.classList.add('shake');
                }

                function stopTremor() {
                    divTremor.classList.remove('shake');
                    divTremorCOAnimal.classList.remove('shake');
                    divTremorCOCliente.classList.remove('shake');
                }
                startTremor();
                setTimeout(stopTremor, 500);
            }   
        }

        // Script de confirmação - ANIMAL
        function confirmarAnimal(nomeAnimal, idAnimal){
            abrirModalAnimal()
            document.querySelector('#msgAnimal').textContent = "Deseja remover " + nomeAnimal + "?"
            document.querySelector("#inputIdAnimal").value = idAnimal
        }
        function removerAnimal(){
            var idAnimalForm = document.querySelector("#inputIdAnimal").value
            document.querySelector('.form-animal' + idAnimalForm).submit()
        }

        // Script de confirmação - CLIENTE
        function confirmarCliente(nomeCliente, idCliente){
            abrirModalCliente()
            document.querySelector('#msgCliente').textContent = "Deseja remover " + nomeCliente + "?"
            document.querySelector("#inputIdCliente").value = idCliente 
        }
        function removerCliente(){
            var idClienteForm = document.querySelector("#inputIdCliente").value
            document.querySelector('.form-cliente' + idClienteForm).submit()
        } 


    </script>
</html>


