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
    <title>estoque</title>
    <link rel="stylesheet" type="text/css" href="estilo_bar2.css">
	<link rel="stylesheet" type="text/css" href="estilo_botao_pesquisa.css">
    <link rel="stylesheet" type="text/css" href="estilo_tabelas.css">
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
	<br>
    <br>
    <br>

	<form method="post">
    <div class="input__container input__container--variant">
        <div class="shadow__input shadow__input--variant"></div>
        <input type="text" name="pesquisa" class="input__search input__search--variant" placeholder="Search...">
        <button class="input__button__shadow input__button__shadow--variant">
          <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" height="1.5em" width="13em">
            <path d="M4 9a5 5 0 1110 0A5 5 0 014 9zm5-7a7 7 0 104.2 12.6.999.999 0 00.093.107l3 3a1 1 0 001.414-1.414l-3-3a.999.999 0 00-.107-.093A7 7 0 009 2z" fill-rule="evenodd" fill="#FFF"></path>
          </svg>
        </button>
      </div>
    </form>
    <br>
    <br>
    <table border="3px" width="800px">
    <thead>
    <tr>
        <th class="conteudo">codigo produto</th>
        <th class="conteudo">quantidade</th>
        <th class="conteudo">descicao</th>
        <th class="conteudo">custo</th>
        <th class="conteudo">valor de venda</th>
    </tr>
    </thead>

<?php 

if(!empty($_POST['pesquisa'])){

$pesquisa = $_POST['pesquisa'];

$sqlcode = "SELECT * FROM estoque WHERE descricao  LIKE  '%$pesquisa%' ";
$sqlquery = $mysqli->query($sqlcode) or die ('erro durante select' . $mysqli->error);

if($sqlquery->num_rows == 0){
    ?>
    
    <tr>
        <td colspan="6">nenhum resultado encontrado...</td>
    </tr>
    <?php
}else {

    while($dados = $sqlquery->fetch_assoc()){
        ?>
            <tbody>
                <tr>
                    <td class="conteudo"><?php echo $dados['id_produto']; ?></td>
                    <td class="conteudo"><?php echo $dados['quantidade']; ?></td>
                    <td class="conteudo"><?php echo $dados['descricao']; ?></td>
                    <td class="conteudo"><?php echo $dados['preco_compra']; ?></td>
                    <td class="conteudo"><?php echo $dados['preco_venda']; ?></td>
                </tr>
            </tbody>
        <?php

    }

}



} else{

    $sqlcode2 = "SELECT * FROM estoque";
    $sql_query = $mysqli->query($sqlcode2) or die ('erro durante select' . $mysqli->error);

    while($dados2 = $sql_query->fetch_assoc()){
        ?>
        <tbody>
        <tr>
        <td class="conteudo"><?php echo $dados2['id_produto']; ?></td>
        <td class="conteudo"><?php echo $dados2['quantidade']; ?></td>
        <td class="conteudo"><?php echo $dados2['descricao']; ?></td>
        <td class="conteudo"><?php echo $dados2['preco_compra']; ?></td>
        <td class="conteudo"><?php echo $dados2['preco_venda']; ?></td>
    </tr>
        </tbody>
    <?php

    }

}

?>
 </table>
</body>
</html>