<?php 

require_once('conex.php');

include('protect.php');

$id_venda = $_GET['id'];

$sqlcode = "SELECT * FROM vendas_aberto where id_venda = '$id_venda'";
$sqlquery = $mysqli->query($sqlcode);

while($dados = $sqlquery->fetch_assoc()){
    $descricao = $dados['descricao'];
    $preco_compra = $dados['preco_compra'];
    $preco_venda = $dados['preco_venda'];
    $valor_pago = $dados['valor_pago'];
    $id_produto = $dados['id_produto'];
    $id_cliente = $dados['id_cliente'];
    $id_venda2 = $dados['id_venda'];
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="estilo_cadastro_estoque.css">
    <style>
        .card{
            margin-top: 150px;
        }
    </style>
</head>
<body>
    
<div class="card" id="div4">
  <span class="title">pagar</span>
  <form class="form" method="post">
<div class="group">
    <input placeholder="" type="number" step="0.00" id="" name="pagar" value="<?php echo $valor_pago ?>">
    </div>
<div class="group">
    <input placeholder="" type="number" step="0.00" name="total" value="<?php echo $preco_venda ?>">
    </div>
    <button type="submit" name="vender">finalizar</button>
  </form>
</div>

<?php

if(isset($_POST['pagar']) && isset($_POST['total']) && isset($_POST['vender'])){
    $pagamento = $_POST['pagar'];
    $total = $_POST['total'];

    if(strlen($_POST['pagar']) == 0){
        echo "digite um valor";
    } else if($pagamento == $total){

        $pagamento = $_POST['pagar'];
        $total = $_POST['total'];

$hoje = date('d/m/y');

$sql_code = "INSERT INTO vendas values ('null','$id_produto', '$id_cliente', '$descricao', '$preco_compra', '$preco_venda', '$hoje')";
$sql_query = $mysqli->query($sql_code);


$sqldelete = "DELETE FROM vendas_aberto WHERE id_venda = $id_venda2";
$querydelete = $mysqli->query($sqldelete);


} else{

    $pagamento = $_POST['pagar'];
    $total = $_POST['total'];

   $sqlup = "UPDATE vendas_aberto SET valor_pago = $pagamento WHERE id_venda = $id_venda2";
   $sqlquery = $mysqli->query($sqlup);

}
header("Location:vendas_aberto.php");
}

?>

</body>
</html>