<?php
include('conexao.php');
session_start();

$tipo = $_POST['tipo'];
$cod = $_POST['cod'];
$marca = $_POST['marca'];
$tamanho = $_POST['tamanho'];
$comp = $_POST['comp'];
$forma_compra = $_POST['forma-compra'] ?: null;
$forma_venda = $_POST['forma-venda'] ?: null;
$val_custo = $_POST['valor-custo'] ?: null;
$val_pago = $_POST['valor-pago'] ?: null;
$val_cheio = $_POST['valor-cheio'] ?: null;
$val_venda = $_POST['valor-venda'] ?: null;
$val_prazo = $_POST['valor-prazo'] ?: null;
$val_vista = $_POST['valor-vista'] ?: null;
$parce = $_POST['parce'] ?: null;
$desconto = $_POST['desconto'] ?: null;
$data_compra = $_POST['data-compra'] ?: null;
$data_venda = $_POST['data-venda'] ?: null;
$desc = $_POST['descricao'] ?: null;
$med_ombro = $_POST['med-ombro'] ?: null;
$med_busto = $_POST['med-busto'] ?: null;
$med_cintura = $_POST['med-cintura'] ?: null;
$med_quadril = $_POST['med-quadril'] ?: null;
$cor = $_POST['cor'];
$status = $_POST['sit'];
$arquivo = $_FILES['foto'] ?: null;

try {

    $stmt = $con->prepare("INSERT INTO pecas (`cod`, `tipo`, `cor`, `marca`, `tamanho`, `comprimento`, `forma_compra`, `forma_venda`,
`valor_custo`, `valor_pago`, `valor_cheio`, `valor_venda`, `valor_prazo`, `valor_vista`, `parcelas`, `desconto`, `data_compra`,
`data_venda`, `descricao`, `med_ombro`, `med_busto`, `med_cintura`, `med_quadril`, `situacao`)

VALUES (:cod, :tipo, :cor, :marca, :tamanho, :comprimento, :forma_compra, :forma_venda, :valor_custo, :valor_pago, :valor_cheio,
:valor_venda, :valor_prazo, :valor_vista, :parcelas, :desconto, :data_compra, :data_venda, :descricao, :med_ombro, :med_busto,
:med_cintura, :med_quadril, :situacao)");

    $stmt->execute(array(
        ':cod' => $cod,
        ':tipo' => $tipo,
        ':cor' => $cor,
        ':marca' => $marca,
        ':tamanho' => $tamanho,
        ':comprimento' => $comp,
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

        if (isset($_POST['arquivo'])) {
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

            $stmtSel = $con->query("SELECT cod FROM pecas WHERE cod = '$cod';");
            while ($dados = $stmtSel->fetch(PDO::FETCH_ASSOC)) {
                $id = $dados['id'];
            }

            if ($stmtSel->rowCount() > 0) {
                if ($deu_certo) {
                    $stmt = $con->prepare("INSERT INTO imagens (caminho, id_peca) VALUES (:caminho, :id_peca)");
                    $stmt->execute(array(
                        ':caminho' => $path,
                        ':id_peca' => $id
                    ));
                }
                header('location: ../tela_add_roupa.php');
            }
        }
        header('location: ../tela_add_roupa.php');
    }
} catch (PDOException $e) {
    $_SESSION['erro'] = true;
    echo "<body onload='window.history.back();'>";
}
