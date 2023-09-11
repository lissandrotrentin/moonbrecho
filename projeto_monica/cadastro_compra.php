<?php 

require_once('conex.php');

include('protect.php');

$id_cliente = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vendas</title>
    <link rel="stylesheet" type="text/css" href="estilo_botao_pesquisa.css">
    <link rel="stylesheet" type="text/css" href="estilo22.css">
    
</head>
<body>
    <br>
    <br>
    <div class="div1">
    <form method="post">
    <div class="input__container input__container--variant">
        <div class="shadow__input shadow__input--variant"></div>
        <input type="text" name="pesquisa_p" class="input__search input__search--variant" placeholder="pesquisar produto">
        <button class="input__button__shadow input__button__shadow--variant">
          <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" height="1.5em" width="13em">
            <path d="M4 9a5 5 0 1110 0A5 5 0 014 9zm5-7a7 7 0 104.2 12.6.999.999 0 00.093.107l3 3a1 1 0 001.414-1.414l-3-3a.999.999 0 00-.107-.093A7 7 0 009 2z" fill-rule="evenodd" fill="#FFF"></path>
          </svg>
        </button>
      </div>
    </form>
    </div>
    <div class="div2">
    <form method="post">
    <div class="input__container input__container--variant">
        <div class="shadow__input shadow__input--variant"></div>
        <input type="text" name="pesquisa_c" class="input__search input__search--variant" placeholder="pesquisar consignado">
        <button class="input__button__shadow input__button__shadow--variant">
          <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" height="1.5em" width="13em">
            <path d="M4 9a5 5 0 1110 0A5 5 0 014 9zm5-7a7 7 0 104.2 12.6.999.999 0 00.093.107l3 3a1 1 0 001.414-1.414l-3-3a.999.999 0 00-.107-.093A7 7 0 009 2z" fill-rule="evenodd" fill="#FFF"></path>
          </svg>
        </button>
      </div>
    </form>
    </div>
    <br>
    <br>
    <br>
    <div class="div3">
    <table  class="tabela">
        <thead>
            <tr>
                <th class="conteudo">codigo produto</th>
                <th class="conteudo">descricao</th>
                <Th class="conteudo">vender</Th>
            </tr>
        </thead>
<?php 


if(!empty($_POST['pesquisa_p'])){
    $pesquisa = $_POST['pesquisa_p'];

    $sqlcode = "SELECT * FROM estoque WHERE descricao LIKE '%$pesquisa%' AND quantidade > 0";
    $sqlquery = $mysqli->query($sqlcode);
    $quantidade = $sqlquery->num_rows;
    if($quantidade == 0){
        ?>   
        <tbody>
        <tr>
            <td colspan="6">nenhum produto encontrado...</td>
        </tr> 
        </tbody>
        <?php
    } else{

        while($dados = $sqlquery->fetch_assoc()){
        
           
        
            ?>
            <tbody>
            <Tr>
                <td class="conteudo"><?php echo $dados['id_produto']; ?></td>
                <td class="conteudo"><?php echo $dados['descricao']; ?></td>
                <td class="conteudo"><a href="fin_venda.php?id=<?php echo $dados['id_produto']; ?>&id_cliente=<?php echo $id_cliente; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg></a></td>
            </Tr>
            </tbody>
        
        <?php
        
    }
}

}else{
    
    $sqlcode = "SELECT * FROM estoque WHERE quantidade > 0";
    $sqlquery = $mysqli->query($sqlcode) or die ('erro durante select' . $mysqli->error);
    while($dados = $sqlquery->fetch_assoc()){
       
    
        ?>
        <tbody>
        <Tr>
            <td class="conteudo"><?php echo $dados['id_produto']; ?></td>
            <td class="conteudo"><?php echo $dados['descricao']; ?></td>
            <td class="conteudo"><a href="fin_venda.php?id=<?php echo $dados['id_produto']; ?>&id_cliente=<?php echo $id_cliente; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg></a></td>
        </Tr>
        </tbody>
        <?php

}
       
}

?>
    </table>
    </div>
    <div class="div4">
    <table class="tabela2">
        <thead>
            <tr>
                <th class="conteudo">codigo</th>
                <th class="conteudo">descricao</th>
                <th class="acoes">vender</th>
            </tr>
        </thead>
        <?php 


if(!empty($_POST['pesquisa_c'])){
    $pesquisa = $_POST['pesquisa_c'];

    $sql_code = "SELECT * FROM consignados WHERE descricao LIKE '%$pesquisa%' AND quantidade_atual > 0";
    $sql_query = $mysqli->query($sql_code);
    $quantidade_c = $sql_query->num_rows;
    if($quantidade_c == 0){
        ?>   
        <tbody>
        <tr>
            <td colspan="6">nenhum produto encontrado...</td>
        </tr> 
        </tbody>
        <?php
    } else{

        while($dados_c = $sql_query->fetch_assoc()){
        
           
        
            ?>
            <tbody>
            <Tr>
                <td class="conteudo"><?php echo $dados_c['id_consignado']; ?></td>
                <td class="conteudo"><?php echo $dados_c['descricao']; ?></td>
                <td class="conteudo"><a href="fin_venda_consig.php?id=<?php echo $dados_c['id_consignado']; ?>&id_cliente=<?php echo $id_cliente; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg></a></td>
            </Tr>
            </tbody>
        
        <?php
        
    }
}

}else{
    
    $sql_code = "SELECT * FROM consignados WHERE quantidade_atual > 0";
    $sql_query = $mysqli->query($sql_code) or die ('erro durante select' . $mysqli->error);
    while($dados_c = $sql_query->fetch_assoc()){
       
    
        ?>
        <tbody>
        <Tr>
            <td class="conteudo"><?php echo $dados_c['id_consignado']; ?></td>
            <td class="conteudo"><?php echo $dados_c['descricao']; ?></td>
            <td class="conteudo"><a href="fin_venda_consig.php?id=<?php echo $dados_c['id_consignado']; ?>&id_cliente=<?php echo $id_cliente; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg></a></td>
        </Tr>
        </tbody>
        <?php

}
       
}

?>
    </table>
    </div>

   


</body>
</html>