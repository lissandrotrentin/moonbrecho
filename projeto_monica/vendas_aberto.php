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
    <link rel="stylesheet" type="text/css" href="estilo_botao_pesquisa.css">
    <link rel="stylesheet" type="text/css" href="estilo_tabelas.css">
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
				<a class="a" href="select_vendas.php">fechado</a>
			</li>
			<li class="li">
				<a class="a" href="vendas_aberto.php">aberto</a>
			</li>
		</ul>
	</nav>

  
    <br>
    <br>
    <h1>meu estoque</h1>
    <table>
        <thead>
            <tr>
                <th class="conteudo">cliente</th>
                <th class="conteudo">descricao</th>
                <th class="conteudo">custo</th>
				<th class="conteudo">valor pago</th>
                <th class="conteudo">venda</th>
                <th class="conteudo">lucro</th>
                <th class="conteudo">data</th>
				<th class="conteudo">acao</th>
            </tr>
        </thead>
<?php 

 
    $sqlcode = "SELECT c.id_cliente,v.id_produto,v.id_venda, c.nome, v.descricao, v.preco_compra, v.valor_pago, v.preco_venda, v.data_venda
    FROM vendas_aberto v, clientes c where c.id_cliente = v.id_cliente";
    $sqlquery = $mysqli->query($sqlcode) or die ('erro durante select' . $mysqli->error);
    while($dados = $sqlquery->fetch_assoc()){

        $custo = $dados['preco_compra'];
        $venda = $dados['preco_venda'];
		$pago = $dados['valor_pago'];
    
        $formatc = number_format("$custo",2,",","." );
        $formatv = number_format("$venda",2,",","." );
		$formatp = number_format("$pago",2,",","." );
    
        $lucro = $venda - $custo  ;
    
        $formatl = number_format("$lucro",2,",","." );
    
       
    
        ?>
        <tbody>
        <Tr>
            <td class="conteudo"><?php echo $dados['nome']; ?></td>
            <td class="conteudo"><?php echo $dados['descricao']; ?></td>
            <td class="conteudo"><?php echo $formatc; ?> R$</td>
			<td class="conteudo"><?php echo $formatp; ?> R$</td>
            <td class="conteudo"><?php echo $formatv; ?> R$</td>
            <td class="conteudo"><?php echo $formatl; ?> R$</td>
            <td class="conteudo"><?php echo $dados['data_venda']; ?></td>
			<td class="acoes">
                        <a href="atualiza_valor.php?id=<?php echo $dados['id_venda']; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" color="blue" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
            </a>
            </td>
        </Tr>
        <?php
    }
        $sqlcodec = "SELECT SUM(preco_compra) AS custot FROM vendas_aberto";
        $sqlqueryc = $mysqli->query($sqlcodec);
        while($dadosc = $sqlqueryc->fetch_assoc()){
            $custot = $dadosc['custot'];
        }
		$sqlcodep = "SELECT SUM(valor_pago) AS pagot FROM vendas_aberto";
        $sqlqueryp = $mysqli->query($sqlcodep);
        while($dadosp = $sqlqueryp->fetch_assoc()){
            $pagot = $dadosp['pagot'];
        }
        $sqlcodev = "SELECT SUM(preco_venda) AS vendat FROM vendas_aberto";
        $sqlqueryv = $mysqli->query($sqlcodev);
        while($dadosv = $sqlqueryv->fetch_assoc()){
            $vendat = $dadosv['vendat'];
        }
        $sqlcodel = "SELECT SUM(preco_venda - preco_compra) AS lucrot FROM vendas_aberto";
        $sqlqueryl = $mysqli->query($sqlcodel);
        while($dadosl = $sqlqueryl->fetch_assoc()){
            $lucrot = $dadosl['lucrot'];
        }

        if(isset($custot)){

        $format_c_t = number_format("$custot", 2, ",", ".");
        $format_v_t = number_format("$vendat",2, ",", ".");
        $format_l_t = number_format("$lucrot",2,",",".");
		$format_p_t = number_format("$pagot",2,",",".");

        ?> 
        <tr>
            <td colspan="8">.</td>
        </tr>
        <tr>
            <td colspan="2">total</td>
            <td class="conteudo"><?php echo $format_c_t; ?> R$</td>
			<td class="conteudo"><?php echo $format_p_t; ?> R$</td>
            <td class="conteudo"><?php echo $format_v_t; ?> R$</td>
            <td class="conteudo"><?php echo $format_l_t; ?> R$</td>
            <td class="conteudo"></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <br>
    <h1>consignados</h1>
    <table>
        <thead>
            <tr>
                <th class="conteudo">cliente</th>
                <th class="conteudo">fornecedor</th>
                <th class="conteudo">descricao</th>
                <th class="conteudo">custo</th>
				<th class="conteudo">pagamento</th>
                <th class="conteudo">venda</th>
                <th class="conteudo">lucro</th>
                <th class="conteudo">data</th>
                <th class="conteudo">acao</th>

            </tr>
        </thead>
<?php 

 
    $sqlcodeco = "SELECT c.id_cliente,co.id_venda, c.nome,f.nome_fornecedor,  co.descricao, co.preco_compra, co.valor_pago, co.preco_venda, co.data_venda
    FROM vendas_aberto_consig co, clientes c, fornecedores f where c.id_cliente = co.id_cliente 
    and f.id_fornecedor = co.id_fornecedor";
    $sqlqueryco = $mysqli->query($sqlcodeco) or die ('erro durante select' . $mysqli->error);
    while($dadosco = $sqlqueryco->fetch_assoc()){

        $custoco = $dadosco['preco_compra'];
        $vendaco =$dadosco['preco_venda'];
		$pagoco =$dadosco['valor_pago'];
    
        $formatcco = number_format("$custoco",2,",","." );
        $formatvco = number_format("$vendaco",2,",","." );
		$formatpco = number_format("$pagoco",2,",","." );
    
        $lucroco = $vendaco - $custoco  ;
    
        $formatlco = number_format("$lucroco",2,",","." );
    
       
    
        ?>
        <tbody>
        <Tr>
            <td class="conteudo"><?php echo $dadosco['nome']; ?></td>
            <td class="conteudo"><?php echo $dadosco['nome_fornecedor']; ?></td>
            <td class="conteudo"><?php echo $dadosco['descricao']; ?></td>
            <td class="conteudo"><?php echo $formatcco; ?> R$</td>
			<td class="conteudo"><?php echo $formatpco; ?> R$</td>
            <td class="conteudo"><?php echo $formatvco; ?> R$</td>
            <td class="conteudo"><?php echo $formatlco; ?> R$</td>
            <td class="conteudo"><?php echo $dadosco['data_venda']; ?></td>
            <td class="acoes">
                        <a href="atualiza_valor_co.php?id=<?php echo $dadosco['id_venda']; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" color="blue" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
            </a>
            </td>
        </Tr>
        <?php
    }
        $sqlcodecco = "SELECT SUM(preco_compra) AS custotco FROM vendas_aberto_consig";
        $sqlquerycco = $mysqli->query($sqlcodecco);
        while($dadoscco = $sqlquerycco->fetch_assoc()){
            $custotco = $dadoscco['custotco'];
        }
		$sqlcodepco = "SELECT SUM(valor_pago) AS pagotco FROM vendas_aberto_consig";
        $sqlquerypco = $mysqli->query($sqlcodepco);
        while($dadospco = $sqlquerypco->fetch_assoc()){
            $pagotco = $dadospco['pagotco'];
        }
        $sqlcodevco = "SELECT SUM(preco_venda) AS vendatco FROM vendas_aberto_consig";
        $sqlqueryvco = $mysqli->query($sqlcodevco);
        while($dadosvco = $sqlqueryvco->fetch_assoc()){
            $vendatco = $dadosvco['vendatco'];
        }
        $sqlcodelco = "SELECT SUM(preco_venda - preco_compra) AS lucrotco FROM vendas_aberto_consig";
        $sqlquerylco = $mysqli->query($sqlcodelco);
        while($dadoslco = $sqlquerylco->fetch_assoc()){
            $lucrotco = $dadoslco['lucrotco'];
        }

        if(isset($custotco)){

        $format_c_t_co = number_format("$custotco", 2, ",", ".");
        $format_v_t_co = number_format("$vendatco",2, ",", ".");
        $format_l_t_co = number_format("$lucrotco",2,",",".");
		$format_p_t_co = number_format("$pagotco",2,",",".");

        ?> 
        <tr>
            <td colspan="9">.</td>
        </tr>
        <tr>
            <td colspan="3">valor total</td>
            <td class="conteudo"><?php echo $format_c_t_co; ?> R$</td>
			<td class="conteudo"><?php echo $format_p_t_co; ?> R$</td>
            <td class="conteudo"><?php echo $format_v_t_co; ?> R$</td>
            <td class="conteudo"><?php echo $format_l_t_co; ?> R$</td>
            <td class="conteudo"></td>
        </tr>
        <?php } ?>
        </tbody>

    </table>
    <br>
</body>
</html>