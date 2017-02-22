<?php 
	require_once("cabecalho.php"); 
	require_once("banco-categoria.php");
	require_once("banco-produto.php");

	$categorias = listaCategorias($conexao);

	$id = $_GET['id'];

	$produto = buscaProduto($conexao, $id);
	$usado = $produto['usado'] ? "checked='checked'" : "";
?>

	<h1>Alteração de Produto</h1>

	<form action="altera-produto.php" method="post">
		<input type="hidden" name="id" value="<?=$produto['id']?>">
		<table class="table">
			<?php include("produto-formulario-base.php"); ?>
			<tr>
				<td><button class="btn btn-primary" type="submit">Alterar</button></td>
			</tr>
		</table>		
	</form>

<?php 
	include("rodape.php");
