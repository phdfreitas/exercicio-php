<?php

$hg = file_get_contents("https://dev.kidopilabs.com.br/exercicio/covid.php?listar_paises=1");
$json = json_decode($hg);

?>


<div id="comparacao">
    
    <div id="tituloComparacao">
        <h1>Compare os dados de dois países</h1>
    </div>
    
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
        <input type="submit" value="Enviar">
    </form>

    <?php

    if (isset($_GET['pais1']) && isset($_GET['pais2'])):
        $hgPais1 = file_get_contents("https://dev.kidopilabs.com.br/exercicio/covid.php?pais=".$_GET['pais1']);
        $jsonPais1 = json_decode($hgPais1);
        $totalConfirmadosPais1 = 0;
        $totalMortosPais1 = 0;

        $hgPais2 = file_get_contents("https://dev.kidopilabs.com.br/exercicio/covid.php?pais=".$_GET['pais2']);
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

        $taxaMortePais1 = ($totalMortosPais1 / $totalConfirmadosPais1) * 100;
        $taxaMortePais2 = ($totalMortosPais2 / $totalConfirmadosPais2) * 100;

        $diferencaTaxaMorte = $taxaMortePais1 - $taxaMortePais2;
    ?>

        <div>
            <h1>Resultado</h1>
            <table class="table table-striped" id="dadosCovid">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><?= htmlspecialchars($_GET['pais1']); ?></th>
                            <th scope="col"><?= htmlspecialchars($_GET['pais2']); ?></th>
                            <th scope="col">Diferença Taxa de Morte</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                Taxa de Morte
                            </th>
                            <td>
                                <?= htmlspecialchars($taxaMortePais1); ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($taxaMortePais2); ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($diferencaTaxaMorte); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
        </div>

    <?php
        endif;
    ?>

</div>

