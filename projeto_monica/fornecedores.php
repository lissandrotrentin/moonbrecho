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
    <title>fornecedores</title>
    <link rel="stylesheet" type="text/css" href="estilo_bar2.css">
    <link rel="stylesheet" type="text/css" href="estilo_tabelas.css">
    <style>
        body{
    background-color: rgb(169, 177, 177);
  }
    </style>
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
        <table>
          <thead>
            <tr>
              <th class="conteudo">nome</th>
              <th class="conteudo">empresa</th>
              <th class="conteudo">telefone</th>
              <th class="acoes">produtos</th>
            </tr>
          </thead>

<?php 

$sqlcode = "SELECT * FROM fornecedores";
$sqlquery = $mysqli->query($sqlcode);
while($dados = $sqlquery->fetch_assoc()){
  ?>
  <tbody>
    <tr>
      <td class="conteudo"><?php echo $dados['nome_fornecedor']; ?></td>
      <td class="conteudo"><?php echo $dados['nome_empresa']; ?></td>
      <td class="conteudo"><?php echo $dados['telefone']; ?></td>
      <td class="acoes"><a href="consignado_forne.php?id=<?php echo $dados['id_fornecedor']; ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
</svg></a>
<a href="cad_consignado.php?id=<?php echo $dados['id_fornecedor']; ?>">
  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
  <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
</svg></a></td>
    </tr>
  </tbody>
  <?php

}

  
?>


</table>
</body>
</html>