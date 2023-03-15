<?php
session_start();
include('beckend/conexao.php');

$dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$testetam = array($dados['tamanho']);
$testetipo = array($dados['tipo']);
$testecomp = array($dados['comp']);


$codGet = $_GET['cod'];
$_SESSION['codGet'] = $codGet;
$tipoGet = $_GET['tipo'];
$tamGet = $_GET['tamanho'];

$link = $_GET['link'];
$_SESSION['link'] = $link;

$vet_tam = array("PP", "P", "M", "G", "GG", "G1", "G2", "G3");
$vet_comp = array("Curto", "Midi", "Maxi-Midi", "Longo");
$vet_tipo = array("Blazer", "Blusa", "Camisa", "Conjunto", "Jaqueta", "Saia", "T-shirt", "Vestido");
$vet_status = array("Estoque", "Vendido");

$stmt = $con->query("SELECT * FROM pecas where cod = '$codGet'");

while ($instrucao = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $cod = $instrucao['cod'];
    $tamanho = $instrucao['tamanho'];
    $cor = $instrucao['cor'];
    $comprimento = $instrucao['comprimento'];
    $marca = $instrucao['marca'];
    $desc = $instrucao['descricao'];
    $tipo = $instrucao['tipo'];
    $forma_compra = $instrucao['forma_compra'];
    $forma_venda = $instrucao['forma_venda'];
    $parce = $instrucao['parcelas'];
    $desconto = $instrucao['desconto'];

    // data
    $data_comp = $instrucao['data_compra'];
    $data_vend = $instrucao['data_venda'];

    //<-----------------Escrita dos Valores----------------->

    $valor_custo = $instrucao['valor_custo'];
    $valor_cheio = $instrucao['valor_cheio'];
    $valor_pago = $instrucao['valor_pago'];
    $valor_vista = $instrucao['valor_vista'];
    $valor_venda = $instrucao['valor_venda'];
    $valor_prazo = $instrucao['valor_prazo'];

    //<-----------------Escrita das Medidas----------------->

    $med_ombro = $instrucao['med_ombro'];
    $med_busto = $instrucao['med_busto'];
    $med_cintura = $instrucao['med_cintura'];
    $med_quadril = $instrucao['med_quadril'];    
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/info.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">

    <title>Stina Moda Evangélica</title>
</head>

<body>
    <div class="content">
        <form method="post" action="beckend/update_info.php" enctype="multipart/form-data">

            <div id="parte1">
                <!-- informações -->
                <h2>Preencha as informações</h2>
                <p><label for="cod">Código da peça: </label>
                    <input style="width: 73%" type="number" name="cod" id="cod" maxlength="5" value="<?php echo $cod; ?>">
                </p>

                <p><label for="marca">Marca da peça: </label>
                    <input style="width: 74.2%" type="text" name="marca" id="marca" value="<?php echo $marca; ?>">
                </p>

                <!-- Tamanho -->
                <p class="infos">Tamanho da peça:</p>
                <p style="display: flex; gap: 5px;">
                    <?php
                    for ($i = 0; $i < 8; $i++) {
                        $tamanho_list = "";
                        foreach ($testetam as $tamanho_pesq_list) {
                            $tamanho_list = $tamanho_pesq_list;
                        }

                        $tamanho_check = mb_strpos($tamanho_list, $vet_tam[$i]);


                        if ($tamanho_check === false) {
                            $checked = "";
                        } else {
                            $checked = "checked";
                        }
                        echo "<input type='radio' name='tamanho[]' id='$vet_tam[$i]' value='$vet_tam[$i]' $checked>";
                        echo "<label for='$vet_tam[$i]'>$vet_tam[$i]</label>";
                    }

                    ?>
                </p>

                <!-- comprimento -->
                <p class="infos">Comprimento da peça:</p>
                <p style="display: flex; gap: 5px;">
                    <?php
                    for ($i = 0; $i < 4; $i++) {
                        $comp_list = "";
                        foreach ($testecomp as $comp_pesq_list) {
                            $comp_list = $comp_pesq_list;
                        }

                        $comp_check = mb_strpos($comp_list, $vet_comp[$i]);

                        if ($comp_check === false) {
                            $checked = "";
                        } else {
                            $checked = "checked";
                        }
                        echo "<input type='radio' name='comp[]' id='$vet_comp[$i]' value='$vet_comp[$i]' $checked>";
                        echo "<label for='$vet_comp[$i]'>$vet_comp[$i]</label>";
                    }
                    ?>
                </p>

                <!-- tipo da peça -->
                <h2>Selecione o tipo de peça</h2>
                <p style="display: flex; gap: 2px;">
                    <?php

                    for ($i = 0; $i < 8; $i++) {
                        $tipo_list = "";
                        foreach ($testetipo as $tipo_pesq_list) {
                            $tipo_list .= "$tipo_pesq_list, ";
                        }

                        $tipo_check = mb_strpos($tipo_list, $vet_tipo[$i]);

                        if ($tipo_check === false) {
                            $checked = "";
                        } else {
                            $checked = "checked";
                        }
                        echo "<input type='radio' name='tipo[]' id='$vet_tipo[$i]' value='$vet_tipo[$i]' $checked>";
                        echo "<label for='$vet_tipo[$i]'>$vet_tipo[$i]</label>";
                    }
                    ?>
                </p>
            </div>

            <div id="parte2">
                <!-- valores -->
                <h2>Valores</h2>

                <p><label for="forma-comp">Forma de Compra: </label>
                    <input style="width: 70%" type="text" name="forma-compra" id="forma-comp" value="<?php echo $forma_compra ?>">
                </p>

                <P><label for="forma-venda">Forma de Venda: </label>
                    <input style="width: 72%" type="text" name="forma-venda" id="forma-venda" value="<?php echo $forma_venda; ?>">
                </p>

                <P><label for="valor-custo">Valor de Custo: </label>
                    <input style="width: 74%" type="number" name="valor-custo" id="valor-custo" step=".01" maxlength="6" value="<?php echo $valor_custo; ?>">
                </p>

                <P><label for="valor-pago">Valor Pago: </label>
                    <input style="width: 79%" type="number" name="valor-pago" id="valor-pago" step=".01" maxlength="6" value="<?php echo $valor_pago; ?>">
                </p>

                <P><label for="valor-cheio">Valor Cheio: </label>
                    <input style="width: 78%" type="number" name="valor-cheio" id="valor-cheio" step=".01" maxlength="6" value="<?php echo $valor_cheio; ?>">
                </p>

                <P><label for="valor-venda">Valor de Venda: </label>
                    <input style="width: 73.3%" type="number" name="valor-venda" id="valor-venda" step=".01" maxlength="6" value="<?php echo $valor_venda; ?>">
                </p>

                <P><label for="valor-vista">Valor à Vista: </label>
                    <input style="width: 76.5%" type="number" name="valor-vista" id="valor-vista" step=".01" maxlength="6" value="<?php echo $valor_vista; ?>">
                </p>

                <P><label for="valor-prazo">Valor Prazo: </label>
                    <input style="width: 78%" type="number" name="valor-prazo" id="valor-prazo" step=".01" maxlength="6" value="<?php echo $valor_prazo; ?>">
                </p>

                <P><label for="parce">Parcelas: </label>
                    <input style="width: 81.8%" type="number" name="parce" id="parce" maxlength="2" value="<?php echo $parce; ?>">
                </p>

                <P><label for="desconto">Desconto em Reais: </label>
                    <input style="width: 68%" type="number" name="desconto" id="desconto" step=".01" value="<?php echo $desconto; ?>">
                </p>

                <P><label for="data-compra">Data da Compra: </label>
                    <input style="width: 71.5%" type="date" name="data-compra" id="data-compra" value="<?php echo $data_comp ?>">
                </p>

                <P><label for="data-venda">Data da Venda: </label>
                    <input style="width: 73.5%" type="date" name="data-venda" id="data-venda" value="<?php echo $data_vend; ?>">
                </p>

                <p class="infos">Situação:</p>
                <p><input type="radio" name="sit" id="vendido" value="Vendido">
                    <label for="vendido">Vendido</label>

                    <input type="radio" name="sit" id="estoque" value="Estoque">
                    <label for="estoque">Em estoque</label>
                </p>
            </div>

            <div id="parte3">
                <!-- medidas -->
                <h2>Medidas</h2>

                <p><label for="med-busto">Busto: </label>
                    <input style="width: 89.5%" type="number" name="med-busto" id="med-busto" step=".01" value="<?php echo $med_busto; ?>">
                </p>

                <p><label for="med-ombro">Ombro: </label>
                    <input style="width: 88.2%" type="number" name="med-ombro" id="med-ombro" step=".01" value="<?php echo $med_ombro; ?>">
                </p>

                <p><label for="med-cintura">Cintura: </label>
                    <input style="width: 88%" type="number" name="med-cintura" id="med-cintura" value="<?php echo $med_cintura; ?>">
                </p>

                <p><label for="med-quadril">Quadril: </label>
                    <input style="width: 88%" type="number" name="med-quadril" id="med-quadril" value="<?php echo $med_quadril; ?>">
                </p>

                <p><label for="cor">Cor: </label>
                    <input style="width: 93%" type="text" name="cor" id="cor" value="<?php echo $cor; ?>">
                </p>

                <p><label for="desc">Descrição do Produto: </label>
                    <input style="width: 69%" type="text" name="descricao" id="desc" value="<?php echo $desc; ?>">
                </p>

                <p><label for="foto">Selecione um arquivo de imagem: </label>
                    <input type="file" name="foto" id="foto">
                </p>
            </div>

            <input type="submit" value="Atualizar">
        </form>
        <a class="inicio" href="<?php if($link == "vendido"){
            echo "vendidas.php";
        }else{
            echo "index.php";
        } ?>">Ir para tela inicial</a>
    </div>
</body>

</html>