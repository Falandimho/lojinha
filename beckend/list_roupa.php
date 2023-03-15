<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

// <------------------------------------- erro ----------------->
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

// <!----------------------------------- Filtros -----------------------------
if (isset($_POST['submit'])) {
    try {

        if (isset($_POST['tamanho']) && isset($_POST['comp']) && isset($_POST['tipo'])) {
            $tamanho = "";
            $controle = 1;
            foreach ($dados["tamanho"] as $tamanho_pesq) {
                if ($controle == 1) {
                    $tamanho .= "'$tamanho_pesq'";
                } else {
                    $tamanho .= ", '$tamanho_pesq'";
                }
                $controle++;
            }

            $comp = "";
            $controle = 1;
            foreach ($dados["comp"] as $comp_pesq) {
                if ($controle == 1) {
                    $comp .= "'$comp_pesq'";
                } else {
                    $comp .= ", '$comp_pesq'";
                }
                $controle++;
            }

            $tipo = "";
            $controle = 1;
            foreach ($dados["tipo"] as $tipo_pesq) {
                if ($controle == 1) {
                    $tipo .= "'$tipo_pesq'";
                } else {
                    $tipo .= ", '$tipo_pesq'";
                }
                $controle++;
            }

            if (isset($_POST['busca'])) {
                $busca = $_POST['busca'];
                $testebusca = explode(" ", $busca);
                $campo = $testebusca[0];

                if (!empty($testebusca[1])) {
                    $search = $testebusca[1];
                } else {
                    $search = "a";
                }
            }

            if (!empty($campo) && !empty($search)) {
                $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp) AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp) AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp) AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp) AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $count = $stmtCount->fetchColumn();
                $total_venda = $stmtPrecoV->fetchColumn();
                $total_pago = $stmtPrecoP->fetchColumn();
            } else {
                $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp) AND tipo IN ($tipo)");
                $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp) AND tipo IN ($tipo)");
                $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp) AND tipo IN ($tipo)");
                $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp) AND tipo IN ($tipo)");
                $count = $stmtCount->fetchColumn();
                $total_venda = $stmtPrecoV->fetchColumn();
                $total_pago = $stmtPrecoP->fetchColumn();
            }


            // -------------------------filtro tamanho comp -------------------->
        } else if (isset($_POST['tamanho']) && isset($_POST['comp'])) {
            $tamanho = "";
            $controle = 1;
            foreach ($dados["tamanho"] as $tamanho_pesq) {
                if ($controle == 1) {
                    $tamanho .= "'$tamanho_pesq'";
                } else {
                    $tamanho .= ", '$tamanho_pesq'";
                }
                $controle++;
            }

            $comp = "";
            $controle = 1;
            foreach ($dados["comp"] as $comp_pesq) {
                if ($controle == 1) {
                    $comp .= "'$comp_pesq'";
                } else {
                    $comp .= ", '$comp_pesq'";
                }
                $controle++;
            }

            if (isset($_POST['busca'])) {
                $busca = $_POST['busca'];
                $testebusca = explode(" ", $busca);
                $campo = $testebusca[0];

                if (!empty($testebusca[1])) {
                    $search = $testebusca[1];
                } else {
                    $search = "a";
                }
            }
            if (!empty($campo) && !empty($search)) {
                $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp) AND $campo LIKE '%$search%'");
                $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp) AND $campo LIKE '%$search%'");
                $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp) AND $campo LIKE '%$search%'");
                $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp) AND $campo LIKE '%$search%'");
                $count = $stmtCount->fetchColumn();
                $total_venda = $stmtPrecoV->fetchColumn();
                $total_pago = $stmtPrecoP->fetchColumn();
            } else {
                $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp)");
                $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp)");
                $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp)");
                $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND comprimento IN ($comp)");
                $count = $stmtCount->fetchColumn();
                $total_venda = $stmtPrecoV->fetchColumn();
                $total_pago = $stmtPrecoP->fetchColumn();
            }

            // -------------------------filtro tamanho tipo --------------------
        } else if (isset($_POST['tamanho']) && isset($_POST['tipo'])) {

            $tamanho = "";
            $controle = 1;
            foreach ($dados["tamanho"] as $tamanho_pesq) {
                if ($controle == 1) {
                    $tamanho .= "'$tamanho_pesq'";
                } else {
                    $tamanho .= ", '$tamanho_pesq'";
                }
                $controle++;
            }

            $tipo = "";
            $controle = 1;
            foreach ($dados["tipo"] as $tipo_pesq) {
                if ($controle == 1) {
                    $tipo .= "'$tipo_pesq'";
                } else {
                    $tipo .= ", '$tipo_pesq'";
                }
                $controle++;
            }

            if (isset($_POST['busca'])) {
                $busca = $_POST['busca'];
                $testebusca = explode(" ", $busca);
                $campo = $testebusca[0];

                if (!empty($testebusca[1])) {
                    $search = $testebusca[1];
                } else {
                    $search = "a";
                }
            }
            if (!empty($campo) && !empty($search)) {
                $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $count = $stmtCount->fetchColumn();
                $total_venda = $stmtPrecoV->fetchColumn();
                $total_pago = $stmtPrecoP->fetchColumn();
            } else {
                $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND tipo IN ($tipo) AND $campo");
                $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND tipo IN ($tipo) AND $campo");
                $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND tipo IN ($tipo) AND $campo");
                $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND tipo IN ($tipo) AND $campo");
                $count = $stmtCount->fetchColumn();
                $total_venda = $stmtPrecoV->fetchColumn();
                $total_pago = $stmtPrecoP->fetchColumn();
            }

            // -------------------------filtro tipo comp --------------------
        } else if (isset($_POST['tipo']) && isset($_POST['comp'])) {
            $comp = "";
            $controle = 1;
            foreach ($dados["comp"] as $comp_pesq) {
                if ($controle == 1) {
                    $comp .= "'$comp_pesq'";
                } else {
                    $comp .= ", '$comp_pesq'";
                }
                $controle++;
            }

            $tipo = "";
            $controle = 1;
            foreach ($dados["tipo"] as $tipo_pesq) {
                if ($controle == 1) {
                    $tipo .= "'$tipo_pesq'";
                } else {
                    $tipo .= ", '$tipo_pesq'";
                }
                $controle++;
            }

            if (isset($_POST['busca'])) {
                $busca = $_POST['busca'];
                $testebusca = explode(" ", $busca);
                $campo = $testebusca[0];

                if (!empty($testebusca[1])) {
                    $search = $testebusca[1];
                } else {
                    $search = "a";
                }
            }
            if (!empty($campo) && !empty($search)) {
                $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp) AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp) AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp) AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp) AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $count = $stmtCount->fetchColumn();
                $total_venda = $stmtPrecoV->fetchColumn();
                $total_pago = $stmtPrecoP->fetchColumn();
            } else {
                $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp) AND tipo IN ($tipo)");
                $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp) AND tipo IN ($tipo)");
                $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp) AND tipo IN ($tipo)");
                $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp) AND tipo IN ($tipo)");
                $count = $stmtCount->fetchColumn();
                $total_venda = $stmtPrecoV->fetchColumn();
                $total_pago = $stmtPrecoP->fetchColumn();
            }

            // ------------------------- filtro tamanho ---------------------------
        } else if (isset($_POST['tamanho'])) {
            $tamanho = "";
            $controle = 1;
            foreach ($dados["tamanho"] as $tamanho_pesq) {
                if ($controle == 1) {
                    $tamanho .= "'$tamanho_pesq'";
                } else {
                    $tamanho .= ", '$tamanho_pesq'";
                }
                $controle++;
            }

            if (isset($_POST['busca'])) {
                $busca = $_POST['busca'];
                $testebusca = explode(" ", $busca);
                $campo = $testebusca[0];

                if (!empty($testebusca[1])) {
                    $search = $testebusca[1];
                } else {
                    $search = "a";
                }
            }

            if (!empty($campo) && !empty($search)) {
                $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND $campo LIKE '%$search%'");
                $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND $campo LIKE '%$search%'");
                $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND $campo LIKE '%$search%'");
                $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho) AND $campo LIKE '%$search%'");
                $count = $stmtCount->fetchColumn();
                $total_venda = $stmtPrecoV->fetchColumn();
                $total_pago = $stmtPrecoP->fetchColumn();
            } else {
                $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho)");
                $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho)");
                $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho)");
                $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND tamanho IN ($tamanho)");
                $count = $stmtCount->fetchColumn();
                $total_venda = $stmtPrecoV->fetchColumn();
                $total_pago = $stmtPrecoP->fetchColumn();
            }

            // ------------------------- filtro comprimento -------------------
        } else if (isset($_POST['comp'])) {
            $comp = "";
            $controle = 1;
            foreach ($dados["comp"] as $comp_pesq) {
                if ($controle == 1) {
                    $comp .= "'$comp_pesq'";
                } else {
                    $comp .= ", '$comp_pesq'";
                }
                $controle++;
            }

            if (isset($_POST['busca'])) {
                $busca = $_POST['busca'];
                $testebusca = explode(" ", $busca);
                $campo = $testebusca[0];

                if (!empty($testebusca[1])) {
                    $search = $testebusca[1];
                } else {
                    $search = "a";
                }
            }

            if (!empty($campo) && !empty($search)) {
                $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp) AND $campo LIKE '%$search%'");
                $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp) AND $campo LIKE '%$search%'");
                $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp) AND $campo LIKE '%$search%'");
                $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp) AND $campo LIKE '%$search%'");
                $count = $stmtCount->fetchColumn();
                $total_venda = $stmtPrecoV->fetchColumn();
                $total_pago = $stmtPrecoP->fetchColumn();
            } else {
                $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp)");
                $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp)");
                $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp)");
                $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND comprimento IN ($comp)");
                $count = $stmtCount->fetchColumn();
                $total_venda = $stmtPrecoV->fetchColumn();
                $total_pago = $stmtPrecoP->fetchColumn();
            }

            //-------------------------------------- filtro tipo --------------------------------
        } else if (isset($_POST['tipo'])) {
            $tipo = "";
            $controle = 1;
            foreach ($dados["tipo"] as $tipo_pesq) {
                if ($controle == 1) {
                    $tipo .= "'$tipo_pesq'";
                } else {
                    $tipo .= ", '$tipo_pesq'";
                }
                $controle++;
            }

            if (isset($_POST['busca'])) {
                $busca = $_POST['busca'];
                $testebusca = explode(" ", $busca);
                $campo = $testebusca[0];

                if (!empty($testebusca[1])) {
                    $search = $testebusca[1];
                } else {
                    $search = "a";
                }
            }

            if (!empty($campo) && !empty($search)) {
                $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND tipo IN ($tipo) AND $campo LIKE '%$search%'");
                $count = $stmtCount->fetchColumn();
                $total_venda = $stmtPrecoV->fetchColumn();
                $total_pago = $stmtPrecoP->fetchColumn();
            } else {
                $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND tipo IN ($tipo)");
                $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND tipo IN ($tipo)");
                $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND tipo IN ($tipo)");
                $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND tipo IN ($tipo)");
                $count = $stmtCount->fetchColumn();
                $total_venda = $stmtPrecoV->fetchColumn();
                $total_pago = $stmtPrecoP->fetchColumn();
            }
        } else if (isset($_POST['busca'])) {
            $busca = $_POST['busca'];
            $testebusca = explode(" ", $busca);
            $campo = $testebusca[0];

            if (!empty($testebusca[1])) {
                $search = $testebusca[1];
            } else {
                $search = "a";
            }
            $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque' AND $campo LIKE '%$search%'");
            $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque' AND $campo LIKE '%$search%'");
            $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque' AND $campo LIKE '%$search%'");
            $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque' AND $campo LIKE '%$search%'");
            $count = $stmtCount->fetchColumn();
            $total_venda = $stmtPrecoV->fetchColumn();
            $total_pago = $stmtPrecoP->fetchColumn();

            // ------------------------- sem filtro --------------------
        } else {
            $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque'");
            $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque'");
            $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque'");
            $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque'");
            $count = $stmtCount->fetchColumn();
            $total_venda = $stmtPrecoV->fetchColumn();
            $total_pago = $stmtPrecoP->fetchColumn();
        }


        while ($instrucao = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $instrucao['id'];
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
            $testedata = explode("-", $data_comp);
            $data_comp = "$testedata[2]/$testedata[1]/$testedata[0]";

            $data_vend = $instrucao['data_venda'];
            $testedata = explode("-", $data_vend);
            $data_vend = "$testedata[2]/$testedata[1]/$testedata[0]";


            //<-----------------Escrita dos Valores----------------->

            $valor_custo = $instrucao['valor_custo'];
            $testepreco = explode(".", $valor_custo);
            $valor_custo = "R$ $testepreco[0],$testepreco[1]";

            $valor_cheio = $instrucao['valor_cheio'];
            $testepreco = explode(".", $valor_cheio);
            $valor_cheio = "R$ $testepreco[0],$testepreco[1]";

            $valor_pago = $instrucao['valor_pago'];
            $testepreco = explode(".", $valor_pago);
            $valor_pago = "R$ $testepreco[0],$testepreco[1]";

            $valor_vista = $instrucao['valor_vista'];
            $testepreco = explode(".", $valor_vista);
            $valor_vista = "R$ $testepreco[0],$testepreco[1]";

            $valor_venda = $instrucao['valor_venda'];
            $testepreco = explode(".", $valor_venda);
            $valor_venda = "R$ $testepreco[0],$testepreco[1]";

            $valor_prazo = $instrucao['valor_prazo'];
            $testepreco = explode(".", $valor_prazo);
            $valor_prazo = "R$ $testepreco[0],$testepreco[1]";

            //<-----------------Escrita das Medidas----------------->

            $med_ombro = $instrucao['med_ombro'];
            if (isset($med_ombro)) {
                $testepreco = explode(".", $med_ombro);
                $med_ombro = "$testepreco[0],$testepreco[1]cm";
            } else {
                $med_ombro = " ";
            }

            $med_busto = $instrucao['med_busto'];
            if (isset($med_busto)) {
                $testepreco = explode(".", $med_busto);
                $med_busto = "$testepreco[0],$testepreco[1]cm";
            } else {
                $med_busto = " ";
            }

            $med_cintura = $instrucao['med_cintura'];
            if (isset($med_cintura)) {
                $testepreco = explode(".", $med_cintura);
                $med_cintura = "$testepreco[0],$testepreco[1]cm";
            } else {
                $med_cintura = " ";
            }

            $med_quadril = $instrucao['med_quadril'];
            if (isset($med_quadril)) {
                $testepreco = explode(".", $med_quadril);
                $med_quadril = "$testepreco[0],$testepreco[1]cm";
            } else {
                $med_quadril = " ";
            }

            // Imagens

            $stmt2 = $con->query("SELECT * FROM imagens WHERE id_peca = '$cod'");
            while ($instrucao2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {

                $caminho = $instrucao2['caminho'];
            }

?>

            <div class='card'>
                <div class="edit">
                    <a href="tela_update_info.php?cod=<?php echo $cod; ?>&tamanho=<?php echo $tamanho; ?>&tipo=<?php echo $tipo; ?>&comp=<?php echo $comprimento; ?>&link=estoque">
                        <p>Editar</p>
                    </a>
                    <img src="imagens/edit_image.png">
                </div>
                <div class="img">
                    <img id="img-roupa" src="<?php echo $caminho; ?>"></img>
                </div>

                <div class="info">
                    <p style="text-align: center"><?php echo $tipo; ?></p>
                    <p>Tamanho: <b><?php echo $tamanho; ?></b></p>
                    <p>Valor de venda: <b><?php echo $valor_venda; ?></b></p>
                    <p>Cor: <b><?php echo ucfirst($cor); ?></b></p>

                    <details>
                        <summary>Informações Gerais</summary>
                        <p>Código: <b><?php echo $cod; ?></b></p>
                        <p>Marca: <b><?php echo ucfirst($marca); ?></b></p>
                        <p>Medida ombro: <b><?php echo $med_ombro; ?></b></p>
                        <p>Medida busto: <b><?php echo $med_busto; ?></b></p>
                        <p>Medida cintura: <b><?php echo $med_cintura; ?></b></p>
                        <p>Medida quadril: <b><?php echo $med_quadril; ?></b></p>
                        <p>Comprimento: <b><?php echo $comprimento; ?></b></p>
                        <p>Descrição: <b><?php echo ucfirst($desc); ?></b></p>
                    </details>
                    <details id="det">
                        <summary>Informações de compra</summary>
                        <p>Forma de compra: <b><?php echo ucfirst($forma_compra); ?></b></p>
                        <p>Forma de venda: <b><?php echo $forma_venda; ?></b></p>
                        <p>Valor de custo: <b><?php echo $valor_custo; ?></b></p>
                        <p>Valor pago: <b><?php echo $valor_pago; ?></b></p>
                        <p>Valor cheio: <b><?php echo $valor_cheio; ?></b></p>
                        <p>Valor à vista: <b><?php echo $valor_vista; ?></b></p>
                        <p>Valor prazo: <b><?php echo $valor_prazo; ?></b></p>
                        <p>Desconto: <b><?php echo $desconto; ?></b></p>
                        <p>Data de compra: <b><?php echo $data_comp; ?></b></p>
                        <p>Data de venda: <b><?php echo $data_vend; ?></b></p>
                        <p>Parcelas: <b><?php echo $parce; ?></b></p>
                    </details>
                </div>
            </div>

        <?php
        }
    } catch (PDOException $e) {
        alerta("error", false, "Não foi possível achar nada");
        header("Refresh: 2");
    }
} else {
    $stmt = $con->query("SELECT * FROM pecas WHERE situacao = 'Estoque'");
    $stmtCount = $con->query("SELECT count(*) FROM pecas WHERE situacao = 'Estoque'");
    $stmtPrecoV = $con->query("SELECT SUM(valor_venda) FROM pecas WHERE situacao = 'Estoque'");
    $stmtPrecoP = $con->query("SELECT SUM(valor_pago) FROM pecas WHERE situacao = 'Estoque'");
    $count = $stmtCount->fetchColumn();
    $total_venda = $stmtPrecoV->fetchColumn();
    $total_pago = $stmtPrecoP->fetchColumn();

    while ($instrucao = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $instrucao['id'];
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
        $testedata = explode("-", $data_comp);
        $data_comp = "$testedata[2]/$testedata[1]/$testedata[0]";

        $data_vend = $instrucao['data_venda'];
        $testedata = explode("-", $data_vend);
        $data_vend = "$testedata[2]/$testedata[1]/$testedata[0]";


        //<-----------------Escrita dos Valores----------------->

        $valor_custo = $instrucao['valor_custo'];
        $testepreco = explode(".", $valor_custo);
        $valor_custo = "R$ $testepreco[0],$testepreco[1]";

        $valor_cheio = $instrucao['valor_cheio'];
        $testepreco = explode(".", $valor_cheio);
        $valor_cheio = "R$ $testepreco[0],$testepreco[1]";

        $valor_pago = $instrucao['valor_pago'];
        $testepreco = explode(".", $valor_pago);
        $valor_pago = "R$ $testepreco[0],$testepreco[1]";

        $valor_vista = $instrucao['valor_vista'];
        $testepreco = explode(".", $valor_vista);
        $valor_vista = "R$ $testepreco[0],$testepreco[1]";

        $valor_venda = $instrucao['valor_venda'];
        $testepreco = explode(".", $valor_venda);
        $valor_venda = "R$ $testepreco[0],$testepreco[1]";

        $valor_prazo = $instrucao['valor_prazo'];
        $testepreco = explode(".", $valor_prazo);
        $valor_prazo = "R$ $testepreco[0],$testepreco[1]";

        //<-----------------Escrita das Medidas----------------->

        $med_ombro = $instrucao['med_ombro'];
        if (isset($med_ombro)) {
            $testepreco = explode(".", $med_ombro);
            $med_ombro = "$testepreco[0],$testepreco[1]cm";
        } else {
            $med_ombro = " ";
        }

        $med_busto = $instrucao['med_busto'];
        if (isset($med_busto)) {
            $testepreco = explode(".", $med_busto);
            $med_busto = "$testepreco[0],$testepreco[1]cm";
        } else {
            $med_busto = " ";
        }

        $med_cintura = $instrucao['med_cintura'];
        if (isset($med_cintura)) {
            $testepreco = explode(".", $med_cintura);
            $med_cintura = "$testepreco[0],$testepreco[1]cm";
        } else {
            $med_cintura = " ";
        }

        $med_quadril = $instrucao['med_quadril'];
        if (isset($med_quadril)) {
            $testepreco = explode(".", $med_quadril);
            $med_quadril = "$testepreco[0],$testepreco[1]cm";
        } else {
            $med_quadril = " ";
        }

        // Imagens

        $stmt2 = $con->query("SELECT * FROM imagens WHERE id_peca = '$id'");
        while ($instrucao2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {

            $caminho = $instrucao2['caminho'];
        }
        ?>
        <div class='card'>
            <div class="edit">
                <a href="tela_update_info.php?cod=<?php echo $cod; ?>&tamanho=<?php echo $tamanho; ?>&tipo=<?php echo $tipo; ?>&comp=<?php echo $comprimento; ?>&link=estoque">
                    <p>Editar</p>
                </a>
                <img src="imagens/edit_image.png">
            </div>
            <div class="img">
                <img id="img-roupa" src="<?php echo $caminho; ?>"></img>
            </div>

            <div class="info">
                <p style="text-align: center"><?php echo $tipo; ?></p>
                <p>Tamanho: <b><?php echo $tamanho; ?></b></p>
                <p>Valor de venda: <b><?php echo $valor_venda; ?></b></p>
                <p>Cor: <b><?php echo ucfirst($cor); ?></b></p>

                <details>
                    <summary>Informações Gerais</summary>
                    <p>Código: <b><?php echo $cod; ?></b></p>
                    <p>Marca: <b><?php echo ucfirst($marca); ?></b></p>
                    <p>Medida ombro: <b><?php echo $med_ombro; ?></b></p>
                    <p>Medida busto: <b><?php echo $med_busto; ?></b></p>
                    <p>Medida cintura: <b><?php echo $med_cintura; ?></b></p>
                    <p>Medida quadril: <b><?php echo $med_quadril; ?></b></p>
                    <p>Comprimento: <b><?php echo $comprimento; ?></b></p>
                    <p>Descrição: <b><?php echo ucfirst($desc); ?></b></p>
                </details>
                <details id="det">
                    <summary>Informações de compra</summary>
                    <p>Forma de compra: <b><?php echo ucfirst($forma_compra); ?></b></p>
                    <p>Forma de venda: <b><?php echo $forma_venda; ?></b></p>
                    <p>Valor de custo: <b><?php echo $valor_custo; ?></b></p>
                    <p>Valor pago: <b><?php echo $valor_pago; ?></b></p>
                    <p>Valor cheio: <b><?php echo $valor_cheio; ?></b></p>
                    <p>Valor à vista: <b><?php echo $valor_vista; ?></b></p>
                    <p>Valor prazo: <b><?php echo $valor_prazo; ?></b></p>
                    <p>Desconto: <b><?php echo $desconto; ?></b></p>
                    <p>Data de compra: <b><?php echo $data_comp; ?></b></p>
                    <p>Data de venda: <b><?php echo $data_vend; ?></b></p>
                    <p>Parcelas: <b><?php echo $parce; ?></b></p>
                </details>
            </div>
        </div>

<?php
    }
}
?>