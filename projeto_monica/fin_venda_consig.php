<?php 

require_once('conex.php');

include('protect.php');

$id = $_GET['id'];
$id_cliente = $_GET['id_cliente'];

$sqlcode = "SELECT * FROM consignados where id_consignado = '$id'";
$sqlquery = $mysqli->query($sqlcode);

while($dados = $sqlquery->fetch_assoc()){
    $descricao = $dados['descricao'];
    $preco_compra = $dados['preco_compra'];
    $preco_venda = $dados['preco_venda'];
    $id_fornecedor = $dados['id_fornecedor'];
    
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
    <input placeholder="" type="number" step="0.00" id="" name="pagar" >
    <label>valor a pagar</label>
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

$sql_code = "INSERT INTO vendas_consignados values ('null','$id', '$id_cliente', '$id_fornecedor', '$descricao', '$preco_compra', '$preco_venda', '$hoje')";
$sql_query = $mysqli->query($sql_code);

$hoje_d = date('d');


$sql_code_m = "INSERT INTO vendas_mes_consig values ('$id', '$id_cliente', '$id_fornecedor', '$descricao', '$preco_compra', '$preco_venda', '$hoje')";
$sql_query_m = $mysqli->query($sql_code_m);


} else{

    $pagamento = $_POST['pagar'];
    $total = $_POST['total'];

    $hoje = date('d/m/y');

    $sql_code = "INSERT INTO vendas_aberto_consig values ('null','$id', '$id_cliente','$id_fornecedor', '$descricao', '$preco_compra','$pagamento','$preco_venda', '$hoje')"; 
    $sql_query = $mysqli->query($sql_code);

    $hoje_d = date('d'); 

    $sql_code_m = "INSERT INTO vendas_mes_consig values ('$id', '$id_cliente', '$id_fornecedor', '$descricao', '$preco_compra', '$preco_venda', '$hoje_d')";
    $sql_query_m = $mysqli->query($sql_code_m);

}
header("Location:select_cliente.php");
}

?>

</body>
</html>