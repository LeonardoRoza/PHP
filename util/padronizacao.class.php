<?php
class Padronizacao{
  public static function padronizarNome($v){
    return ucwords(strtolower($v));
  }
}
