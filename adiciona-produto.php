<?php 
	require_once("cabecalho.php"); 	
	require_once("logica-usuario.php");
	verificaUsuario();

	$tipoProduto = $_POST['tipoProduto'];
	$categoria_id = $_POST['categoria_id'];

	$factory = new ProdutoFactory();
	$produto = $factory->criaPor($tipoProduto,$_POST);
	$produto->getCategoria()->setId($categoria_id);

	$produto->atualizaBaseadoEm($_POST);

	$produtoDao = new ProdutoDao($conexao);

	if ($produtoDao->inserirProduto($produto)) :
?>	

	<p class=text-success>Produto <?php echo $produto->getNome(); ?>, <?= $produto->getPreco();?> adicionado com sucesso!</p>

<?php
	else :

		$msg_error = mysqli_error($conexao);
?>

	<p class=text-danger>Produto <?php echo $produto->getNome(); ?> não foi adicionado : <?= $msg_error?> </p>

<?php
	endif;
	// O fechamento da conexão é opcional, o próprio PHP fecha todas as conexões no final da página
	mysqli_close($conexao);
?>

<?php 
	include("rodape.php"); 