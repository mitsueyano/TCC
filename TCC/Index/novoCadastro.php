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
                <div class="button"><a href="./Inicio.php">INÍCIO</a></div>
                <div class="button"><a href="./Agenda.php">AGENDA</a></div>
                <div class="button"><a href="./cadastro.php">CADASTRO</a></div>
            </div>
            <div class="container">     
                <div class="form-container">
                    <label class="titulo">Novo Cadastro</label>
                    <form action="" method="post" class="form-cadastro">
                        <div class="container-cliente">
                            <div class="flex">
                                <div class="label-form">
                                    <label>Nome do cliente:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>E-mail:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Contato:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="label-form">
                                    <label>Endereço:</label>
                                </div>
                                <div class="input-form">
                                    <input type="text">
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
                        </div>
                    </form>
                </div>
            </div>
    </body>
</html>