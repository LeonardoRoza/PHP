<?php
class Jogo{
  private $idJogo;
  private $nome;
  private $genero;
  private $classificacao;
  private $desenvolvedora;
  private $tamanho;

  public function __construct(){}
  public function __destruct(){}

  public function __get($a){return $this->$a;}
  public function __set($a,$v){$this->$a = $v;}
}
