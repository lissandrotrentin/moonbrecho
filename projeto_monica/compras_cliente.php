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
            <th class="conteudo">custo</th>
            <th class="conteudo">venda</th>
            <th class="conteudo">lucro</th>
            <th class="conteudo">data</th>
        </tr>
        </thead>
    




<?php

$sqlcode = "SELECT * FROM vendas WHERE id_cliente = '$id'";
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
        <td class="conteudo"><?php echo $formatc; ?> R$</td>
        <td class="conteudo"><?php echo $formatv; ?> R$</td>
        <td class="conteudo"><?php echo $formatl; ?> R$</td>
        <td class="conteudo"><?php echo $dados['data_venda']; ?></td>
        
    </Tr>
    </tbody>



    <?php
  
}


$sqlcodeco = "SELECT * FROM vendas_consignados WHERE id_cliente = '$id'";
$sqlqueryco = $mysqli->query($sqlcodeco) or die ('aconteceu algum problema!'. $mysqli->error);

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
        <td class="conteudo"><?php echo $dadosco['descricao']; ?></td>
        <td class="conteudo"><?php echo $formatcco; ?> R$</td>
        <td class="conteudo"><?php echo $formatvco; ?> R$</td>
        <td class="conteudo"><?php echo $formatlco; ?> R$</td>
        <td class="conteudo"><?php echo $dadosco['data_venda']; ?></td>
        
    </Tr>
    </tbody>

<?php

}

?>

</table>

<div class="main">
  <button class="btn"><a href="select_cliente.php">voltar</a></button>
</div>

</body>
</html>