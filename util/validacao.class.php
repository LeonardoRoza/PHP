<?php
class Validacao{

  public static function validarEndereco($v){
    $exp = "/^.{5,100}$/";
    return preg_match($exp,$v);
  }
  public static function validarCPF($v){
    $exp = "/^.{11}$/";
    return preg_match($exp,$v);
  }
  public static function validarRg($v){
    $exp = "/^.{10}$/";
    return preg_match($exp,$v);
  }
  public static function validarIdade($v){
    $exp = "/^[\d]{2}$/";
    return preg_match($exp,$v);
  }
}
