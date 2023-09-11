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
    <title>clientes</title>
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
    <table>
    <thead>
        <tr>
            <th class="conteudo">nome</th>
            <th class="conteudo">sobrenome</th>
            <th class="conteudo">cpf</th>
            <th class="conteudo">WhatsApp</th>
            <th class="acoes">acoes</th>
        </tr>
    </thead>
<?php 

if(!empty($_POST['pesquisa'])){

$pesquisa = $_POST['pesquisa'];

$sqlcode = "SELECT * FROM clientes WHERE nome  LIKE  '%$pesquisa%' ";
$sqlquery = $mysqli->query($sqlcode) or die ('erro durante select' . $mysqli->error);

if($sqlquery->num_rows == 0){
    ?>
    <tbody>
        <tr>
            <td colspan="6">nenhum resultado encontrado...</td>
        </tr>
    </tbody>
    <?php
}else {

    while($dados = $sqlquery->fetch_assoc()){
        ?>
            <tbody>
                <tr>
                    <td class="conteudo"><?php echo $dados['nome']; ?></td>
                    <td class="conteudo"><?php echo $dados['sobrenome']; ?></td>
                    <td class="conteudo"><?php echo $dados['cpf']; ?></td>
                    <td class="conteudo"><?php echo $dados['telefone']; ?></td>
                    <td class="acoes">
                        <a href="update_cliente.php?id=<?php echo $dados['id_cliente'];  ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" color="blue" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        </a>
                        <a class="acti" href="compras_cliente.php?id=<?php echo $dados['id_cliente'];  ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" color="blue" width="20" height="20" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
            </svg>
                        </a>
                        <a href="cadastro_compra.php?id=<?php echo $dados['id_cliente'];  ?>">
       <svg xmlns="http://www.w3.org/2000/svg" color="blue" width="20" height="20" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
        </svg>
       </a>
                    </td>
                </tr>
            
        <?php

    }

}



} else{

    $sqlcode2 = "SELECT * FROM clientes";
    $sql_query = $mysqli->query($sqlcode2) or die ('erro durante select' . $mysqli->error);

    while($dados2 = $sql_query->fetch_assoc()){
        ?>
        <tr>
        <td class="conteudo"><?php echo $dados2['nome']; ?></td>
        <td class="conteudo"><?php echo $dados2['sobrenome']; ?></td>
        <td class="conteudo"><?php echo $dados2['cpf']; ?></td>
        <td class="conteudo"><?php echo $dados2['telefone']; ?></td>
        <td class="acoes">
        <a href="update_cliente.php?id=<?php echo $dados2['id_cliente'];  ?>">
            <svg xmlns="http://www.w3.org/2000/svg" color="blue" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
             <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
           </svg>
       </a>
       <a href="compras_cliente.php?id=<?php echo $dados2['id_cliente'];  ?>">
       <svg xmlns="http://www.w3.org/2000/svg" color="blue" width="20" height="20" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
         <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
        </svg>
       </a>
       <a href="cadastro_compra.php?id=<?php echo $dados2['id_cliente'];  ?>">
       <svg xmlns="http://www.w3.org/2000/svg" color="blue" width="20" height="20" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
        </svg>
       </a>
        </td>
    </tr>
   
    <?php

    }

}

?>
 </tbody>
 </table>
</body>
</html>