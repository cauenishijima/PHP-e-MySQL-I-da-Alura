<?php 
	require_once('cabecalho.php'); 

	$tipoProduto = $_POST['tipoProduto'];
	

	$categoria_id = $_POST['categoria_id'];
	$produto_id = $_POST['id'];

	$factory = new ProdutoFactory();
	
	$produto = $factory->criaPor($tipoProduto, $_POST);
	$produto->getCategoria()->setId($categoria_id);
	$produto->setId($produto_id);

	$produto->atualizaBaseadoEm($_POST);

	$produtoDao = new ProdutoDao($conexao);

	if ($produtoDao->alteraProduto($produto)) :
?>	

	<p class=text-success>Produto <?php echo $produto->getNome() ?>, <?= $produto->getPreco()?> alterado com sucesso!</p>

<?php
	else :

		$msg_error = mysqli_error($conexao);
?>

	<p class=text-danger>Produto <?php echo $produto->getNome(); ?> não foi alterado : <?= $msg_error?> </p>

<?php
	endif;
	// O fechamento da conexão é opcional, o próprio PHP fecha todas as conexões no final da página
	mysqli_close($conexao);
?>

<?php 
	include("rodape.php"); 