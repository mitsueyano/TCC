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
            <div class="container">     
                <div class="form-container">
                <label class="titulo">Novo Cadastro</label>
                    <form action="../php/cadastrarCliente.php" method="post">
                        
                        <div class="container-cliente">
                            <div class="flex">
                                <div class="label-form">
                                    <label>Nome do cliente:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" name="nome">
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
                                <input type="text" name="contato"/>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>CEP:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" style="width: 65px" name="cep" id="cep">
                                    <button type="button" onclick="pesquisarCEP()" class="form-btn pesquisar">Pesquisar CEP</button>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Estado:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" id="estado">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Cidade:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" id="cidade">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Bairro:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" id="bairro">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Rua:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" id="rua">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Número:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text" style="width: 30px">
                                </div>
                            </div>
                        </div>
                        <div class="container-animal">
                            <div class="flex">
                                <div class="label-form">
                                    <label>Nome do animal:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Espécie:</label>
                                </div>
                                <div class="input-form">
                                    <select name="" id="">                                
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
                                    <input type="text">
                                </div>
                            </div>
                            <div class="flex">
                                <label>Data de nascimento:</label>
                                <div class="input-form">
                                    <input type="date">
                                </div>
                            </div>
                            <button type="button"class="form-btn pesquisar">Adicionar Animal</button>
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
</script>
