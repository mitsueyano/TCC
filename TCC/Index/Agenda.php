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

                    <?php
include '../php/conectaBD.php';

if (isset($_POST["termo_pesquisa"])) {
    $termo_pesquisa = $_POST["termo_pesquisa"];

    // Consulta SQL para buscar animais com base no termo de pesquisa
    $sql = "SELECT Agenda.idConsulta, Agenda.dataConsulta, Agenda.horaConsulta, Agenda.veterinario, Agenda.descricao, Agenda.idAnimal FROM Agenda
            WHERE agenda.idConsulta = '$termo_pesquisa'";

    $result = $conexao->query($sql);

    if ($result->num_rows > 0):
?>
    <div class="table-container">
        <table>
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
            <?php while ($array = $result->fetch_assoc()): ?>
                <tr class="table-rows">
                    <td><?php echo $array["idConsulta"]; ?></td>
                    <td><?php echo $array["dataConsulta"]; ?></td>
                    <td><?php echo $array["horaConsulta"]; ?></td>
                    <td><?php echo $array["veterinario"]; ?></td>
                    <td><?php echo $array["descricao"]; ?></td>
                    <td><?php echo $array["idAnimal"]; ?></td>
                    <td class="btnTabelacontainer">
                    <a href="editar.php" class="btn-tabela">
                        <img src="../img/lixo.png" alt="">
                    </a>
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
}
?>

                </div>
            </div>
    </body>
</html>


