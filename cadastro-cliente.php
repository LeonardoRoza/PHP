<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Cadastro de cliente</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <h1 class="jumbotron bg-dark">Cadastro de cliente</h1>

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

    <form name="cadcliente" method="post" action="">
      <div class="form-group">
        <input type="text" name="txtnome" placeholder="Digite seu Nome" class="form-control">
      </div>
      <div class="form-group">
        <input type="number" name="numidade" placeholder="Digite sua idade" class="form-control">
      </div>
      <div class="form-group">
        <input type="number" name="numcpf" placeholder="Digite seu CPF" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" name="txtrg" placeholder="Digite seu RG" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" name="txtendereco" placeholder="Digite seu Endereço" class="form-control">
      </div>
      <div class="form-group">
        <input type="submit" name="cadastrarCliente" value="Cadastrar" class="btn btn-primary">
        <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
      </div>
    </form>
    <?php
    if(isset($_POST['cadastrarCliente'])){
      include_once 'modelo/cliente.class.php';
      include_once 'dao/clientedao.class.php';
      include_once 'util/padronizacao.class.php';
      include_once 'util/validacao.class.php';

      $qtdErros=0;
      if(!Validacao::validarRg($_POST['txtrg'])){
        $qtdErros++;
        echo "<h2>RG inválido</h2>";
      }
      if(!Validacao::validarEndereco($_POST['txtendereco'])){
        $qtdErros++;
        echo "<h2> Endereco inválido </h2>";
      }
      if(!Validacao::validarIdade($_POST['numidade'])){
        $qtdErros++;
        echo "<h2>Idade inválida</h2>";
      }

      if($qtdErros==0){
      $cli = new Cliente();
      $cli->nomeCliente = Padronizacao::padronizarNome($_POST['txtnome']);
      $cli->idadeCliente = $_POST['numidade'];
      $cli->cpfCliente = $_POST['numcpf'];
      $cli->rgCliente = $_POST['txtrg'];
      $cli->enderecoCliente = $_POST['txtendereco'];
      //echo $cli; Somente Teste

      $cliDAO = new ClienteDAO();
      $cliDAO->cadastrarCliente($cli);
      echo "<h2>Cliente cadastrado com sucesso</h2>";
      unset($_POST);
    }//fecha if cadastrar cliente
  }
    ?>
  </div>
</body>
</html>
