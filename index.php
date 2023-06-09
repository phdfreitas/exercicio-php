<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio Kidopi</title>

    <link rel="stylesheet" href="css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div id="principal">
        <div>
            <div id="principalPrimeiraDiv">
                <div id='principalPrimeiraDiv1'>
                    <h1>Covid-19</h1>
                    <h3>
                        Verifique as informações sobre a pandemia de Covid-19 em países ao redor do mundo.
                    </h3>
                </div>
            </div>
        </div>
        <div id="principalSegundaDiv">
            <div id="imagens">
                <img id="imgCovid1" src="https://unidos.fiocruz.br/assets/images/about/about-img.png" alt="covid">
            </div>
        </div>
    </div>

    <div class="container" id="clear">
        
        <div id="interacao">
            <div id="tituloInteracao">
                <h1>
                    Obtenha informações sobre o Covid 19
                </h1>
            </div>

            <div class="formulario" id="formBrCaAus">
                <p>Selecione um dos países para verificar os dados.</p>
                <form id="form1">
                    <label for="pais">
                        <input type="radio" name="pais" id="brasil" class="pais-info1" value="Brazil">
                        Brasil
                    </label>

                    <label for="">
                        <input type="radio" name="pais" id="canada" value="Canada">
                        Canadá
                    </label>

                    <label for="">
                        <input type="radio" name="pais" id="australia" value="Australia">
                        Austrália
                    </label>

                    <div class="button">
                        <button class="btn btn-primary"> Obter Dados</button>
                    </div>
                </form>
            </div>
            
            <div id="divInformacoes">
                <h1 class="titulo" id="informacao">
                    Informações sobre <span id="paisInformacao"></span>
                </h1>
                <table class="table table-striped" id="dadosCovid">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Confirmados</th>
                            <th scope="col">Número de Mortes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            if (isset($_GET['pais'])):
                                $hg = file_get_contents("https://dev.kidopilabs.com.br/exercicio/covid.php?pais=".$_GET['pais']);
                                $json = json_decode($hg);
                                $totalConfirmados = 0;
                                $totalMortos = 0;
                                include_once 'service.php';

                                foreach($json as $key => $dados):
                                $totalConfirmados += $dados->Confirmados;
                                $totalMortos += $dados->Mortos;
                        ?>
                            <tr>
                                <th scope="row">
                                    <?= htmlspecialchars($key + 1); ?>
                                </th>
                                <td>
                                    <?= htmlspecialchars($dados->ProvinciaEstado); ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($dados->Confirmados); ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($dados->Mortos); ?>
                                </td>
                        </tr>
                        <?php
                            endforeach;
                            endif;
                        ?>
                        <div id="informacoesExtras">
                            <span>
                                <span class="textoInfoExtras">Total de casos confirmados:</span> 
                                <span class="infoDados">
                                    <?=isset($_GET['pais']) ? htmlspecialchars($totalConfirmados) : 0; ?>
                                </span>
                            </span>
                            

                            <span class="textoInfoExtras">
                                <span class="textoInfoExtras">Total de mortes:</span>
                                <span class="infoDados">
                                    <?= isset($_GET['pais']) ? htmlspecialchars($totalMortos) : 0; ?>
                                </span>
                            </span>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="container">
        <?php
            include_once 'taxaPaises.php';
        ?>
    </div>

    <footer>
        <div>
            <p>
                <?php
                    include_once 'service-select.php';
                ?>
            </p>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>
