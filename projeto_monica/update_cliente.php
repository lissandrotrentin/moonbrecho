<?php 

require_once('conex.php');

include('protect.php');

$id = $_GET['id'];

$sqlcode = "SELECT * FROM clientes where id_cliente = '$id'";
$sqlquery = $mysqli->query($sqlcode);

while($dados = $sqlquery->fetch_assoc()){
    $nome = $dados['nome'];
    $sobrenome = $dados['sobrenome'];
    $cpf = $dados['cpf'];
    $telefone = $dados['telefone'];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="estilo_c_cliente.css">
    <link rel="stylesheet" type="text/css" href="estilo_form_c2.css">
    <style>
        body{
    background-color: rgb(169, 177, 177);
  }
    </style>
</head>
<body>
  <br>
  <br>
  <br>
  <br>
<div class="card">
  <div class="card-header">
    <div class="text-header">Registrar</div>
  </div>
  <div class="card-body">
    <form action="" method="post">
      <div class="form-group">
        <label>primeiro nome:</label>
        <input required="" class="form-control" name="nome" type="text" value="<?php echo $nome; ?>">
      </div>
      <div class="form-group">
        <label>sobrenome:</label>
        <input required="" class="form-control" name="sobrenome" type="text" value="<?php echo $sobrenome; ?>">
      </div>
      <div class="form-group">
        <label>cpf:</label>
        <input required="" class="form-control" name="cpf" type="int" value="<?php echo $cpf; ?>">
      </div>
      <div class="form-group">
        <label>telefone:</label>
        <input required="" class="form-control" name="telefone" type="int" value="<?php echo $telefone; ?>">
      </div><br>
     <input type="submit" class="btn" value="atualizar" name="atualizar">    </form>
  </div>

</div>
</body>
</html>

<?php 

if(isset($_POST['atualizar'])){
    
    if(strlen($_POST['nome']) == 0){
        echo "ensira um nome";
    } else if(strlen($_POST['sobrenome']) == 0){
        echo "ensira um sobrenome";
    } else if(strlen($_POST['cpf']) == 0){
        echo "ensira um cpf valido";
    } else if(strlen($_POST['telefone']) == 0){
        echo "ensira o WhatsApp";
    } else{

    $pnome = $_POST['nome'];
    $psobrenome = $_POST['sobrenome'];
    $pcpf = $_POST['cpf'];
    $ptelefone = $_POST['telefone'];

$sql_code = "UPDATE clientes SET nome = '$pnome', sobrenome = '$psobrenome', cpf =  '$pcpf', telefone = '$ptelefone'
WHERE id_cliente = $id ";
$sql_query = $mysqli->query($sql_code);

header('Location:select_cliente.php');

    }

   

}




?>