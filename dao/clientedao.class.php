<?php
require_once "conexaobanco.class.php";
class ClienteDAO{
  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function __destruct(){}

  public function cadastrarCliente($cli){
      try {
        $stat = $this->conexao->prepare("insert into cliente(idCliente,nomeCliente,idadeCliente,cpfCliente,rgCliente,enderecoCliente)values(null,?,?,?,?,?)");

        $stat->bindValue(1, $cli->nomeCliente);
        $stat->bindValue(2, $cli->idadeCliente);
        $stat->bindValue(3, $cli->cpfCliente);
        $stat->bindValue(4, $cli->rgCliente);
        $stat->bindValue(5, $cli->enderecoCliente);

        $stat->execute();
      } catch (PDOException $e) {
        echo "Erro ao cadastrar cliente!".$e;
      }//fecha catch
  }//fecha function cadastrar

  public function buscarCliente(){
    try {
      $stat = $this->conexao->query("select * from cliente");
      $array = $stat->fetchAll(PDO::FETCH_CLASS,'Cliente');
      return $array;
    } catch (PDOException $e) {
      echo 'Erro ao buscar cliente!'.$e;
    }//fecha catch

  }//fecha buscra cliente
  public function deletarCliente($id){
    try{
      $stat = $this->conexao->prepare(
        "delete from cliente where idcliente = ?");
      $stat->bindValue(1,$id);
      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao excluir! ".$e;
    }
  }//fecha deletarLivro
  public function filtrarCliente($query){
  try{
    $stat = $this->conexao->query("select * from cliente ".$query);
    $array = $stat->fetchAll(PDO::FETCH_CLASS,'Cliente');
    return $array;
  }catch(PDOException $e){
    echo "Erro ao filtrar cliente! ".$e;
  }
}//filtrarLivro
public function alterarCliente($cli){ //objeto livro
  try{
    $stat = $this->conexao->prepare(
      "update cliente set nomeCliente=?, idadeCliente=?, cpfCliente=?, rgCliente=?, enderecoCliente=? where idCliente=?");

    $stat->bindValue(1, $cli->nomeCliente);
    $stat->bindValue(2, $cli->idadeCliente);
    $stat->bindValue(3, $cli->cpfCliente);
    $stat->bindValue(4, $cli->rgCliente);
    $stat->bindValue(5, $cli->enderecoCliente);
    $stat->bindValue(6, $cli->idCliente);
    $stat->execute();

  }catch(PDOException $e){
    echo "Erro ao alterar cliente! ".$e;
  }//catch
}//cadastrarLivro
}
