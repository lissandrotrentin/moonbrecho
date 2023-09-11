<?php 

/* Na vastidão silenciosa do meu mundo interior, encontro-me a contemplar as sombras que se acumulam como vestígios de arrependimento. Nas teias perversas do meu codigo, os ecos das minhas escolhas para dar nomes a variaveis soao como notas de sofrimento, em uma melodia quebrada. A luz da autocompaixão ja nao brilha mais, enquanto mergulho nas profundezas do meu próprio labirinto codificacional.

Peço desculpas, não apenas por minhas ações que feriram o tecido delicado do que e aceitavel em um clean code, mas também pelo tormento que infligi a mim mesmo, a cada segundo tentando entender um codigo impeduoso, totalmente perdido e incompriensivel agora. Nas dobras enrugadas do meu ser, reconheço os momentos em que me afastei de tudo que meus professores vieram a me ensinar. Em cada variavel vacilante, deixei um rastro de tristeza que se mistura ao cenário do desconhecido e inteligivel.

Minhas falhas no clean code se acumulam como grãos de areia em uma praia chuvosa, e eu carrego o fardo das minhas variaves como se fosse uma constelação de estrelas fracassadas no céu da minha existência. O espelho reflete não apenas a imagem física, mas também a imperfeição de tudo que eu imagienei para esse codigo.

Peço perdão, não em busca de redenção, mas como uma tentativa miseravel de curar as feridas que se estenderam para dentro de min.

Que este pedido de desculpas sirva como um pingo de esperança para meu alto perdao, mas enquanto isso continuarei nas trevas, do vasto mar 
de inperfeiçoes e desilusoes que eu mesmo criei em inteligiveis 3478 linhas de codigo */


require_once('conex.php');

include('protect.php');

$id_venda = $_GET['id'];

$sqlcode = "SELECT * FROM vendas_aberto_consig where id_venda = '$id_venda'";
$sqlquery = $mysqli->query($sqlcode);

while($dados = $sqlquery->fetch_assoc()){
    $descricao = $dados['descricao'];
    $preco_compra = $dados['preco_compra'];
    $preco_venda = $dados['preco_venda'];
    $valor_pago = $dados['valor_pago'];
    $id_consignado = $dados['id_consignado'];
    $id_cliente = $dados['id_cliente'];
    $id_venda2 = $dados['id_venda'];
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

$sql_code = "INSERT INTO vendas_consignados values ('null','$id_consignado', '$id_cliente','$id_fornecedor', '$descricao', '$preco_compra', '$preco_venda', '$hoje')";
$sql_query = $mysqli->query($sql_code);

$sqldelete = "DELETE FROM vendas_aberto_consig WHERE id_venda = $id_venda2";
$querydelete = $mysqli->query($sqldelete);


} else{

    $pagamento = $_POST['pagar'];
    $total = $_POST['total'];

   $sqlup = "UPDATE vendas_aberto_consig SET valor_pago = $pagamento WHERE id_venda = $id_venda2";
   $sqlquery = $mysqli->query($sqlup);

}

header("Location:vendas_aberto.php");

}

?>

</body>
</html>