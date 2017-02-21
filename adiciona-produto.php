<?php 
	include("logica-usuario.php");

	verificaUsuario();

	include('cabecalho.php'); 
	include('conecta.php');
	include('banco-produto.php');

	$nome = $_POST['nome'];
	$preco = $_POST['preco'];
	$descricao = $_POST['descricao'];
	$categoria_id = $_POST['categoria_id'];
	if (array_key_exists('usado', $_POST)) {
		$usado = "true";
	} else {
		$usado = "false";
	}


	if (inserirProduto($conexao,$nome,$preco,$descricao,$categoria_id, $usado)) :
?>	

	<p class=text-success>Produto <?php echo $nome; ?>, <?= $preco;?> adicionado com sucesso!</p>

<?php
	else :

		$msg_error = mysqli_error($conexao);
?>

	<p class=text-danger>Produto <?php echo $nome; ?> não foi adicionado : <?= $msg_error?> </p>

<?php
	endif;
	// O fechamento da conexão é opcional, o próprio PHP fecha todas as conexões no final da página
	mysqli_close($conexao);
?>

<?php 
	include("rodape.php"); 