<?php
  require_once('C:/xampp/htdocs/php/infra/conexao.php');

  function listar()
  {
    $conexao = conexaoMysql();
    $sql = 'SELECT pro.*,pre.IDPRECO,pre.PRECO FROM produtos pro  LEFT JOIN preco pre ON pre.IDPROD = pro.IDPROD';
    $select = mysqli_query($conexao, $sql);

    $arr = array();

    foreach ($select as $item){
      array_push($arr,$item);
    }

    return $arr;
  }

  function buscarPorId($id)
  {
    $conexao = conexaoMysql();
    $sql = 'SELECT pro.*,pre.IDPRECO,pre.PRECO FROM produtos pro  JOIN preco pre ON pre.IDPROD = pro.IDPROD WHERE pro.IDPROD = '.$id;
    $select = mysqli_query($conexao, $sql);

    return mysqli_fetch_array($select);
    
  }

  function adicionar($produto)
  {

    $conexao = conexaoMysql();
    $sql = "INSERT INTO produtos (NOME,COR) VALUES ('".$produto["NOME"]."','".$produto["COR"]."')";
    $result = mysqli_query($conexao,$sql);

    $id_prod = $result == true ? mysqli_insert_id($conexao) : false;

    $sql = "INSERT INTO preco (PRECO,IDPROD) VALUES (".$produto["PRECO"].",".$id_prod.")";
    $result = mysqli_query($conexao,$sql);
    
    return $result == true ? true: false;
  }

  function atualizar($produto,$id)
  {
    $conexao = conexaoMysql();
    $sql = "UPDATE produtos SET 
    NOME = '".$produto["NOME"]."',
    COR = '".$produto["COR"]."' WHERE IDPROD = ".$id;
    $result = mysqli_query($conexao,$sql);

    $id_prod = $result == true ? mysqli_insert_id($conexao) : false;

    $sql = "UPDATE preco SET 
    PRECO = '".$produto["PRECO"]."' WHERE IDPROD = ".$id;
    $result = mysqli_query($conexao,$sql);
    
    return $result == true ? true: false;

   
  }

  function excluir($id)
  {
    $conexao = conexaoMysql();
    $sql = "DELETE FROM produtos WHERE IDPROD = ".$id;
    $result = mysqli_query($conexao,$sql);

    $sql = "DELETE FROM preco WHERE IDPROD = ".$id;
    $result = mysqli_query($conexao,$sql);
    
    return $result == true ? true: false;
  }
