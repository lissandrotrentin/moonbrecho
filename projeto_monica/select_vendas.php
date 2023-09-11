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
                <th class="conteudo">venda</th>
                <th class="conteudo">lucro</th>
                <th class="conteudo">data</th>
            </tr>
        </thead>
<?php 

 
    $sqlcode = "SELECT c.id_cliente, c.nome, v.descricao, v.preco_compra, v.preco_venda, v.data_venda
    FROM vendas v, clientes c where c.id_cliente = v.id_cliente";
    $sqlquery = $mysqli->query($sqlcode) or die ('erro durante select' . $mysqli->error);
    while($dados = $sqlquery->fetch_assoc()){

        $custo = $dados['preco_compra'];
        $venda =$dados['preco_venda'];
    
        $formatc = number_format("$custo",2,",","." );
        $formatv = number_format("$venda",2,",","." );
    
        $lucro = $venda - $custo  ;
    
        $formatl = number_format("$lucro",2,",","." );
    
       
    
        ?>
        <tbody>
        <Tr>
            <td class="conteudo"><?php echo $dados['nome']; ?></td>
            <td class="conteudo"><?php echo $dados['descricao']; ?></td>
            <td class="conteudo"><?php echo $formatc; ?> R$</td>
            <td class="conteudo"><?php echo $formatv; ?> R$</td>
            <td class="conteudo"><?php echo $formatl; ?> R$</td>
            <td class="conteudo"><?php echo $dados['data_venda']; ?></td>
            
        </Tr>
        <?php
    }
        $sqlcodec = "SELECT SUM(preco_compra) AS custot FROM vendas";
        $sqlqueryc = $mysqli->query($sqlcodec);
        while($dadosc = $sqlqueryc->fetch_assoc()){
            $custot = $dadosc['custot'];
        }
        $sqlcodev = "SELECT SUM(preco_venda) AS vendat FROM vendas";
        $sqlqueryv = $mysqli->query($sqlcodev);
        while($dadosv = $sqlqueryv->fetch_assoc()){
            $vendat = $dadosv['vendat'];
        }
        $sqlcodel = "SELECT SUM(preco_venda - preco_compra) AS lucrot FROM vendas";
        $sqlqueryl = $mysqli->query($sqlcodel);
        while($dadosl = $sqlqueryl->fetch_assoc()){
            $lucrot = $dadosl['lucrot'];
        }

        if(isset($custot)){

        $format_c_t = number_format("$custot", 2, ",", ".");
        $format_v_t = number_format("$vendat",2, ",", ".");
        $format_l_t = number_format("$lucrot",2,",",".");


        ?> 
        <tr>
            <td colspan="6">.</td>
        </tr>
        <tr>
            <td colspan="2">valor total</td>
            <td class="conteudo"><?php echo $format_c_t; ?> R$</td>
            <td class="conteudo"><?php echo $format_v_t; ?> R$</td>
            <td class="conteudo"><?php echo $format_l_t; ?> R$</td>
            <td class="conteudo"></td>
        </tr>
        <?php  } ?>
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
                <th class="conteudo">venda</th>
                <th class="conteudo">lucro</th>
                <th class="conteudo">data</th>
            </tr>
        </thead>
<?php 

 
    $sqlcodeco = "SELECT c.id_cliente, c.nome,f.nome_fornecedor,  co.descricao, co.preco_compra, co.preco_venda, co.data_venda
    FROM vendas_consignados co, clientes c, fornecedores f where c.id_cliente = co.id_cliente 
    and f.id_fornecedor = co.id_fornecedor";
    $sqlqueryco = $mysqli->query($sqlcodeco) or die ('erro durante select' . $mysqli->error);
    while($dadosco = $sqlqueryco->fetch_assoc()){

        $custoco = $dadosco['preco_compra'];
        $vendaco =$dadosco['preco_venda'];
    
        $formatcco = number_format("$custoco",2,",","." );
        $formatvco = number_format("$vendaco",2,",","." );
    
        $lucroco = $vendaco - $custoco  ;
    
        $formatlco = number_format("$lucroco",2,",","." );
    
       
    
        ?>
        <tbody>
        <Tr>
            <td class="conteudo"><?php echo $dadosco['nome']; ?></td>
            <td class="conteudo"><?php echo $dadosco['nome_fornecedor']; ?></td>
            <td class="conteudo"><?php echo $dadosco['descricao']; ?></td>
            <td class="conteudo"><?php echo $formatcco; ?> R$</td>
            <td class="conteudo"><?php echo $formatvco; ?> R$</td>
            <td class="conteudo"><?php echo $formatlco; ?> R$</td>
            <td class="conteudo"><?php echo $dadosco['data_venda']; ?></td>
            
        </Tr>
        <?php
    }
        $sqlcodecco = "SELECT SUM(preco_compra) AS custotco FROM vendas_consignados";
        $sqlquerycco = $mysqli->query($sqlcodecco);
        while($dadoscco = $sqlquerycco->fetch_assoc()){
            $custotco = $dadoscco['custotco'];
        }
        $sqlcodevco = "SELECT SUM(preco_venda) AS vendatco FROM vendas_consignados";
        $sqlqueryvco = $mysqli->query($sqlcodevco);
        while($dadosvco = $sqlqueryvco->fetch_assoc()){
            $vendatco = $dadosvco['vendatco'];
        }
        $sqlcodelco = "SELECT SUM(preco_venda - preco_compra) AS lucrotco FROM vendas_consignados";
        $sqlquerylco = $mysqli->query($sqlcodelco);
        while($dadoslco = $sqlquerylco->fetch_assoc()){
            $lucrotco = $dadoslco['lucrotco'];
        }

        if(isset($custotco)){

        $format_c_t_co = number_format("$custotco", 2, ",", ".");
        $format_v_t_co = number_format("$vendatco",2, ",", ".");
        $format_l_t_co = number_format("$lucrotco",2,",",".");

        ?> 
        <tr>
            <td colspan="7">.</td>
        </tr>
        <tr>
            <td colspan="3">valor total</td>
            <td class="conteudo"><?php echo $format_c_t_co; ?> R$</td>
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