<?php
require_once "conexaobanco.class.php";
class JogoDAO{
  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function __destruct(){}

  public function cadastrarJogo($jogo){
      try {
        $stat = $this->conexao->prepare("insert into jogo(idJogo,nome,genero,classificacao,desenvolvedora,tamanho)values(null,?,?,?,?,?)");

        $stat->bindValue(1, $jogo->nome);
        $stat->bindValue(2, $jogo->genero);
        $stat->bindValue(3, $jogo->classificacao);
        $stat->bindValue(4, $jogo->desenvolvedora);
        $stat->bindValue(5, $jogo->tamanho);

        $stat->execute();
      } catch (PDOException $e) {
        echo "Erro ao cadastrar Jogo!".$e;
      }//fecha catch
  }//fecha function cadastrar

  public function buscarJogo(){
    try {
      $stat = $this->conexao->query("select * from jogo");
      $array = $stat->fetchAll(PDO::FETCH_CLASS,'jogo');
      return $array;
    } catch (PDOException $e) {
      echo 'Erro ao buscar jogo!'.$e;
    }//fecha catch
  }//fecha buscra cliente

  public function deletarJogo($id){
    try{
      $stat = $this->conexao->prepare(
        "delete from jogo where idJogo = ?");
      $stat->bindValue(1,$id);
      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao excluir! ".$e;
    }
  }//fecha deletarLivro

  public function filtrarJogo($query){
  try{
    $stat = $this->conexao->query("select * from jogo ".$query);
    $array = $stat->fetchAll(PDO::FETCH_CLASS,'jogo');
    return $array;
  }catch(PDOException $e){
    echo "Erro ao filtrar jogo! ".$e;
  }
}//filtrarLivro

public function alterarJogo($jogo){ //objeto livro
  try{
    $stat = $this->conexao->prepare(
      "update jogo set nome=?, genero=?, classificacao=?, desenvolvedora=?, tamanho=? where idJogo=?");

    $stat->bindValue(1, $jogo->nome);
    $stat->bindValue(2, $jogo->genero);
    $stat->bindValue(3, $jogo->classificacao);
    $stat->bindValue(4, $jogo->desenvolvedora);
    $stat->bindValue(5, $jogo->tamanho);
    $stat->bindValue(6, $jogo->idJogo);
    $stat->execute();

  }catch(PDOException $e){
    echo "Erro ao alterar jogo! ".$e;
  }//catch
}//cadastrarLivro
}
