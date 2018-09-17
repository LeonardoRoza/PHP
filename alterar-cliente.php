
<?php
session_start();
ob_start();
if(isset($_GET['id'])){
  include_once 'modelo/cliente.class.php';
  include_once 'dao/clientedao.class.php';
  $cliDAO = new ClienteDAO();
  $query = "where idCliente = ".$_GET['id'];
  $clientes = $cliDAO->filtrarCliente($query);
  $c = $clientes[0]; //gambi
  // var_dump($livros);
  // echo $livro;
}else{
  header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Alterar Cliente</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body class="bg-dark">
  <div class="container">
    <h1 class="jumbotron bg-dark">Alterar Cliente</h1>
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
            <input type="text" name="txtnome" placeholder="Nome" class="form-control"
            value="<?php
            echo $c->nomeCliente;
            ?>">
          </div>
          <div class="form-group">
            <input type="text" name="numidade" placeholder="Idade" class="form-control"
            value="<?php
            echo $c->idadeCliente;
            ?>">
          </div>
          <div class="form-group">
            <input type="text" name="numcpf" placeholder="CPF" class="form-control"
            value="<?php
            echo $c->cpfCliente;
            ?>">
          </div>
          <div class="form-group">
            <input type="number" name="txtrg" placeholder="RG" class="form-control"
            value="<?php
            echo $c->rgCliente;
            ?>">
          </div>
          <div class="form-group">
            <input type="text" name="txtendereco" placeholder="Endereço" class="form-control"
            value="<?php
            echo $c->enderecoCliente;
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
          include_once "modelo/cliente.class.php";
          include_once "dao/clientedao.class.php"; //AQUI
          include_once "util/padronizacao.class.php";
          //include_once "util/helper.class.php";
          include_once "util/validacao.class.php";

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

          //demais validacoes....

          if($qtdErros==0){

            $cli = new Cliente();
            $cli->idCliente = $c->idCliente; //enviar
            $cli->nomeCliente = Padronizacao::padronizarNome($_POST['txtnome']);
            $cli->idadeCliente = $_POST['numidade'];
            $cli->cpfCliente = $_POST['numcpf'];
            $cli->rgCliente = $_POST['txtrg'];
            $cli->enderecoCliente = $_POST['txtendereco'];
            $cliDAO = new ClienteDAO();
            $cliDAO->alterarCliente($cli);

            echo "Cliente alterado com sucesso!";
            header("location:consulta-cliente.php");
            unset($_POST);
          }//fecha if qtdErros == 0
        }//fecha if
        ?>
      </div>
  </body>
</html>
