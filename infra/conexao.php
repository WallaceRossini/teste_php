<?php 

  function conexaoMysql(){
      $host = (string) "127.0.0.1";
      $user = (string) "root";
      $pass = (string) "bcd127";
      $database = (string) "teste_php";

      $conexao = mysqli_connect($host,$user,$pass,$database);

    return $conexao;
  }

?>