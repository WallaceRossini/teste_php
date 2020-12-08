<?php
require_once('C:/xampp/htdocs/php/infra/conexao.php');
require_once('C:/xampp/htdocs/php/models/Produto.php');
require_once('C:/xampp/htdocs/php/controllers/produto.php');

$produtos = listar();

$nome = (string) null;
$preco = (string) null;
$cor = (string) null;
$botao =  (string) "Adicionar";
$selected =  (string) '';
$atualizar = (boolean) false;

$cores = array('AZUL','AMARELO','VERMELHO');

if(isset($_SESSION['produto'])){
  $nome = $_SESSION['produto']['NOME'];
  $preco = $_SESSION['produto']['PRECO'];
  $cor = $_SESSION['produto']['COR'];
  $botao = "Salvar";
  $atualizar= true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teste - PHP</title>
  <link rel="stylesheet" href="global.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
  <section class="container">
    <section class="content">
      <section>
        <h1>Lista de Produtos</h1>
        <table>
          <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>PREÇO</th>
            <th>COR</th>
            <th>AÇÕES</th>
          </tr>
          <form action="controllers/produto.php" method="get">
            <?php
            if (is_array($produtos) || is_object($produtos)) {
              foreach ($produtos as $produto) {
                switch($produto['COR']){
                  case 'AZUL':
                   $desconto = 20;
                  break;
                  case 'AMARELO':
                    $desconto = 10;
                  break;
                  case 'VERMELHO':
                    $desconto = $produto['PRECO'] > 50.00 ? 5 : 20;
                  break;
                }
                $valor_desconto = ($produto['PRECO'] * $desconto) / 100;
                $novo_preco = number_format(($produto['PRECO'] - $valor_desconto),2,",",".");
                ?>
                <tr>
                  <td><?php echo $produto['IDPROD']; ?></td>
                  <td><?php echo $produto['NOME']; ?></td>
                  <td> R$ <?php echo $novo_preco; ?></td>
                  <td><?php echo $produto['COR']; ?></td>
                  <td>
                   <button type="submit" style="background: var(--red);" name="excluir" value="<?php echo $produto['IDPROD']; ?>">Excluir</button>
                   <button type="submit" style="background: var(--blue);"  name="atualizar" value="<?php echo $produto['IDPROD']; ?>">Atualizar</button>
                  </td>
                </tr>
            <?php }
            } ?>
          </form>
        </table>
      </section>
      <form method="post" action="controllers/produto.php">
        <input type="text" value="<?php echo $nome;?>" name="nome" placeholder="Nome do produto" required>
        <input type="text" value="<?php echo $preco;?>" name="preco" placeholder="Preço" required>
        <select name="slt_cor" <?php echo $atualizar == true ? 'disabled': '' ?> required>
        <option value="0">SELECIONE UMA COR</option>
          <?php foreach($cores as $cor_slt){
             $selected = $cor_slt == $cor ? 'selected' : '';?>
          <option value="<?php echo $cor_slt;?>" <?php echo $selected;?>><?php echo $cor_slt;?></option>
          <?php }?>
        </select>
        <input type="submit" value="<?php echo $botao;?>" name="salvar" class="button">
      </form>
    </section>
  </section>
</body>

<script>
 
</script>

</html>