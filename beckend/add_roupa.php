<?php
include('conexao.php');

$tipo = $_POST['tipo'];
$cod = $_POST['cod'];
$marca = $_POST['marca'];
$tamanho = $_POST['tamanho'];
$comp = $_POST['comp'];
$forma_compra = $_POST['forma-compra'];
$forma_venda = $_POST['forma-venda'];
$val_custo = $_POST['valor-custo'];
$val_pago = $_POST['valor-pago'];
$val_cheio = $_POST['valor-cheio'];
$val_venda = $_POST['valor-venda'];
$val_prazo = $_POST['valor-prazo'];
$val_vista = $_POST['valor-vista'];
$parce = $_POST['parce'];
$desconto = $_POST['desconto'];
$data_compra = $_POST['data-compra'];
$data_venda = $_POST['data-venda'];
$desc = $_POST['descricao'];
$med_ombro = $_POST['med-ombro'];
$med_busto = $_POST['med-busto'];
$med_cintura = $_POST['med-cintura'];
$med_quadril = $_POST['med-quadril'];
$cor = $_POST['cor'];
$status = $_POST['sit'];
$arquivo = $_FILES['foto'];

$stmt = $con->prepare('INSERT INTO pecas (cod, tipo, cor, marca, tamanho, comprimento, forma_compra, forma_venda,
valor_custo, valor_pago, valor_cheio, valor_venda, valor_prazo, valor_vista, parcelas, desconto, data_compra, 
data_venda, descricao, med_ombro, med_busto, med_cintura, med_quadril, situacao) 

VALUES (:cod, :tipo, :cor, :marca, :tamanho, :comp, :forma_compra, :forma_venda, :valor_custo, :valor_pago, :valor_cheio, :valor_venda,
:valor_prazo, :valor_vista, :parcelas, :desconto, :data_compra, :data_venda, :descricao, :med_ombro, :med_busto, med_cintura, :med_quadril,
:situacao)');

$stmt->execute(array(
    ':cod' => $cod,
    ':tipo' => $tipo,
    ':cor' => $cor,
    ':marca' => $marca,
    ':tamanho' => $tamanho,
    ':comp' => $comp,
    ':forma_compra' => $forma_compra,
    ':forma_venda' => $forma_venda,
    ':valor_custo' => $val_custo,
    ':valor_pago' => $val_pago,
    ':valor_cheio' => $val_cheio,
    ':valor_venda' => $val_venda,
    ':valor_prazo' => $val_prazo,
    ':valor_vista' => $val_vista,
    ':parcelas' => $parce,
    ':desconto' => $desconto,
    ':data_compra' => $data_compra,
    ':data_venda' => $data_venda,
    ':descricao' => $desc,
    ':med_ombro' => $med_ombro,
    ':med_busto' => $med_busto,
    ':med_cintura' => $med_cintura,
    ':med_quadril' => $med_quadril,
    ':situacao' => $status
));



if ($stmt->rowCount() > 0) {

    if ($arquivo['error']) {
        die("Falha ao enviar arquivo");
    }


    $pasta = "arquivos/";
    $nomeArq = $arquivo['name'];
    $novoNomeArq = uniqid();
    $extensao = strtolower(pathinfo($nomeArq, PATHINFO_EXTENSION));

    if ($extensao != "jpg" && $extensao = !"png" && $extensao = !"jpeg") {
        die("Tipo de arquivo não suportado");
    }

    $path = "../" . $pasta . $novoNomeArq . "." . $extensao;
    $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);

    if ($deu_certo) {
        $stmt = $con->prepare("INSERT INTO imagens (caminho, cod_peca) VALUES (:caminho, :cod_peca)");
        $stmt->execute(array(
            ':caminho' => $path,
            ':cod_peca' => $cod
        ));
    }
    header('location: ../tela_add_roupa.php');
}
