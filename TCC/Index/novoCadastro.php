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
                    <form action="../php/cadastrarCliente.php" method="post">
                        
                        <div class="container-cliente">
                            <div class="flex">
                                <div class="label-form">
                                    <label>Nome do cliente:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" name="nome" required= "true">
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
                                <input type="text" name="contato" required= "true"/>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>CEP:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" style="width: 65px" id="cep" required= "true">
                                    <button type="button" onclick="pesquisarCEP()" class="form-btn pesquisar">Pesquisar CEP</button>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Estado:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" id="estado" name="estado" required= "true">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Cidade:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" id="cidade" name="cidade" required= "true">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Bairro:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" id="bairro" name="bairro" required= "true">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Rua:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" id="rua" name="rua" required= "true">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Número:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" name="numero" style="width: 30px" required= "true">
                                </div>
                            </div>
                        </div>
                        <div class="container-animal">
                            <div class="flex">
                                <div class="label-form">
                                    <label>Nome do animal:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" name="nomeAnimal" id="nomeAnimal" required= "true">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Espécie:</label>
                                </div>
                                <div class="input-form">
                                    <select name="especie" id="especie">                                
                                        <option value="">Gato</option>
                                        <option value="">Cachorro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Raça:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" name="raca" id="raca" required= "true">
                                </div>
                            </div>
                            <div class="flex">
                                <label>Data de nascimento:</label>
                                <div class="input-form">
                                    <input type="date" name="dataNascto" id="dataNascto" required= "true">
                                </div>
                            </div>
                            <button type="button"class="form-btn pesquisar" onclick="addAnimal()">Adicionar Animal</button>
                        </div>
                        <div class="submit-container">
                            <input type="submit" value="CADASTRAR" class="submit form-btn">
                        </div>
                    </form>
                    <div class="containerAnimaisCad" id="containerAnimaisCad"><span class="titulo-AnimaisCad">Animais Cadastrados: </span></div>
                </div>
        
            </div>
    </body>
</html>
<script>
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

    let animais = [];
    
    function addAnimal()
    {
        
        const nomeAnimal = document.getElementById("nomeAnimal").value;
        const especie = document.getElementById("especie").value;
        const raca = document.getElementById("raca").value;
        const dataNascto = document.getElementById("dataNascto").value;

        animais.push([nomeAnimal, especie, raca, dataNascto]);
        
        var div = document.createElement('div');

        div.style.display = "flex";
        div.style.flexDirection = "column";

        var container = document.getElementById('containerAnimaisCad');

        div.innerHTML = `
            <span>${nomeAnimal}</span>
        `;
        container.appendChild(div);

}


</script>
