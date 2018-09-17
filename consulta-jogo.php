<?php
session_start();
ob_start();
include_once 'dao/jogodao.class.php';
include_once 'modelo/jogo.class.php';

$jogoDAO = new JogoDAO();
$jogo = $jogoDAO->buscarJogo();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Consulta de jogos</title>
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
<body>
  <div class="container">
    <h1 class="jumbotron bg-dark">Consulta de Jogos</h1>

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
    <form name="filtrojogo" method="post" action="">
      <div class="row">
        <div class="form-group col-md-6">
          <input type="text" name="txtfiltro" placeholder="Digite o que deseja filtrar" class="form-control">
        </div>

        <div class="form-group col-md-6">
          <select class="form-control" name="selfiltro">
            <option value="selecione">Selecione</option>
            <option value="codigo">Código</option>
            <option value="nome">Nome</option>
            <option value="desenvolvedora">Desenvolvedora</option>
            <option value="classificacao">Classificação</option>
          </select>
        </div>
      </div><!-- div row -->

      <div class="form-group">
        <input type="submit" name="pesquisar" value="Pesquisar" class="form-control" id="botao">
      </div>
</form>
    <?php
    if (isset($_POST['pesquisar'])) {
        $filtro = $_POST['selfiltro'];
        $pesquisa = $_POST['txtfiltro'];
        $qtdErro = 0;
      if ($filtro == 'selecione' || $pesquisa == "") {
        $jogo = $jogoDAO->buscarJogo();
        $qtdErro++;
      }
           $query = "";
           if($filtro == 'codigo'){
             $query = "where idJogo = ".$pesquisa;
           }else if($filtro == 'nome'){
             $query = "where nome = '".$pesquisa."'";
           }else if($filtro == 'desenvolvedora'){
             $query = "where desenvolvedora = '".$pesquisa."'";
           }else if($filtro == 'classificacao'){
             $query = "where classificacao = '".$pesquisa."'";
           }
           //var_dump($query);
           $jogo = $jogoDAO->filtrarJogo($query);
       }

      //var_dump($clientes); Testeeeee
      if(count($jogo) == 0){
        echo "<h2>Sem Jogos cadastrados</h2>";
      }
      ?>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <th>Código</th>
              <th>Nome</th>
              <th>Gênero</th>
              <th>Classificação</th>
              <th>Desenvolvedora</th>
              <th>Tamanho</th>
              <th>Excluir</th>
              <th>Alterar</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Código</th>
              <th>Nome</th>
              <th>Gênero</th>
              <th>Classificação</th>
              <th>Desenvolvedora</th>
              <th>Tamanho</th>
              <th>Excluir</th>
              <th>Alterar</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            foreach($jogo as $j){
              echo "<tr>";
                echo "<td>$j->idJogo</td>";
                echo "<td>$j->nome</td>";
                echo "<td>$j->genero</td>";
                echo "<td>$j->classificacao</td>";
                echo "<td>$j->desenvolvedora</td>";
                echo "<td>$j->tamanho</td>";
                echo "<td><a href='consulta-jogo.php?id=$j->idJogo'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span> Excluir</button></a></td>";
                echo "<td><a href='alterar-jogo.php?id=$j->idJogo'><button type='button' class='btn btn-info'><span class='glyphicon glyphicon-remove'></span> Alterar</button> </a></td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php
  if(isset($_GET['id'])){
    $jogoDAO->deletarJogo($_GET['id']);
    echo "Jogo excluido com sucesso";
    header("location:consulta-jogo.php");
    unset($_GET['id']);
  }
  ?>
  </body>
  </html>
