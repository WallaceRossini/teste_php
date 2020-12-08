<?php 
  require_once('C:/xampp/htdocs/php/models/Produto.php');
  session_start();
  if(isset($_POST['salvar'])){
    $nome = $_POST['nome'];
    $preco = str_replace(',','.',$_POST['preco']);
    $cor = isset($_SESSION['produto']['COR']) ? $_SESSION['produto']['COR'] : $_POST['slt_cor'];

    $obj = array(
      'NOME'=>$nome,
      'COR'=>$cor,
      'PRECO'=>$preco);

   $retorno = isset($_SESSION['produto']) ?  atualizar($obj,$_SESSION['produto']['IDPROD']) : adicionar($obj);

   session_destroy();

   $retorno == true ?  header('location:../index.php') :  header('location:../index.php');
  }
  

  if(isset($_GET['excluir'])){
      $id = $_GET['excluir'];

      $retorno = excluir($id);

      $retorno == true ?  header('location:../index.php') :  header('location:../index.php');
  }
  if(isset($_GET['atualizar'])){
      $id = $_GET['atualizar'];

      $retorno = buscarPorId($id);
      $_SESSION['produto'] = $retorno;

      $retorno == true ?  header('location:../index.php') :  header('location:../index.php');

  }
