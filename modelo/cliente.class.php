<?php
class Cliente{
  private $idCliente;
  private $nomeCliente;
  private $idadeCliente;
  private $cpfCliente;
  private $rgCliente;
  private $enderecoCliente;

  public function __construct(){}
  public function __destruct(){}
  public function __get($a){return $this->$a;}
  public function __set($a,$v){$this->$a = $v;}

  public function __toString(){
    return nl2br("
          Nome: $this->nomeCliente
          Idade: $this->idadeCliente
          Endereço: $this->enderecoCliente
          CPF: $this->cpfCliente
          RG: $this->rgCliente");
  }
}
