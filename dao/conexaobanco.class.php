<?php
class ConexaoBanco extends PDO{
   private static $instance = null;

   public function __construct($dsn, $user, $pass){
     parent::__construct($dsn,$user,$pass);
   }
   public static function getInstance(){
     if(!isset(self::$instance)){
       try {
         self::$instance = new ConexaoBanco("mysql:dbname=cliente;host","root","");
       } catch (PDOException $e) {
         echo "Erro ao conectar com o bd!".$e;
       }//fecha catch
     }//fecha if
     return self::$instance;
   }//function getInstance
}//fecha classe
