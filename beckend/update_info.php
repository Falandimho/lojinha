<?php
session_start();
include('conexao.php');

function alerta($type, $title, $msg)
{
    echo "<script type='text/javascript'>
		Swal.fire({
			icon: '$type',
			title: '$title',
			text: '$msg',
			showConfirmButton: false,
			timer: 2000
		});
		</script>";
}

$codGet = $_SESSION['codGet'];
$link = $_SESSION['link'];

$tipo = implode($_POST['tipo']);
$cod = $_POST['cod'];
$marca = $_POST['marca'];
$tamanho = implode($_POST['tamanho']);
$comp = implode($_POST['comp']);
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

$stmt = $con->prepare("UPDATE pecas SET cod = :cod, tipo = :tipo, cor = :cor, marca = :marca, tamanho = :tamanho, comprimento = :comp,
forma_compra = :forma_compra, forma_venda = :forma_venda, valor_custo = :valor_custo, valor_pago = :valor_pago,
valor_cheio = :valor_cheio, valor_venda = :valor_venda, valor_prazo = :valor_prazo, valor_vista = :valor_vista,
parcelas = :parcelas, desconto = :desconto, data_compra = :data_compra, data_venda = :data_venda, descricao = :descricao,
med_ombro = :med_ombro, med_busto = :med_busto, med_cintura = :med_cintura, med_quadril = :med_quadril, situacao = :situacao WHERE cod = :codGet");

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
    ':situacao' => $status,
    ':codGet' => $codGet
));

if ($stmt->rowCount() > 0) {
    if (!empty($_POST['arquivo'])) {
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

        $path = $pasta . $novoNomeArq . "." . $extensao;
        $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);

        if ($deu_certo) {
            $stmt = $con->prepare("INSERT INTO imagens (caminho, cod_peca) VALUES (:caminho, :cod_peca)");
            $stmt->execute(array(
                ':caminho' => $path,
                ':cod_peca' => $cod
            ));
        }
    }if($link == "vendido"){
        header('location: ../vendidas.php');
    }else{
        header('location: ../index.php');
    }
}else{
    alerta("error", false, "Não foi possível atualizar a roupa");
    header("Refresh: 2");
}
