<?php 

require_once('conex.php');

include('protect.php');

if(isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['cpf']) && isset($_POST['telefone'])){
    if(strlen($_POST['nome']) == 0){
        echo "ensira um nome";
    } else if(strlen($_POST['sobrenome']) == 0){
        echo "ensira um sobrenome";
    } else if(strlen($_POST['telefone']) == 0){
        echo "ensira o WhatsApp";
    } else{

        $nome      = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $cpf       = $_POST['cpf'];
        $telefone  = $_POST['telefone'];

        $sqlcode = "INSERT INTO clientes (nome, sobrenome, cpf, telefone) VALUES ('$nome','$sobrenome','$cpf','$telefone') ";
        if(!$sqlquery = $mysqli->query($sqlcode)){
            die ('erro durante o cadastro');
        } else{
            echo "dados inseridos";
        }

    }
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>painel</title>
    <link rel="stylesheet" type="text/css" href="estilo_cadastros.css">
    <link rel="stylesheet" type="text/css" href="estilo_bar2.css">
    <link rel="stylesheet" type="text/css" href="estilo_cadastro_estoque.css">
    <link rel="stylesheet" type="text/css" href="estilo_botao_cadastro.css">

    <style>
      div#div1{
			
			width: 200px;
			height:  50px;
			margin-top: 20px;
			margin-left: 100px;

			
		}
    div#div3{
			width: 200px;
			height:  50px;
			margin-top: 20px;
			margin-left: 300px;
			
		}

    div#div5{
			width: 200px;
			height:  50px;
			margin-top: 20px;
			margin-left: 300px;
			
		}
    .aline{
      display: inline-block;
    }

    .logo{
      margin-left: 200px;
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

  <div class="aline" id="div1" onclick="clicar1()"><button> clientes
</button></div>
  <div class="aline" id="div3" onclick="clicar2()"><button> produtos
</button></div>
<div class="aline" id="div5" onclick="clicar3()"><button> fornecedores
</button></div>
	<br>
<div class="aline11">
<div id="div2" class="card">
  <div class="card-header">
    <div class="text-header">Cadastro cliente</div>
  </div>
  <div class="card-body">
    <form action="" method="post">
      <div class="form-group">
        <label>primeiro nome:</label>
        <input required="" class="form-control" name="nome" type="text">
      </div>
      <div class="form-group">
        <label>sobrenome:</label>
        <input required="" class="form-control" name="sobrenome" type="text">
      </div>
      <div class="form-group">
        <label>cpf:</label>
        <input required="" class="form-control" name="cpf" type="int">
      </div>
      <div class="form-group">
        <label>telefone:</label>
        <input required="" class="form-control" name="telefone" type="int">
      </div><br>
     <button class="btn" type="submit">cadastrar</form>
  </div>
  </div>

</div>


    <br>
    <a href="logout.php">sair</a> <br>

    
    <?php
    $msg = "";

if(isset($_POST['descricao']) && isset($_POST['quantidade']) && isset($_POST['preco_compra']) && isset($_POST['preco_venda'])){
      if(strlen($_POST['descricao']) == 0){
        echo "!ensira a descricao";
    } else if(strlen($_POST['quantidade']) == 0){
      echo "ensira a quantidade";
    }  else if(strlen($_POST['preco_compra']) == 0){
       echo "ensira o valor de custo";
    } else if(strlen($_POST['preco_venda']) == 0){
        echo  "ensira o valor de venda";
    } else{

        $quantidade = $_POST['quantidade'];
        $descricao = $_POST['descricao'];
        $preco_compra = $_POST['preco_compra'];
        $preco_venda = $_POST['preco_venda'];
        $sqlcode = "INSERT INTO estoque VALUES('null','$descricao','$preco_compra','$preco_venda', '$quantidade')";
        $sqlquery = $mysqli->query($sqlcode) or die ("error ao cadastrar dados" . $mysqli->error);
        echo "dados inseridos";
    } 
    
} 



?>

<div class="card" id="div4">
<p class="p"><?php echo $msg;?></p>
  <span class="title">Cadastro de produto</span>
  <form class="form" method="post">
<div class="group">
    <input placeholder="" type="text" id="" name="descricao" >
    <label>descricao</label>
    </div>
<div class="group">
    <input placeholder="" type="number" name="quantidade"></input>
    <label>quantidade</label>
    </div>
<div class="group">
    <input placeholder="" type="number" step="0.01" name="preco_compra"></input>
    <label>valor de custo</label>
    </div>
<div class="group">
    <input placeholder="" name="preco_venda" type="number" step="0.01"></input>
    <label>valor de venda</label>
    </div>
    <button type="submit">cadastrar</button>
  </form>
</div>
<div id="logo" class="logo">
  <img src="logo.png" />
</div>


<?php 

if(isset($_POST['nome_fornecedor']) && isset($_POST['empresa']) && isset($_POST['telefone_fornecedor'])){
  $nome_fornecedor = $_POST['nome_fornecedor'];
  $empresa = $_POST['empresa'];
  $telefone_fornecedor = $_POST['telefone_fornecedor'];

  $sqlcode = "INSERT INTO fornecedores VALUES ('null', '$nome_fornecedor', '$empresa', '$telefone_fornecedor')";
  $sqlquery = $mysqli->query($sqlcode);
}


?>

        <div class="card" id="div6">
  <div class="card-header">
    <div class="text-header">Cadastro fornecedores</div>
  </div>
  <div class="card-body">
    <form action="" method="post">
      <div class="form-group">
        <label>Nome</label>
        <input required="" class="form-control" name="nome_fornecedor" type="text">
      </div>
      <div class="form-group">
        <label>Empresa</label>
        <input required="" class="form-control" name="empresa" type="text">
      </div>
      <div class="form-group">
        <label>telefone</label>
        <input required="" class="form-control" name="telefone_fornecedor" type="int">
      </div>
     <br>
     <button class="btn" type="submit">cadastrar</form>
  </div>
  </div>
        </div>
  


<script>
      document.getElementById('div2').style.display = 'none'
      document.getElementById('div4').style.display = 'none'
      document.getElementById('div6').style.display = 'none'

     function clicar1(){

			document.getElementById('div2').style.display = 'block'
			document.getElementById('div4').style.display = 'none'
      document.getElementById('logo').style.display = 'none'
      document.getElementById('div6').style.display = 'none'			
		}

    function clicar2(){
      document.getElementById('div4').style.display = 'block'
      document.getElementById('div2').style.display = 'none'
      document.getElementById('logo').style.display = 'none'
      document.getElementById('div6').style.display = 'none'
    }

    function clicar3(){
      document.getElementById('div4').style.display = 'none'
      document.getElementById('div2').style.display = 'none'
      document.getElementById('logo').style.display = 'none'
      document.getElementById('div6').style.display = 'block'
    }

    </script>



</body>
</html>
