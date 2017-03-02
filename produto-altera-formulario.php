<?php 
	require_once("cabecalho.php"); 
	
	$categoriaDao = new CategoriaDao($conexao);
	$categorias = $categoriaDao->listaCategorias();

	$id = $_GET['id'];

	$produtoDao = new ProdutoDao($conexao);
	$produto = $produtoDao->buscaProduto($id);
	$usado = $produto->getUsado() ? "checked='checked'" : "";
?>

	<h1>Alteração de Produto</h1>

	<form action="altera-produto.php" method="post">
		<input type="hidden" name="id" value="<?=$produto->getId()?>">
		<table class="table">
			<?php include("produto-formulario-base.php"); ?>
			<tr>
				<td><button class="btn btn-primary" type="submit">Alterar</button></td>
			</tr>
		</table>		
	</form>

<?php 
	include("rodape.php");
