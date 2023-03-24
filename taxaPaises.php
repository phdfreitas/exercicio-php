<?php

$hg = file_get_contents("https://dev.kidopilabs.com.br/exercicio/covid.php?listar_paises=1");
$json = json_decode($hg);

?>


<div id="comparacao">
    
    <div id="tituloComparacao">
        <h1>Faça a comparação entre dois países</h1>
    </div>
    
    <div class="formulario">
        <form>
            <select name="pais1">
                <option value="#">Selecione o Primeiro País</option>
                <?php
                    foreach ($json as $key => $value):
                ?>
                    <option value="<?= htmlspecialchars($value); ?>">
                        <?= htmlspecialchars($value); ?>
                    </option>
                <?php
                    endforeach;
                ?>
            </select>

            <select name="pais2">
                <option value="#">Selecione o Segundo País</option>
                <?php
                    foreach ($json as $key => $value):
                ?>
                    <option value="<?= htmlspecialchars($value); ?>">
                        <?= htmlspecialchars($value); ?>
                    </option>
                <?php
                    endforeach;
                ?>
            </select>
                    
            <div class="button">
                <button class="btn btn-primary">Comparar</button>
            </div>
        </form>
    </div>

    <?php

    if (isset($_GET['pais1']) && isset($_GET['pais2'])):
        
        $nomePais1 = str_replace(" ", "%20", $_GET['pais1']);
        $nomePais2 = str_replace(" ", "%20", $_GET['pais2']);

        $hgPais1 = file_get_contents("https://dev.kidopilabs.com.br/exercicio/covid.php?pais=".$nomePais1);
        $jsonPais1 = json_decode($hgPais1);
        $totalConfirmadosPais1 = 0;
        $totalMortosPais1 = 0;

        $hgPais2 = file_get_contents("https://dev.kidopilabs.com.br/exercicio/covid.php?pais=".$nomePais2);
        $jsonPais2 = json_decode($hgPais2);
        $totalConfirmadosPais2 = 0;
        $totalMortosPais2 = 0;

        foreach($jsonPais1 as $key => $dados){
            $totalConfirmadosPais1 += $dados->Confirmados;
            $totalMortosPais1 += $dados->Mortos;
        }

        foreach($jsonPais2 as $key => $dados){
            $totalConfirmadosPais2 += $dados->Confirmados;
            $totalMortosPais2 += $dados->Mortos;
        }

        $taxaMortePais1 = number_format(($totalMortosPais1 * 1000 / $totalConfirmadosPais1), 3);
        $taxaMortePais2 = number_format(($totalMortosPais2 * 1000 / $totalConfirmadosPais2), 3);

        $diferencaTaxaMorte = $taxaMortePais1 - $taxaMortePais2;
    ?>

    <div>
        <table class="table" id="dadosCovid">
            <thead>
                <tr class="table-info">
                    <th scope="col">#</th>
                    <th scope="col"><?= htmlspecialchars($_GET['pais1']); ?></th>
                    <th scope="col"><?= htmlspecialchars($_GET['pais2']); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">
                        Taxa de Mortalidade
                    </th>
                    <td>
                        <?= htmlspecialchars($taxaMortePais1); ?> %
                    </td>
                    <td>
                        <?= htmlspecialchars($taxaMortePais2); ?> %
                    </td>
                </tr>
                <tr sc>
                    <th scope="row">
                        Diferença de Taxa de Mortalidade
                    </th>
                    <td colspan="2">
                        <?= htmlspecialchars($diferencaTaxaMorte); ?> %
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php
        endif;
    ?>

</div>

