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

                    </div>  
                    <?php
                        include '../php/conectaBD.php';
                        if (isset($_POST["termo_pesquisa"])) {
                            $termo_pesquisa = $_POST["termo_pesquisa"];
                            // Consulta SQL para buscar animais com base no termo de pesquisa
                            $sql = "SELECT animais.nome AS nome_animal, animais.idAnimal AS id_animal, clientes.nome AS nome_dono, clientes.idCliente AS id_dono 
                                    FROM animais
                                    JOIN clientes ON animais.idCliente = clientes.idCliente
                                    WHERE animais.nome LIKE '%$termo_pesquisa%'
                                    OR clientes.nome LIKE '%$termo_pesquisa%'
                                    OR animais.idAnimal = '$termo_pesquisa'
                                    OR clientes.idCliente = '$termo_pesquisa'";
                            $result = $conexao->query($sql);
                            if ($result->num_rows > 0):
                    ?>
                    <div class="table-container">
                        <table>
                            <tr class="table-rows">
                                <th>ID do Animal</th>
                                <th>Nome do Animal</th>
                                <th>Nome do Dono</th>
                                <th>ID do Dono</th> 
                                <th></th>
                                <th></th>
                            </tr>
                            <?php while ($array = $result->fetch_assoc()): ?>
                            <tr class="table-rows">
                                <td><?php echo $array["id_animal"]; ?></td>
                                <td><?php echo $array["nome_animal"]; ?></td>
                                <td><?php echo $array["nome_dono"]; ?></td>
                                <td><?php echo $array["id_dono"]; ?></td>
                                <td class="btnTabelacontainer"> 
                                    <a href="editar.php?id=<?php echo $array["id_dono"]; ?>" class="btn-tabela">
                                        <img src="../img/editar.png" alt="">
                                    </a>
                                </td>
                                <td class="btnTabelaContainer"> 
                                    <a href="editar.php" class="btn-tabela">
                                    <img src="../img/lixo.png" alt="">
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                    <?php
                        else:
                            echo "Nenhum resultado encontrado.";
                        endif;
                        $conexao->close();
                        }
                    ?>
                </div>
            </div>
    </body>
</html>


