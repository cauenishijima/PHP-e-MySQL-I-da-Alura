<?php 
	include("cabecalho.php"); 
	include("conecta.php");


	function inserirProduto($conexao, $nome, $preco){
		$query = "INSERT INTO produtos (nome, preco) VALUES ('{$nome}',{$preco})";
		return mysqli_query($conexao, $query);
	}

	$nome = $_GET["nome"];
	$preco = $_GET["preco"];


	if (inserirProduto($conexao,$nome,$preco)) {
?>	

	<p class=text-success>Produto <?php echo $nome; ?>, <?= $preco;?> adicionado com sucesso!</p>

<?php
	} else {

	$msg_error = mysqli_error($conexao);
?>

	<p class=text-danger>Produto <?php echo $nome; ?> não foi adicionado : <?= $msg_error?> </p>

<?php
	}
	// O fechamento da conexão é opcional, o próprio PHP fecha todas as conexões no final da página
	mysqli_close($conexao);
?>

<?php include("rodape.php"); ?>