<?php 

require_once('conex.php');

include('protect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vendas</title>
    <link rel="stylesheet" type="text/css" href="estilo_bar2.css">
    <link rel="stylesheet" type="text/css" href="est_tab_inli_fe.css">
    <link rel="stylesheet" type="text/css" href="estilo_bar_fechamento.css">
</head>
<body>
<nav>
		<ul>
			<li class="li">
				<a class="a" href="cadastro_c.php">cadastro</a>
			</li>
			<li class="li">
				<a class="a" href="select_cliente.php">clientes</a>
			</li>
			<li class="li">
				<a class="a" href="select_vendas.php">vendas</a>
			</li>
			<li class="li">
				<a class="a" href="estoque.php">estoque</a>
			</li>
            <li class="li">
				<a class="a" href="fornecedores.php">fornecedores</a>
			</li>
            <li class="li">
				<a class="a" href="fechamento_mes.php">fechamento</a>
			</li>
		</ul>
	</nav>
    <nav class="nav2">
		<ul>
			<li class="li">
				<a class="a" href="fechamento_mes.php">esse mes</a>
			</li>
			<li class="li">
				<a class="a" href="fechamento_geral.php">geral</a>
			</li>
		</ul>
	</nav>

<?php 

$sqlcode = "SELECT e.mes as mes_e, c.mes as mes_c, e.valor_custo_t AS valor_c_e, e.valor_venda_t AS valor_v_e, e.valor_lucro_t AS valor_l_e,
        c.valor_custo_t AS valor_c_c, c.valor_venda_t AS valor_v_c, c.valor_lucro_t AS valor_l_c
        FROM fechamentos_consig c, fechamentos e WHERE c.id = e.id";
$sqlquery = $mysqli->query($sqlcode);
while($dados = $sqlquery->fetch_assoc()){
    $mes = $dados['mes_e'];
    $valor_c_e = $dados['valor_c_e'];
    $valor_v_e = $dados['valor_v_e'];
    $valor_l_e = $dados['valor_l_e'];
    // consignados var
    $valor_c_c = $dados['valor_c_c'];
    $valor_v_c = $dados['valor_v_c'];
    $valor_l_c = $dados['valor_l_c'];

    ?>
    <br>
    <table  class="tabela">
     <thead>
            <tr>
                <th colspan="3" class="acoes"><?php echo "mes $mes"; ?></th>
            </tr>
            <tr>
                <th class="conteudo">valor custo total</th>
                <th class="conteudo">valor venda total</th>
                <th class="conteudo">valor liquido total</th>
            </tr>
    </thead>
    <tbody>
        <tr>
            <td class="conteudo"><?php echo $valor_c_e; ?></td>
            <td class="conteudo"><?php echo $valor_v_e; ?></td>
            <td class="conteudo"><?php echo $valor_l_e; ?></td>
        </tr>
        <tr>
            <th colspan="3" class="acoes">consignados</th>
        </tr>
        <tr>
            <td class="conteudo"><?php echo $valor_c_c; ?></td>
            <td class="conteudo"><?php echo $valor_v_c; ?></td>
            <td class="conteudo"><?php echo $valor_l_c; ?></td>
        </tr>
    </tbody>
    </table>
    

    <?php
}

?>


</body>
</html>