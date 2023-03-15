<?php
include_once('beckend/conexao.php');

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$vet_tam = array("PP", "p", "M", "g", "GG", "G1", "G2", "G3");
$vet_comp = array("Curto", "midi", "Maxi-Midi", "Longo");
$vet_tipo = array("Blazer", "Blusa", "Camisa", "Conjunto", "Jaqueta", "Saia", "T-shirt", "Vestido");
$vet_status = array("Estoque", "Vendido");


?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/pecas.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">

    <title>Peças em Estoque</title>
</head>

<body>
    <div class="content">
        <?php
        include('beckend/list_roupa.php');
        ?>
    </div>

    <div class="qtd-peca">
        <p>Quantidade de peças: <b><?php echo $count; ?></b></p>
        <p>Quantidade em Reais de peças: <b>R$<?php echo " " . $total_venda; ?></b></p>
        <p>Total do valor pago: <b>R$<?php echo " " . $total_pago; ?></b></p>
    </div>

    <div id="menu">
        <span id="link">
            <a href="tela_add_roupa.php">Adicionar Roupa</a>
        </span>
        <form method="post">
            <h2>Filtros</h2>
            <hr>

            <input type="text" name="busca" placeholder="Pesquisa">

            <h2>Tamanho da peça:</h2>

            <?php
            if (isset($_POST['submit'])) {
                if (isset($_POST['clear'])) {
                    $_POST['submit'] == false;
                    $checked == "";
                }
            }
            for ($i = 0; $i < 8; $i++) {
                $tamanho_list = "";
                if (isset($dados['tamanho'])) {
                    foreach ($dados['tamanho'] as $tamanho_pesq_list) {
                        $tamanho_list .= "$tamanho_pesq_list, ";
                    }
                }

                $tamanho_check = mb_strpos($tamanho_list, $vet_tam[$i]);

                if ($tamanho_check === false || isset($_POST['clear'])) {
                    $checked = "";
                } else {
                    $checked = "checked";
                }
                echo "<input type='checkbox' name='tamanho[]' id='$vet_tam[$i]' value='$vet_tam[$i]' $checked>";
                echo "<label for='$vet_tam[$i]'>" . strtoupper($vet_tam[$i]) . "</label>";
                echo "<br>";
            }

            ?>

            <h2>Comprimento da peça:</h2>

            <?php
            for ($i = 0; $i < 4; $i++) {
                $comp_list = "";
                if (isset($dados['comp'])) {
                    foreach ($dados['comp'] as $comp_pesq_list) {
                        $comp_list .= "$comp_pesq_list, ";
                    }
                }

                $comp_check = mb_strpos($comp_list, $vet_comp[$i]);

                if ($comp_check === false || isset($_POST['clear'])) {
                    $checked = "";
                } else {
                    $checked = "checked";
                }
                echo "<input type='checkbox' name='comp[]' id='$vet_comp[$i]' value='$vet_comp[$i]' $checked>";
                echo "<label for='$vet_comp[$i]'>" . ucfirst($vet_comp[$i]) . "</label>";
                echo "<br>";
            }

            ?>

            <!-- tipo da peça -->
            <h2>Tipo de peça</h2>
            <?php

            for ($i = 0; $i < 8; $i++) {
                $tipo_list = "";
                if (isset($dados['tipo'])) {
                    foreach ($dados['tipo'] as $tipo_pesq_list) {
                        $tipo_list .= "$tipo_pesq_list, ";
                    }
                }

                $tipo_check = mb_strpos($tipo_list, $vet_tipo[$i]);

                if ($tipo_check === false || isset($_POST['clear'])) {
                    $checked = "";
                } else {
                    $checked = "checked";
                }
                echo "<input type='checkbox' name='tipo[]' id='$vet_tipo[$i]' value='$vet_tipo[$i]' $checked>";
                echo "<label for='$vet_tipo[$i]'>$vet_tipo[$i]</label>";
                echo "<br>";
            }
            ?>

            <input type="submit" class="button-filter" name="submit" value="Filtrar">
            <button name="clear" class="button-filter">Limpar</button>
        </form>

    </div>

</body>

</html>