<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Página Inicial</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
  <style type="text/css">
    h2{ color:#696969; }
    th{ color:#696969;}
  </style>
</head>
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
    <h1 class="jumbotron bg-dark">Seja bem vindo!</h1>

    <h2>Jogos em Destaques!!</h2>
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th><h3>GTA V</h3></th>
            <th><h3>PUBG</h3></th>
          </tr>
          <tr>
            <td><img src="../img/gta.jpg" class="rounded img-responsive" alt="GTA V" width="500" height="500"></td>
            <td><img src="../img/pubg.jpg" class="rounded img-responsive" alt="GTA V" width="500" height="500"></td>
          </tr>
        </table>
      </div>
  </div>
</body>
</html>
