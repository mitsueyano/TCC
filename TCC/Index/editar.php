<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
    <link rel="stylesheet" href="../Css/editar.css">
</head>
<body>
    <div class="border-page"></div>
    <div class="page">
        <div class="logo">
                <img src="../img/CA.png" alt="logo">
            </div>
        <div class="bar">
            <div class="button"><a href="./cadastro.php">VOLTAR</a></div>
        </div>
        <div class="container" id="container">  
                <div class="separa-form">
                    <!-- Script para os valores pré estabelecidos -->
                    <?php
                        include '../php/conectaBD.php';
                        $clienteId = $_POST['idCliente'];  
                        $queryClientes = "SELECT * FROM Clientes WHERE idCliente = " . $clienteId;
                        $resultadoClientes = mysqli_query($conexao, $queryClientes);
                        if ($resultadoClientes) {
                            while ($row = $resultadoClientes->fetch_assoc()) {
                                $idCliente = $row['idCliente'];
                                $nomeCliente = $row['nome'];
                                $email = $row['email'];
                                $contato = $row['contato'];
                                $estado = $row['enderecoE'];
                                $cidade = $row['enderecoC'];
                                $bairro = $row['enderecoB'];
                                $enderecoRN = $row['enderecoRN'];
                                $separarRN = explode(", ", $enderecoRN);
                                $rua = $separarRN[0];
                                $numero = $separarRN[1];
                            }
                        } else {
                            echo "Erro na consulta: " . $conexao->error;
                        }
                    ?>
                    <form action="../php/atualizarBD.php" method="post" id="formCliente" class="formTotal" onsubmit="return confirmarCadastro()">
                        <input type="hidden" name="idCliente" value="<?php echo $idCliente; ?>">
                        <div class="form-containerCliente">
                            <span class="form-title">CLIENTE</span>
                            <div class="container-cliente"> 
                                <div class="flex">
                                    <div class="label-form">
                                        <!-- Formulário - seção CLIENTE -->
                                        <label>Nome do cliente:</label>
                                    </div>
                                    <div class="input-form">
                                        <input type="text" name="nome" id="nome" value="<?php echo $nomeCliente?>">
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="label-form">
                                        <label>E-mail:</label>
                                    </div>
                                    <div class="input-form">
                                        <input type="text" name="email" value="<?php echo $email?>">
                                    </div>
                                </div>
                                <div class="flex" style="margin-bottom: 20px">
                                    <div class="label-form">
                                        <label>Contato:</label>
                                    </div>
                                    <div class="input-form">
                                    <input type="text" name="contato" id="contato" value="<?php echo $contato   ?>"/>
                                    <div class="radio-div">
                                        <input type="radio" name="contatoTipo" id="contatoTipoTelefone"  onchange="atualizarMaxlength()"> <span>Telefone</span>
                                        <input type="radio" name="contatoTipo" id="contatoTipoCelular" onchange="atualizarMaxlength()"> <span>Celular</span>
                                    </div>
                                </div>
                                </div>
                                <div class="flex">
                                    <div class="label-form">
                                        <label>CEP:</label>
                                    </div>
                                    <div class="input-form">
                                        <input type="text" style="width: 65px" id="cep" maxlength="9">
                                        <button type="button" onclick="pesquisarCEP()" class="pesquisar">Pesquisar CEP</button>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="label-form">
                                        <label>Estado:</label>
                                    </div>
                                    <div class="input-form">
                                        <input type="text" id="estado" name="estado" value="<?php echo $estado?>">
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="label-form">
                                        <label>Cidade:</label>
                                    </div>
                                    <div class="input-form">
                                        <input type="text" id="cidade" name="cidade" value="<?php echo $cidade?>">
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="label-form">
                                        <label>Bairro:</label>
                                    </div>
                                    <div class="input-form">
                                        <input type="text" id="bairro" name="bairro" value="<?php echo $bairro?>">
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="label-form">
                                        <label>Rua:</label>
                                    </div>
                                    <div class="input-form">
                                        <input type="text" id="rua" name="rua" value="<?php echo $rua?>">
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="label-form">
                                        <label>Número:</label>
                                    </div>
                                    <div class="input-form">
                                        <input type="text" id="numero" name="numero" style="width: 30px" value="<?php echo $numero?>">
                                    </div>
                                </div>
                            </div>
                            <div class="imprimir-container">  
                                <div class="btnSubmitDiv">
                                    <div class="buttonOptions"><a href="./imprimirQRCode.php?idCliente=<?php echo $clienteId?>">QRCODE</a></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-containerAnimais">  
                            <span class="form-title animais-title">ANIMAIS</span>
                            <div class="lista-animais">           
                                <?php
                                    $queryAnimais = "SELECT * FROM Animais WHERE idCliente = " . $clienteId;
                                    $resultadoAnimais = mysqli_query($conexao, $queryAnimais);
                                    if ($resultadoAnimais) {
                                        while ($row = $resultadoAnimais->fetch_assoc()):
                                            $idAnimal = $row['idAnimal'];
                                            $nome = $row['nome'];
                                            $dataNascto = $row['datanascto'];
                                            $especie = $row['especie'];
                                            $raca = $row['raca'];
                                ?>      
                                <!-- Formulário - Seção ANIMAL -->
                                <div class="container-animal">
                                    <div class="flex">
                                        <div class="label-form">
                                            <label>Nome do animal:</label>
                                        </div>
                                        <div class="input-form">
                                            <input type="text" name="nomeAnimal_<?php echo $idAnimal?>" id="nomeAnimal_<?php echo $idAnimal?>" value="<?php echo $nome?>">
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="label-form">
                                            <label>Espécie:</label>
                                        </div>
                                        <div class="input-form">
                                            <input type="text" name="outraEspecie_<?php echo $idAnimal?>" id="outraEspecie_<?php echo $idAnimal?>" class="escondido">
                                            <select name="especie_<?php echo $idAnimal?>" id="especie_<?php echo $idAnimal?>" onChange="atualizarRaca(<?php echo $idAnimal; ?>)" >                  
                                                <option value="Gato" <?php if ($especie == 'Gato') echo 'selected="selected"'; ?>>Gato</option>
                                                <option value="Cachorro" <?php if ($especie == 'Cachorro') echo 'selected="selected"'; ?>>Cachorro</option>
                                                <option value="Outras" <?php if ($especie !== 'Gato' && $especie !== 'Cachorro') echo 'selected="selected"'; ?>>Outras</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex">
                                    <div class="label-form">
                                        <label>Raça:</label>
                                    </div>
                                    <div class="input-form">
                                        <!-- Script raças de gatos -->
                                        <select name="racasGato_<?php echo $idAnimal?>" id="racasGato_<?php echo $idAnimal?>">
                                        <?php
                                            $json = file_get_contents('../racasGatos.json');

                                            $json_data = json_decode($json,true);
                                            foreach ($json_data as $racaGato):
                                        ?>
                                        <option value="<?php echo $racaGato?>" <?php if ($especie == 'Gato' && $raca == $racaGato) echo 'selected="selected"'; ?>><?php echo $racaGato?> </option>                                   
                                        <?php
                                            endforeach;
                                        ?>
                                        </select>
                                        <!-- Script raças de cachorros -->
                                        <select name="racasCachorro_<?php echo $idAnimal?>" id="racasCachorro_<?php echo $idAnimal?>" class="escondido">
                                            <?php
                                                $json = file_get_contents('../racasCachorros.json');

                                                $json_data = json_decode($json,true);
                                                foreach ($json_data as $racaCachorro):
                                            ?>
                                            <option value="<?php echo $racaCachorro?>" <?php if ($especie == 'Cachorro' && $raca == $racaCachorro) echo 'selected="selected"'; ?>><?php echo $racaCachorro?> </option>                                    
                                            <?php
                                                endforeach;
                                            ?>
                                        </select>
                                        <!-- Outras raças -->
                                        <input type="text" name="outraRaca_<?php echo $idAnimal; ?>" id="outraRaca_<?php echo $idAnimal; ?>" class="escondido" value="<?php if ($especie !== 'Gato' && $especie !== 'Cachorro') echo $raca; ?>">
                                    </div>
                                    </div>
                                    <div class="flex">
                                        <label>Data de nascimento:</label>
                                        <div class="input-form">
                                            <input type="date" name="dataNascto_<?php echo $idAnimal?>" id="dataNascto_<?php echo $idAnimal?>" value="<?php echo $dataNascto?>">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    endwhile;
                                    } else {
                                        echo "Erro na consulta: " . $conexao->error;
                                    }
                                ?>     
                                <!-- Seção para adicionar novo animal-->
                            </div>
                            <div class="center">
                                <div class="addButton">
                                    <div class="btnAddButtonDiv">
                                        <div class="buttonAdd"><button type="button" onclick="novoAnimal()">+</button></div>
                                    </div>
                                </div>
                            </div>
                            <div id="container-NovoAnimal" class="escondido  container-NovoAnimal">
                            <div class="flex">
                                <div class="label-form">
                                    <label>Nome do animal:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" name="nomeAnimal" id="nomeAnimal">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Espécie:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" id="outraEspecie" class="escondido">
                                    <select name="especie" id="especie" onChange="atualizarRacaNovoAnimal()">                                
                                        <option value="Gato">Gato</option>
                                        <option value="Cachorro">Cachorro</option>
                                        <option value="Outras">Outras</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Raça:</label>
                                </div>
                                <div class="input-form">
                                    <!-- Script raças de gatos -->
                                    <select name="" id="racasGato" >
                                        <?php
                                            $json = file_get_contents('../racasGatos.json');
        
                                            $json_data = json_decode($json,true);
                                            foreach ($json_data as $raca):
                                        ?>
                                        <option value="<?php echo $raca?>"><?php echo $raca?> </option>                                   
                                        <?php
                                            endforeach;
                                        ?>
                                    </select>
                                    <!-- Script raças de cachorros -->
                                    <select name="" id="racasCachorro" class="escondido">
                                        <?php
                                            $json = file_get_contents('../racasCachorros.json');
        
                                            $json_data = json_decode($json,true);
                                            foreach ($json_data as $raca):
                                        ?>
                                        <option value="<?php echo $raca?>"><?php echo $raca?> </option>                                    
                                        <?php
                                            endforeach;
                                        ?>
                                    </select>
                                    <!-- Outras raças -->
                                    <input type="text" id="outraRaca" class="escondido">
                                </div>
                            </div>
                            <div class="flex">
                                <label>Data de nascimento:</label>
                                <div class="input-form">
                                    <input type="date" name="dataNascto" id="dataNascto">
                                </div>
                            </div>
                            <div class="center">
                              <button type="button"class="form-btn" onclick="addAnimal()">Adicionar Animal</button>
                            </div>
                            <!-- Container de animas já adicionados -->
                            <div class="containerAnimaisCad" id="containerAnimaisCad"><span class="titulo-AnimaisCad">Animais adiconados:&nbsp</span></div>  
                            <input type="hidden" name="animaisJson" id="animaisJson" value=""> <!-- Cria um elemento invisível para ser enviado junto com o formulário -->
                        </div>
                        </div>    
                           
                    </form>
                    <div class="submit-container">  
                        <div class="btnSubmitDiv">
                            <div class="buttonOptions"><button type="submit" form="formCliente">SALVAR ALTERAÇÕES</button></div>
                        </div>
                    </div>
                </div>  
            </div>  
        </div>
    </div>
