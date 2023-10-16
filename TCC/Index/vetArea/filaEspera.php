<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início</title>
        <link rel="stylesheet" href="../../css/vetArea/filaEspera.css">
    </head>
    <body>
        <div class="border-page"></div>
        <div class="page">
            <div class="bar">
                <div class="button"><a href="./InicioVet.php">INÍCIO</a></div>
                <div class="button selected"><a href="./cadastro.php">FILA DE ESPERA</a></div>
            </div>
            <div class="container">     

            <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Veterinário</th>
                                <th scope="col">Animal</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php         
                                include '../../php/conectaBD.php';
                                $queryAgenda = "SELECT Agenda.*, Usuarios.nome, Animais.nome, statusConsulta.statusConsulta, Animais.idCliente
                                                FROM Animais
                                                INNER JOIN Agenda ON Animais.idAnimal = Agenda.idAnimal
                                                INNER JOIN Usuarios ON Agenda.veterinario = Usuarios.idUsuario
                                                INNER JOIN statusConsulta ON Agenda.idStatus = statusConsulta.idStatus
                                                GROUP BY Agenda.dataConsulta, Agenda.horaConsulta;";
                                $resultAgenda = mysqli_query($conexao, $queryAgenda);        
                                if ($resultAgenda->num_rows>0):
                                    while($arrayAgenda = mysqli_fetch_row($resultAgenda) ):
                                       
                            ?>
                            <tr class="table-rows" id="<?php echo $arrayAgenda[0];?>" onmouseenter="mostrarInfo(this.id)">
                            <input type="hidden" value="<?php echo $arrayAgenda[10];?>" name="idCliente" id="idCliente">
                                <td><?php echo $arrayAgenda[0];?></td>
                                <td><?php echo $arrayAgenda[2];?></td>
                                <td><?php echo $arrayAgenda[7];?></td>
                                <td><?php echo $arrayAgenda[8];?></td>
                                <td><?php echo $arrayAgenda[4];?></td>
                                <td><?php echo $arrayAgenda[9];?></td>
                                <td class="more-list-container"> 
                                    <div class="list-box">
                                        <button class="more-btn">ALGUMA COISA</button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                endwhile;
                                else:
                            ?>
                            <div class="center">
                                <span> Nenhuma entrada cadastrada.</span>
                            </div>
                            <?php 
                                endif;
                                mysqli_free_result($resultAgenda);
                            ?>
                        </tbody>
                    </table>     
                </div>

            </div>
    </body>
</html>