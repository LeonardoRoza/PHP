<?php
session_start();
ob_start();
if(isset($_GET['id'])){
  include_once 'modelo/jogo.class.php';
  include_once 'dao/jogodao.class.php';
  $jogoDAO = new jogoDAO();
  $query = "where idJogo = ".$_GET['id'];
  $jogo = $jogoDAO->filtrarJogo($query);
  $j = $jogo[0]; //gambi
  // var_dump($livros);
  // echo $livro;
}else{
  header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Alterar Jogo</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body class="bg-dark">
  <div class="container">
    <h1 class="jumbotron bg-dark">Alterar Jogo</h1>
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

        <form name="cadjogo" method="post" action="">
          <div class="form-group">
            <input type="text" name="txtnome" placeholder="Nome" class="form-control"
            value="<?php
            echo $j->nome;
            ?>">
          </div>
          <div class="form-group">
            <select name="selgenero" class="form-control">
                <option value='Ação' <?php if($j->genero == 'acao') echo "selected='selected'"; ?>>Ação</option>;
                <option value='Battle Royale' <?php if($j->genero == 'battle') echo "selected='selected'"; ?>>Battle Royale</option>;
                <option value='Multiplayer' <?php if($j->genero == 'multiplayer') echo "selected='selected'"; ?>>Multiplayer</option>;
            </select>
          </div>
          <div class="form-group">
            <select name="selclassificacao" class="form-control">
                <option value='14' <?php if($j->classificacao == '14') echo "selected='selected'"; ?>>14</option>;
                <option value='16' <?php if($j->classificacao == '16') echo "selected='selected'"; ?>>16</option>;
                <option value='18' <?php if($j->classificacao == '18') echo "selected='selected'"; ?>>18</option>;
            </select>
          </div>
          <div class="form-group">
            <input type="text" name="txtdesenvolvedora" placeholder="Desenvolvedora" class="form-control"
            value="<?php
            echo $j->desenvolvedora;
            ?>">
          </div>
          <div class="form-group">
            <input type="text" name="txttamanho" placeholder="Tamanho" class="form-control"
            value="<?php
            echo $j->tamanho;
            ?>">
          </div>
          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
        <!-- FALTA CÓDIGO -->
        <?php
        //AQUI....
        if(isset($_POST['alterar'])){
          include_once "modelo/jogo.class.php";
          include_once "dao/jogodao.class.php"; //AQUI
          include_once "util/padronizacao.class.php";
          //include_once "util/helper.class.php";
          include_once "util/validacao.class.php";

          $qtdErros=0;
          //demais validacoes....
          if($qtdErros==0){

            $jogo = new Jogo();
            $jogo->idJogo = $j->idJogo; //enviar
            $jogo->nome = Padronizacao::padronizarNome($_POST['txtnome']);
            $jogo->genero = $_POST['selgenero'];
            $jogo->classificacao = $_POST['selclassificacao'];
            $jogo->desenvolvedora = Padronizacao::padronizarNome($_POST['txtdesenvolvedora']);
            $jogo->tamanho = $_POST['txttamanho'];
            $jogoDAO = new jogoDAO();
            $jogoDAO->alterarJogo($jogo);

            echo "Jogo alterado com sucesso!";
            header("location:consulta-jogo.php");
            unset($_POST);
          }//fecha if qtdErros == 0
        }//fecha if
        ?>
      </div>
  </body>
</html>
