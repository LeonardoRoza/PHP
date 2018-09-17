<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Cadastro de Jogo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <h1 class="jumbotron bg-dark">Cadastro de Jogo</h1>

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

    <form name="cadjogo" method="post" action="">
      <div class="form-group">
        <input type="text" name="txtnome" placeholder="Digite o nome do jogo" class="form-control">
      </div>
      <div class="form-group">
            <select name="selgenero" class="form-control">
              <option value="Ação">Ação</option>
              <option value="Battle Royale">Battle Royale</option>
              <option value="Multiplayer">Multiplayer</option>
            </select>
          </div>
          <div class="form-group">
            <select name="selclassificacao" class="form-control">
              <option value="14">14</option>
              <option value="16">16</option>
              <option value="18">18</option>
            </select>
          </div>
      <div class="form-group">
        <input type="text" name="txtdesenvolvedora" placeholder="Digite a desenvolvedora do jogo" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" name="txttamanho" placeholder="Digite o tamanho do jogo" class="form-control">
      </div>
      <div class="form-group">
        <input type="submit" name="cadastrarJogo" value="Cadastrar" class="btn btn-primary">
        <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
      </div>
    </form>
    <?php
    if(isset($_POST['cadastrarJogo'])){
      include_once 'modelo/jogo.class.php';
      include_once 'dao/jogodao.class.php';
      //include_once 'util/padronizacao.class.php';
      //include_once 'util/validacao.class.php';

      $qtdErros=0;
      if($qtdErros==0){
      $jogo = new Jogo();
      $jogo->nome = Padronizacao::padronizarNome($_POST['txtnome']);
      $jogo->genero = $_POST['selgenero'];
      $jogo->classificacao = $_POST['selclassificacao'];
      $jogo->desenvolvedora = Padronizacao::padronizarNome($_POST['txtdesenvolvedora']);
      $jogo->tamanho = $_POST['txttamanho'];
      //echo $jogo; Somente Teste

      $jogoDAO = new jogoDAO();
      $jogoDAO->cadastrarJogo($jogo);
      echo "<h2>Jogo cadastrado com sucesso</h2>";
      unset($_POST);
    }//fecha if cadastrar cliente
  }
    ?>
  </div>
</body>
</html>
