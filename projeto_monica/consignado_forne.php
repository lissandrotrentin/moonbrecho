<?php 

require_once('conex.php');

include('protect.php');

$id = $_GET['id'];


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>compras</title>
    <link rel="stylesheet" type="text/css" href="estilo_tabelas.css">
    <link rel="stylesheet" type="text/css" href="estilo_voltar.css">
    <style>
        table{
            margin-left: 30px;
            margin-top: 30px;
            width: 800px;
        }

        body{
    background-color: rgb(169, 177, 177);
}
    </style>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th class="conteudo">descricao</th>
            <th class="conteudo">quantidade de compra</th>
            <th class="conteudo">quantidade atual</th>
            <th class="conteudo">custo</th>
            <th class="conteudo">venda</th>
            <th class="conteudo">lucro</th>
        </tr>
        </thead>
    




<?php

$sqlcode = "SELECT * FROM consignados WHERE id_fornecedor = '$id'";
$sqlquery = $mysqli->query($sqlcode) or die ('aconteceu algum problema!'. $mysqli->error);

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
        <td class="conteudo"><?php echo $dados['descricao']; ?></td>
        <td class="conteudo"><?php echo $dados['quantidade_compra']; ?></td>
        <td class="conteudo"><?php echo $dados['quantidade_atual']; ?></td>
        <td class="conteudo"><?php echo $formatc; ?> R$</td>
        <td class="conteudo"><?php echo $formatv; ?> R$</td>
        <td class="conteudo"><?php echo $formatl; ?> R$</td>
        
    </Tr>
    </tbody>



    <?php
  
}


if($sqlquery->num_rows == 0){
    ?>
    <tbody>
    <tr>
        <td colspan="6">nenhum produto registrado...</td>
    </tr>
    </tbody>
    <?php
}

?>

</table>

<div class="main">
  <button class="btn"><a href="fornecedores.php">voltar</a></button>
</div>

</body>
</html>