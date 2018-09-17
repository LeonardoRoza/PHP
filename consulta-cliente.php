<?php
session_start();
ob_start();
include_once 'dao/clientedao.class.php';
include_once 'modelo/cliente.class.php';

$cliDAO = new CLienteDAO();
$clientes = $cliDAO->buscarCliente();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Consulta de cliente</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
  <style type="text/css">
    h2{ color:#696969; }
    th{ color:#000080;}
    td{color:#FF0000;}
    #botao{background-color:#696969; color:#000080;}
  </style>
</head>
<body class="bg-dark">
  <div class="container">
    <h1 class="jumbotron bg-dark">Consulta de cliente</h1>

    <body class="bg-dark">
      <div class="container">
        <nav class="navbar fixed-top navbar-expand navbar-dark bg-dark">
          <a class="navbar-brand" href="#">Sistema</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro-cliente.php">Cadastro de clientes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-cliente.php">Consulta de cliente<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro-jogo.php">Cadastro de jogo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-jogo.php">Consulta de Jogo<span class="sr-only">(current)</span></a>
              </li>
            </ul>
          </div>
        </nav>
    <form name="filtrocliente" method="post" action="">
      <div class="row">
        <div class="form-group col-md-6">
          <input type="text" name="txtfiltro" placeholder="Digite o que deseja filtrar" class="form-control">
        </div>

        <div class="form-group col-md-6">
          <select class="form-control" name="selfiltro">
            <option value="selecione">Selecione</option>
            <option value="codigo">Código</option>
            <option value="nomeCliente">Cliente</option>
            <option value="cpfCliente">CPF</option>
            <option value="rgCliente">RG</option>
          </select>
        </div>
      </div><!-- div row -->

      <div class="form-group">
        <input type="submit" name="pesquisar" value="Pesquisar" class="form-control" id="botao">
      </div>
</form>
    <?php
    if(isset($_POST['pesquisar'])){
       $filtro = $_POST['selfiltro'];
       $pesquisa = $_POST['txtfiltro'];


       if($filtro == "selecione" || $pesquisa == ""){
         $livros = $cliDAO->buscarCliente();
         //$qtdErros++;
       }


         $query = "";
         if($filtro == 'codigo'){
           $query = "where idCliente = ".$pesquisa;
         }else if($filtro == 'nomeCliente'){
           $query = "where nomeCliente = '".$pesquisa."'";
         }else if($filtro == 'cpfCliente'){
           $query = "where cpfCliente = '".$pesquisa."'";
         }else if($filtro == 'rgCliente'){
           $query = "where cpfCliente = '".$pesquisa."'";
         }
         //var_dump($query);
         $clientes = $cliDAO->filtrarCliente($query);
     }
    //var_dump($clientes); Testeeeee
    if(count($clientes) == 0){
      echo "<h2>Sem clientes cadastrados</h2>";
    }
    ?>
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
          <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>CPF</th>
            <th>RG</th>
            <th>Endereço</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>CPF</th>
            <th>RG</th>
            <th>Endereço</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          foreach($clientes as $c){
            echo "<tr>";
              echo "<td>$c->idCliente</td>";
              echo "<td>$c->nomeCliente</td>";
              echo "<td>$c->idadeCliente</td>";
              echo "<td>$c->cpfCliente</td>";
              echo "<td>$c->rgCliente</td>";
              echo "<td>$c->enderecoCliente</td>";
              echo "<td><a href='consulta-cliente.php?id=$c->idCliente'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span> Excluir</button></a></td>";
              echo "<td><a href='alterar-cliente.php?id=$c->idCliente'><button type='button' class='btn btn-info'><span class='glyphicon glyphicon-remove'></span> Alterar</button> </a></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php
if(isset($_GET['id'])){
  $cliDAO->deletarCliente($_GET['id']);
  echo "Cliente excluido com sucesso";
  header("location:consulta-cliente.php");
  unset($_GET['id']);
}
?>
</body>
</html>
