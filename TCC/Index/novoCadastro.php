<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início</title>
        <link rel="stylesheet" href="../Css/novoCadastro.css">
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
                <div class="form-container">
                <label class="titulo">Novo Cadastro</label>   
                    <form action="../php/cadastrarCliente.php" method="post" onsubmit="return confirmarCadastro()">
                        <div class="container-cliente"> 
                            <div class="flex">
                                <div class="label-form">
                                    <!-- Formulário - seção CLIENTE -->
                                    <label>Nome do cliente:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" name="nome" id="nome">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>E-mail:</label>
                                </div>
                                <div class="input-form">
                                    <input type="email" name="email">
                                </div>
                            </div>
                            <div class="flex" style="margin-bottom: 20px">
                                <div class="label-form">
                                    <label>Contato:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" name="contato" id="contato" maxlength="13"/>
                                    <div class="radio-div">
                                        <input type="radio" name="contatoTipo" id="contatoTipoTelefone" checked="true" onchange="atualizarMaxlength()"> <span>Telefone</span>
                                        <input type="radio" name="contatoTipo" id="contatoTipoCelular" onchange="atualizarMaxlength()"> <span>Celular</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>CEP:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" maxlength="9" style="width: 65px" id="cep">
                                    <button type="button" onclick="pesquisarCEP()" class="pesquisar">Pesquisar CEP</button>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Estado:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" id="estado" name="estado">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Cidade:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" id="cidade" name="cidade">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Bairro:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" id="bairro" name="bairro">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Rua:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" id="rua" name="rua">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Número:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" id="numero" name="numero" style="width: 30px">
                                </div>
                            </div>
                        </div>
                        <!-- Formulário - Seção ANIMAL -->
                        <div class="container-animal">
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
                                    <select name="especie" id="especie" onChange="raca()">                                
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
                        <div class="submit-container">  
                            <div class="btnSubmitDiv">
                                <div class="buttonOptions"><button type="submit" class="submit">CADASTRAR</button></div>
                            </div>
                        </div>  

                    </form> 
                </div>
            </div>
    </body>
</html>
<script>


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

    // Script para formatar o número de telefone com parênteses "()"
    const contatoInput = document.getElementById("contato");

    contatoInput.addEventListener("input", function() {
    let valor = contatoInput.value.replace(/\D/g, ''); // Remove todos os não dígitos
    if (valor.length > 0) {
        valor = `(${valor.slice(0, 2)}) ${valor.slice(2)}`;
        }
        contatoInput.value = valor;
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
                Estado.value = "";
                Cidade.value = "";
                Bairro.value = "";
                Rua.value = "";
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
                Estado.readOnly = true;

                const Cidade = document.getElementById("cidade");
                Cidade.value = endereco.localidade;
                Cidade.readOnly = true;

                const Bairro = document.getElementById("bairro");
                Bairro.value = endereco.bairro
                Bairro.readOnly = true;
                
                const Rua = document.getElementById("rua");
                Rua.value = endereco.logradouro;
                Rua.readOnly = true;

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

    // Script para listar raças de acordo com a espécie
    function raca(){
        const especie = document.getElementById("especie").value;
        if (especie == "Gato"){
            document.getElementById("racasCachorro").classList.add("escondido");
            document.getElementById("outraRaca").classList.add("escondido");
            document.getElementById("outraEspecie").classList.add("escondido");
            document.getElementById("racasGato").classList.remove("escondido");
        }
        else if (especie == "Cachorro"){
            document.getElementById("racasGato").classList.add("escondido");
            document.getElementById("outraRaca").classList.add("escondido");
            document.getElementById("outraEspecie").classList.add("escondido");
            document.getElementById("racasCachorro").classList.remove("escondido");
        }
        else if (especie == "Outras"){
            document.getElementById("racasCachorro").classList.add("escondido");
            document.getElementById("racasGato").classList.add("escondido");
            document.getElementById("outraEspecie").classList.remove("escondido");
            document.getElementById("outraRaca").classList.remove("escondido");
        }
    }
    // Script para adicionar quantos animais desejar
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

    // Função para tratamento de erros onsubmit
    function confirmarCadastro() {
        
        var dataInput = document.getElementById('dataConsulta');
        var horaInput = document.querySelector('input[name="horaConsulta"]');
        var dataHora = dataInput.value.trim() + " " + horaInput.value.trim();
        dataInput.value = dataHora;
        
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
        const animaisJson = document.getElementById("animaisJson").value;
        if (animaisJson.trim() === "") {
            window.alert("Nenhum animal adicionado.");
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
