<?php 
	require_once('cabecalho.php'); 

	$categoria = new Categoria();
	$categoria->setId($_POST['categoria_id']);

	$nome = $_POST['nome'];
	$preco = $_POST['preco'];
	$descricao = $_POST['descricao'];
	$tipoProduto = $_POST['tipoProduto'];
	$isbn = $_POST['isbn'];

	if (array_key_exists('usado', $_POST)) {
		$usado = "true";
	} else {
		$usado = "false" ;
	}

	if ($tipoProduto == "Livro"){
		$produto = new Livro($nome,$preco,$descricao,$categoria,$usado);
		$produto->setIsbn($isbn);
	} else {
		$produto = new Produto($nome,$preco,$descricao,$categoria,$usado);
	}
	
	$produto->setId($_POST['id']);

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