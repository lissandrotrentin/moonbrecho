<?php   

require_once('conex.php');

include('protect.php');

$id_fornecedor = $_GET['id'];

if(isset($_POST['descricao']) && isset($_POST['preco_compra']) && isset($_POST['preco_venda'])){
    if(strlen($_POST['descricao']) == 0){
      echo "!ensira a descricao";
  } else if(strlen($_POST['quantidade_compra']) == 0){
     echo "ensira a qauntidade";
  } else if(strlen($_POST['preco_compra']) == 0){
     echo "ensira o valor de custo";
  } else if(strlen($_POST['preco_venda']) == 0){
      echo  "ensira o valor de venda";
  } else{


      $descricao = $_POST['descricao'];
      $preco_compra = $_POST['preco_compra'];
      $preco_venda = $_POST['preco_venda'];
      $quantidade_compra = $_POST['quantidade_compra'];
      $quantidade_atual = $quantidade_compra;

$sqlcode = "INSERT INTO consignados VALUES ('null', '$id_fornecedor', '$descricao', '$preco_compra', '$preco_venda', '$quantidade_compra',
'$quantidade_atual')";
$sqlquery = $mysqli->query($sqlcode);

  }

  header('Location:fornecedores.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro produto</title>
    <link rel="stylesheet" type="text/css" href="estilo_cadastro_estoque.css">
</head>
<body>
    <br>
    <br>
    <br>
    <br>
<div class="card" id="div4">
  <span class="title">Cadastro de produto</span>
  <form class="form" method="post">
<div class="group">
    <input placeholder="" type="text" id="" name="descricao" >
    <label>descricao</label>
    </div>
<div class="group">
    <input placeholder="" type="number" name="quantidade_compra"></input>
    <label>quantidade de compra</label>
    </div>
<!--<div class="group">
    <input placeholder="" type="number" name="quantidade_atual"></input>
    <label>quantidade atual</label>
    </div>-->
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
</body>
</html>