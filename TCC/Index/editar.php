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
                        include 'conectaBD.php';
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
                                    <input type="text" name="contato" id="contato" value="<?php echo $contato?>"/>
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
                                    $queryAnimais = "Select * from Animais where idCliente = " . $clienteId;
                                    $resultadoAnimais = mysqli_query($conexao, $queryAnimais);
                                    if ($resultadoAnimais) {
                                        while ($row = $resultadoAnimais->fetch_assoc()):
                                            $nome = $row['nome'];
                                            $raca = $row['raca'];
                                            $especie = $row['especie'];
                                            $dataNascto = $row['datanascto'];
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
                                                    <select name="especie" id="especie">                                
                                                        <option value="Gato" <?php if ($especie === 'Gato') echo "selected"; ?>>Gato</option>
                                                        <option value="Cachorro" <?php if ($especie === 'Cão') echo "selected"; ?>>Cão</option>
                                                        <option value="Cachorro" <?php if ($especie === 'Pássaro') echo "selected"; ?>>Pássaro</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="label-form">
                                                    <label>Raça:</label>
                                                </div>
                                                <div class="input-form">
                                                    <input type="text" name="raca" id="raca" value="<?php echo $raca?>">
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