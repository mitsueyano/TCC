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
                                    <input type="text" name="email">
                                </div>
                            </div>
                            <div class="flex" style="margin-bottom: 20px">
                                <div class="label-form">
                                    <label>Contato:</label>
                                </div>
                                <div class="input-form">
                                <input type="text" name="contato" id="contato"/>
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
                                    <select name="especie" id="especie">                                
                                        <option value="Gato">Gato</option>
                                        <option value="Cachorro">Cachorro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Raça:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" name="raca" id="raca">
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
                            <input type="submit" value="CADASTRAR" class="submit form-btn">
                        </div>

                    </form> 
                </div>
            </div>
    </body>
</html>
<script>
    // Script para preencher valores de endereço pelo CEP automáticamente
    function pesquisarCEP(){
        const cepElemento = document.getElementById("cep");
        const cepValor = cepElemento.value;
        fetch(`https://viacep.com.br/ws/${cepValor}/json/`, {method:'GET'})
        .then(response => response.json())
        .then (endereco =>{
            const Estado = document.getElementById("estado");
            Estado.value = endereco.uf;

            const Cidade = document.getElementById("cidade");
            Cidade.value = endereco.localidade;

            const Bairro = document.getElementById("bairro");
            Bairro.value = endereco.bairro
            
            const Rua = document.getElementById("rua");
            Rua.value = endereco.logradouro;
        })
        .catch(err => console.error(err))   
    }

    // Script para adicionar quantos animais desejar
    let animais = [];
    function addAnimal()
    {
        const nomeAnimal = document.getElementById("nomeAnimal").value;
        const especie = document.getElementById("especie").value;
        const raca = document.getElementById("raca").value;
        const dataNascto = document.getElementById("dataNascto").value;

        // Tratamento de erros
        if (nomeAnimal.trim() === "") {
           document.getElementById("nomeAnimal").placeholder = "Insira o nome do animal";
        }
        if (raca.trim() === "") {
            document.getElementById("raca").placeholder = "Insira a raça do animal";
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
            document.getElementById("raca").value = "";
            document.getElementById("dataNascto").value = "";
        }
    }

    // Função para tratamento de erros onsubmit
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
    const animaisJson = document.getElementById("animaisJson").value;
    if (animaisJson.trim() === "") {
        window.alert("Nenhum animal adicionado.");
        return false;
    }
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
}
</script>