</body>
</html>

<script> 
    // Script para formatar o número de telefone com parênteses "()"
    const contatoInput = document.getElementById("contato");

    contatoInput.addEventListener("input", function() {
    let valor = contatoInput.value.replace(/\D/g, ''); // Remove todos os não dígitos
    if (valor.length > 0) {
        valor = `(${valor.slice(0, 2)}) ${valor.slice(2)}`;
        }
        contatoInput.value = valor;
    });

    // Script para desabilitar os campos de entrada ao carregar a página
    document.addEventListener("DOMContentLoaded", function() {
        const Estado = document.getElementById("estado");
        const Cidade = document.getElementById("cidade");
        const Bairro = document.getElementById("bairro");
        const Rua = document.getElementById("rua");
        
        if (Estado.value.trim() !== "") {
        Estado.readOnly = true;
        }
        if (cidade.value.trim() !== "") {
        Cidade.readOnly = true;
        }
        if (Bairro.value.trim() !== "") {
        Bairro.readOnly = true;
        }
        if (Rua.value.trim() !== "") {
        Rua.readOnly = true;
        }

        const contatoInput = document.getElementById("contato");
        const tipoCelular = document.getElementById("contatoTipoCelular");
        const tipoTelefone = document.getElementById("contatoTipoTelefone");

        if (contatoInput.value.length === 13) {
            tipoTelefone.checked = true;
        } else {
            tipoCelular.checked = true;
        }

        // Script para auto completar os dados dos animais
        <?php
        $queryAnimais = "SELECT * FROM Animais WHERE idCliente = " . $clienteId;
        $resultadoAnimais = mysqli_query($conexao, $queryAnimais);
        while ($row = $resultadoAnimais->fetch_assoc()):
            $idAnimal = $row['idAnimal'];
            $nome = $row['nome'];
            $dataNascto = $row['datanascto'];
        ?>
        
        <?php
        $queryEspecie = "SELECT especie FROM Animais WHERE idAnimal = " . $idAnimal;
        $resultadoEspecie = mysqli_query($conexao, $queryEspecie);
            while ($row = $resultadoEspecie->fetch_assoc()){
                $especie = $row['especie'];
            }  
        $queryRaca = "SELECT raca FROM Animais WHERE idAnimal = " . $idAnimal;
        $resultadoRaca = mysqli_query($conexao, $queryRaca);
            while ($row = $resultadoRaca->fetch_assoc()){
                $raca = $row['raca'];
            }      
        ?>

        var animalCorrespondente = document.getElementById("especie_<?php echo $idAnimal?>");

        if ("<?php echo $especie?>" == "Cachorro"){
            animalCorrespondente.value = "<?php echo $especie?>";
            document.getElementById("racasCachorro_<?php echo $idAnimal; ?>").value = "<?php echo $raca?>";
            document.getElementById("racasGato_<?php echo $idAnimal; ?>").classList.add("escondido");
            document.getElementById("outraRaca_<?php echo $idAnimal; ?>").classList.add("escondido");
            document.getElementById("outraEspecie_<?php echo $idAnimal; ?>").classList.add("escondido");
            document.getElementById("racasCachorro_<?php echo $idAnimal; ?>").classList.remove("escondido");

        }
        else if ("<?php echo $especie?>" == "Gato"){
            animalCorrespondente.value = "<?php echo $especie?>";
            document.getElementById("racasGato_<?php echo $idAnimal; ?>").value = "<?php echo $raca?>";
            document.getElementById("racasCachorro_<?php echo $idAnimal; ?>").classList.add("escondido");
            document.getElementById("outraRaca_<?php echo $idAnimal; ?>").classList.add("escondido");
            document.getElementById("outraEspecie_<?php echo $idAnimal; ?>").classList.add("escondido");
            document.getElementById("racasGato_<?php echo $idAnimal; ?>").classList.remove("escondido");
        }
        else {
            animalCorrespondente.value == "Outras";
            document.getElementById("outraRaca_<?php echo $idAnimal; ?>").value = "<?php echo $raca?>";
            document.getElementById("outraEspecie_<?php echo $idAnimal; ?>").value = "<?php echo $especie?>"
            document.getElementById("racasCachorro_<?php echo $idAnimal; ?>").classList.add("escondido");
            document.getElementById("racasGato_<?php echo $idAnimal; ?>").classList.add("escondido");
            document.getElementById("outraEspecie_<?php echo $idAnimal; ?>").classList.remove("escondido");
            document.getElementById("outraRaca_<?php echo $idAnimal; ?>").classList.remove("escondido");
        }
        <?php 
            endwhile;
        ?>

    });

    // Script para adicionar "-" no CEP
    const cepInput = document.getElementById("cep");
    const antes = 5;

    cepInput.addEventListener("input", function() {
        const stringSemTraco = cepInput.value.replace(/-/g, "");

        let antesDoTraco = stringSemTraco.slice(0, antes);
        let depoisDoTraco = stringSemTraco.slice(antes);

        if (antesDoTraco && depoisDoTraco) {
            cepInput.value = antesDoTraco + "-" + depoisDoTraco;
        } else {
            cepInput.value = stringSemTraco;
        }
    });

    // Script para preencher valores de endereço pelo CEP automaticamente
    function pesquisarCEP(){
        const cepElemento = document.getElementById("cep");
        const cepValor = cepElemento.value;
        fetch(`https://viacep.com.br/ws/${cepValor}/json/`, {method:'GET'})
        .then(response => response.json())
        .then (endereco =>{
            if (endereco.erro == true){
                document.getElementById("cep").value = "";
                throw error('erro');
            }
            if (endereco.bairro == "" && endereco.logradouro == ""){
                const Estado = document.getElementById("estado");
                Estado.value = endereco.uf;
                Estado.readOnly = true;

                const Cidade = document.getElementById("cidade");
                Cidade.value = endereco.localidade;
                Cidade.readOnly = true;

                const Bairro = document.getElementById("bairro");
                Bairro.value = "";
                Bairro.readOnly = false;
                
                const Rua = document.getElementById("rua");
                Rua.value = "";
                Rua.readOnly = false;
            }
            else{
                const Estado = document.getElementById("estado");
                Estado.value = endereco.uf;

                const Cidade = document.getElementById("cidade");
                Cidade.value = endereco.localidade;

                const Bairro = document.getElementById("bairro");
                Bairro.value = endereco.bairro
                
                const Rua = document.getElementById("rua");
                Rua.value = endereco.logradouro;
            }   

        })
        .catch(err =>{
            window.alert("CEP inválido");
            document.getElementById("cep").value = "";
            const Estado = document.getElementById("estado");
            Estado.value = "";
            Estado.readOnly = false;

            const Cidade = document.getElementById("cidade");
            Cidade.value = "";
            Cidade.readOnly = false;

            const Bairro = document.getElementById("bairro");
            Bairro.value = "";
            Bairro.readOnly = false;
            
            const Rua = document.getElementById("rua");
            Rua.value = "";
            Rua.readOnly = false;

        })
    }

    function atualizarMaxlength(){
        var tipoCelular = document.getElementById("contatoTipoCelular");
        var tipoTelefone = document.getElementById("contatoTipoTelefone");
        var contatoInput = document.getElementById("contato");

        if (tipoCelular.checked) {
                contatoInput.setAttribute("maxlength", "14");
        } else if (tipoTelefone.checked) {
            let valor = contatoInput.value;
            if (valor.length > 13) {
                valor = valor.slice(0, -1); // Remove o último caractere caso seja maior que 13
            }
            contatoInput.setAttribute("maxlength", "13");

            contatoInput.value = valor;
        } else {
            contatoInput.removeAttribute("maxlength");
        } 

    }

     // Script para listar raças de acordo com a espécie
    function atualizarRaca(idAnimal) {
        var especieElemento = document.getElementById(`especie_${idAnimal}`);
        var racasGatoElemento = document.getElementById(`racasGato_${idAnimal}`);
        var racasCachorroElemento = document.getElementById(`racasCachorro_${idAnimal}`);
        var outraRacaElemento = document.getElementById(`outraRaca_${idAnimal}`);
        var outraEspecieElemento = document.getElementById(`outraEspecie_${idAnimal}`)

        if (especieElemento.value == "Gato") {
            racasGatoElemento.classList.remove("escondido");
            racasCachorroElemento.classList.add("escondido");
            outraRacaElemento.classList.add("escondido");
            outraEspecieElemento.classList.add("escondido");
        } else if (especieElemento.value == "Cachorro") {
            racasGatoElemento.classList.add("escondido");
            racasCachorroElemento.classList.remove("escondido");
            outraRacaElemento.classList.add("escondido");
            outraEspecieElemento.classList.add("escondido");
        } else {
            racasGatoElemento.classList.add("escondido");
            racasCachorroElemento.classList.add("escondido");
            outraRacaElemento.classList.remove("escondido");
            outraEspecieElemento.classList.remove("escondido");

        }
    }

    // Script para botão "+" - novo animal
    function novoAnimal(){
        caixaNovoAnimal = document.getElementById("container-NovoAnimal");
        caixaNovoAnimal.classList.remove("escondido");
    }

    // Listar raça de acordo com a espécie - novo animal
    function atualizarRacaNovoAnimal() {
        var especieElemento = document.getElementById(`especie`);
        var racasGatoElemento = document.getElementById(`racasGato`);
        var racasCachorroElemento = document.getElementById(`racasCachorro`);
        var outraRacaElemento = document.getElementById(`outraRaca`);
        var outraEspecieElemento = document.getElementById(`outraEspecie`)

        if (especieElemento.value == "Gato") {
            racasGatoElemento.classList.remove("escondido");
            racasCachorroElemento.classList.add("escondido");
            outraRacaElemento.classList.add("escondido");
        } else if (especieElemento.value == "Cachorro") {
            racasGatoElemento.classList.add("escondido");
            racasCachorroElemento.classList.remove("escondido");
            outraRacaElemento.classList.add("escondido");
        } else {
            racasGatoElemento.classList.add("escondido");
            racasCachorroElemento.classList.add("escondido");
            outraRacaElemento.classList.remove("escondido");
            outraEspecieElemento.classList.remove("escondido");

        }
    }

    // Script para adicionar novo animal
    let animais = [];
    function addAnimal()
    {
        const nomeAnimal = document.getElementById("nomeAnimal").value;
        const dataNascto = document.getElementById("dataNascto").value;

        var especie = document.getElementById("especie").value;
        if (especie == "Outras") {
            especie = document.getElementById("outraEspecie").value;
            var raca = document.getElementById("outraRaca").value;
        } else {
            var raca = document.getElementById("racas" + especie).value;
        }

        // Tratamento de erros
        if (especie != "Gato" && especie != "Cachorro"){
            if(especie.trim() === ""){
                document.getElementById("outraEspecie").placeholder = "Insira a espécie do animal";
            }
            if(raca.trim() === ""){
                document.getElementById("outraRaca").placeholder = "Insira a raça do animal";
            }
        }
        if (nomeAnimal.trim() === "") {
           document.getElementById("nomeAnimal").placeholder = "Insira o nome do animal";
        }

        // Script addAnimal
        else{
            animais.push([nomeAnimal, especie, raca, dataNascto]); //Cria o array dentro do array "animais" (matriz)
            document.getElementById("animaisJson").value = JSON.stringify(animais); //Converte o objeto JavaScript em uma string JSON
            
            // Adiciona o nome do animal no containerAnimaisCad
            var div = document.createElement('div');
            div.style.display = "flex";
            div.style.flexDirection = "column";
            var container = document.getElementById('containerAnimaisCad');
            div.innerHTML = `<span>${nomeAnimal}, &nbsp</span>`;
            container.appendChild(div);
            
            // Limpa input ao adicionar o animal
            document.getElementById("nomeAnimal").value = "";
            document.getElementById("dataNascto").value = "";
            
        }
        
    }

    // Tratamento de erros onsubmit do formulário
    function confirmarCadastro() {
        
        const nomeCliente = document.getElementById("nome").value;
        const contato = document.getElementById("contato").value;
        const estado = document.getElementById("estado").value;
        const cidade = document.getElementById("cidade").value;
        const bairro = document.getElementById("bairro").value;
        const rua = document.getElementById("rua").value;
        const numero = document.getElementById("numero").value;

        let verificar = false;
        if (nomeCliente.trim() === "") {
            document.getElementById("nome").placeholder = "Campo obrigatório.";
            verificar = true;
        }
        if (contato.trim() === "") {
            document.getElementById("contato").placeholder = "Campo obrigatório.";
            verificar = true;
        }
        if (estado.trim() === "") {
            document.getElementById("estado").placeholder = "Campo obrigatório.";
            verificar = true;
        }
        if (cidade.trim() === "") {
            document.getElementById("cidade").placeholder = "Campo obrigatório.";
            verificar = true;
        }
        if (bairro.trim() === "") {
            document.getElementById("bairro").placeholder = "Campo obrigatório.";
            verificar = true;
        }
        if (rua.trim() === "") {
            document.getElementById("rua").placeholder = "Campo obrigatório.";
            verificar = true;
        }
        if (numero.trim() === "") {
            document.getElementById("numero").placeholder = "Campo obrigatório.";
            document.getElementById("numero").style.width = "110px"
            verificar = true;
        }
        if (verificar) {
            window.alert("Dados incompletos.");
            return false;
        }
        var contatoTipo = document.getElementById("contatoTipo");
        if (document.getElementById("contatoTipoTelefone").checked){  
            if(contato.length != 13){
            window.alert("Número de contato inválido");
            return false;
        }}
        if (document.getElementById("contatoTipoCelular").checked){  
            if(contato.length != 14){
            window.alert("Número de contato inválido");
            return false;
        }}

        const nomeAnimal = document.getElementById("nomeAnimal").value;
        if (nomeAnimal.trim() !== "") {
            const confirmacao = confirm(nomeAnimal.toUpperCase() + " não será cadastrado pois não foi adicionado. Deseja continuar?");
            if (confirmacao) {
                const especie = document.getElementById("especie").value;
                const raca = document.getElementById("raca").value;
                const dataNascto = document.getElementById("dataNascto").value;

                const novoAnimal = [nomeAnimal, especie, raca, dataNascto];
                animais.push(novoAnimal); // Adiciona o animal à matriz

                document.getElementById("animaisJson").value = JSON.stringify(animais); // Converte o objeto JavaScript em uma string JSON
                return true;
            } else {
                return false;
            }
        }
        return true; // Envia o formulário se os campos estiverem vazios
        estado.readOnly = false;
        cidade.readOnly = false;
        bairro.readOnly = false;
        rua.readOnly = false;
    }
</script>