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
            <div class="bar">
                <div class="button"><a href="./cadastro.php">VOLTAR</a></div>
            </div>
            <div class="container" id="container">  
                <div class="separa-form">
                    <!-- Script para os valores pré estabelecidos -->
                    <?php
                        include '../php/conectaBD.php';
                        $clienteId = $_GET['id'];
                        $queryClientes = "SELECT * FROM Clientes WHERE idCliente = " . $clienteId;
                        $resultadoClientes = mysqli_query($conexao, $queryClientes);
                        if ($resultadoClientes) {
                            while ($row = $resultadoClientes->fetch_assoc()) {
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
                    <div class="form-container">
                        <span>CLIENTE</span>
                        <form action="../php/cadastrarCliente.php" method="post" onsubmit="return confirmarCadastro()">
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
                                        <input type="text" style="width: 65px" id="cep">
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
                        </form>
                    </div> 
                    <div class="form-container">  
                        <span>ANIMAIS</span>
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
                                    <form>
                                        <div class="container-animal">
                                            <div class="flex">
                                                <div class="label-form">
                                                    <label>Nome do animal:</label>
                                                </div>
                                                <div class="input-form">
                                                    <input type="text" name="nomeAnimal" id="nomeAnimal" value="<?php echo $nome?>">
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="label-form">
                                                    <label>Espécie:</label>
                                                </div>
                                                <div class="input-form">
                                                    <input type="text" id="outraEspecie_<?php echo $idAnimal?>" class="escondido">
                                                    <select name="especie" id="especie_<?php echo $idAnimal?>" onChange="atualizarRaca(<?php echo $idAnimal; ?>)" >                  
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
                                                <select name="racasGato" id="racasGato_<?php echo $idAnimal?>">
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
                                                <select name="" id="racasCachorro_<?php echo $idAnimal?>" class="escondido">
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
                                                <input type="text" id="outraRaca_<?php echo $idAnimal; ?>" class="escondido">
                                            </div>
                                            </div>
                                            <div class="flex">
                                                <label>Data de nascimento:</label>
                                                <div class="input-form">
                                                    <input type="date" name="dataNascto" id="dataNascto" value="<?php echo $dataNascto?>">
                                                </div>
                                            </div>
                                        </div>
                                    </form> 
                                <?php
                                    endwhile;
                                    } else {
                                        echo "Erro na consulta: " . $conexao->error;
                                    }
                                ?>     
                            </div>   
                        </div>     
                    </div>       
                </div>
                <div class="options-container">  
                    <div class="btnOptionsDiv">
                        <div class="buttonOptions"><a href="./novoCadastro.php">SALVAR ALTERAÇÕES</a></div>
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
            animalCorrespondente.value = "Outras";
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

</script>
