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
        <form method="post" action="beckend/add_roupa.php" enctype="multipart/form-data">

            <div id="parte1">
                <!-- informações -->
                <h2>Preencha as informações</h2>

                <p><label for="cod">Código da peça: </label>
                    <input style="width: 73%" type="number" name="cod" id="cod" maxlength="5" required>
                </p>

                <p><label for="marca">Marca da peça: </label>
                    <input style="width: 74.4%" type="text" name="marca" id="marca" required>
                </p>

                <!-- Tamanho -->
                <p class="infos">Tamanho da peça:</p>
                <p><input type="radio" name="tamanho" id="PP" value="PP" required>
                    <label for="PP">PP</label>

                    <input type="radio" name="tamanho" id="P" value="P">
                    <label for="P">P</label>

                    <input type="radio" name="tamanho" id="M" value="M">
                    <label for="M">M</label>

                    <input type="radio" name="tamanho" id="G" value="G">
                    <label for="G">G</label>

                    <input type="radio" name="tamanho" id="GG" value="GG">
                    <label for="GG">GG</label>

                    <input type="radio" name="tamanho" id="G1" value="G1">
                    <label for="G1">G1</label>

                    <input type="radio" name="tamanho" id="G2" value="G2">
                    <label for="G2">G2</label>

                    <input type="radio" name="tamanho" id="G3" value="G3">
                    <label for="G3">G3</label>
                </p>

                <!-- comprimento -->
                <p class="infos">Comprimento da peça:</p>
                <p><input type="radio" name="comp" id="curto" value="Curto" required>
                    <label for="curto">Curto</label>

                    <input type="radio" name="comp" id="midi" value="Midi">
                    <label for="midi">Midi</label>

                    <input type="radio" name="comp" id="maxi-midi" value="Maxi-Midi">
                    <label for="mixi-midi">Maxi-Midi</label>

                    <input type="radio" name="comp" id="longo" value="longo">
                    <label for="longo">Longo</label>
                </p>

                <!-- tipo da peça -->
                <h2>Selecione o tipo de peça</h2>
                <p><input type="radio" name="tipo" value="Blazer" id="blazer" required>
                    <label for="blazer">Blazer</label>

                    <input type="radio" name="tipo" value="Blusa" id="blusa">
                    <label for="blusa">Blusa</label>

                    <input type="radio" name="tipo" value="Conjunto" id="conjunto">
                    <label for="conjunto">Conjunto</label>

                    <input type="radio" name="tipo" value="Jaqueta" id="jaqueta">
                    <label for="jaqueta">Jaqueta</label>

                    <input type="radio" name="tipo" value="Saia" id="saia">
                    <label for="saia">Saia</label>

                    <input type="radio" name="tipo" value="T-shirt" id="tshirt">
                    <label for="saia">T-shirt</label>

                    <input type="radio" name="tipo" value="Vestido" id="vestido">
                    <label for="saia">Vestido</label>

                    <input type="radio" name="tipo" value="Camisa" id="camisa">
                    <label for="saia">Camisa</label>
                </p>
            </div>

            <div id="parte2">
                <!-- valores -->
                <h2>Valores</h2>

                <p><label for="forma-comp">Forma de Compra: </label>
                    <input style="width: 70%" type="text" name="forma-compra" id="forma-comp">
                </p>

                <P><label for="forma-venda">Forma de Venda: </label>
                    <input style="width: 72%" type="text" name="forma-venda" id="forma-venda">
                </p>

                <P><label for="valor-custo">Valor de Custo: </label>
                    <input style="width: 74%" type="number" name="valor-custo" id="valor-custo" step=".01" maxlength="6">
                </p>

                <P><label for="valor-pago">Valor Pago: </label>
                    <input style="width: 79%" type="number" name="valor-pago" id="valor-pago" step=".01" maxlength="6">
                </p>

                <P><label for="valor-cheio">Valor Cheio: </label>
                    <input style="width: 78%" type="number" name="valor-cheio" id="valor-cheio" step=".01" maxlength="6">
                </p>

                <P><label for="valor-venda">Valor de Venda: </label>
                    <input style="width: 73.3%" type="number" name="valor-venda" id="valor-venda" step=".01" maxlength="6">
                </p>

                <P><label for="valor-vista">Valor à Vista: </label>
                    <input style="width: 76.5%" type="number" name="valor-vista" id="valor-vista" step=".01" maxlength="6">
                </p>

                <P><label for="valor-prazo">Valor Prazo: </label>
                    <input style="width: 78%" type="number" name="valor-prazo" id="valor-prazo" step=".01" maxlength="6">
                </p>

                <P><label for="parce">Parcelas: </label>
                    <input style="width: 81.8%" type="number" name="parce" id="parce" maxlength="2">
                </p>

                <P><label for="desconto">Desconto em Reais: </label>
                    <input style="width: 68%" type="number" name="desconto" id="desconto" step=".01">
                </p>

                <P><label for="data-compra">Data da Compra: </label>
                    <input style="width: 71.5%" type="date" name="data-compra" id="data-compra">
                </p>

                <P><label for="data-venda">Data da Venda: </label>
                    <input style="width: 73.5%" type="date" name="data-venda" id="data-venda">
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
                    <input style="width: 89.5%" type="number" name="med-busto" id="med-busto" step=".01">
                </p>

                <p><label for="med-ombro">Ombro: </label>
                    <input style="width: 88.2%" type="number" name="med-ombro" id="med-ombro" step=".01">
                </p>

                <p><label for="med-cintura">Cintura: </label>
                    <input style="width: 88%" type="number" name="med-cintura" id="med-cintura">
                </p>

                <p><label for="med-quadril">Quadril: </label>
                    <input style="width: 88%" type="number" name="med-quadril" id="med-quadril">
                </p>

                <p><label for="cor">Cor: </label>
                    <input style="width: 93%" type="text" name="cor" id="cor">
                </p>

                <p style="display: flex; align-items: center; gap: 5px;"><label for="desc">Descrição do Produto: </label>
                    <textarea style="width: 69%" type="text" name="descricao" id="desc">Descrição do Produto</textarea>
                </p>

                <p><label for="foto">Selecione um arquivo de imagem: </label>
                    <input type="file" name="foto" id="foto">
                </p>
            </div>

            <input type="submit" value="Cadastrar">
        </form>
        <a class="inicio" href="index.php">Ir para tela inicial</a>
    </div>
</body>

</html>