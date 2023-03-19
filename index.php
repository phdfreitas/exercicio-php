<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio Kidopi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <p>Selecione o país que você quer verificar os dados.</p>
            <form>
                <label for="pais">
                    <input type="radio" name="pais" class="pais-info1" value="Brazil">
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
        
        <div class="row">
            <h1 class="titulo">
                Informações sobre <?php echo $_GET['pais']; ?>
            </h1>
            <table class="table">
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

                            foreach($json as $key => $dados):
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
                </tbody>
            </table>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>
