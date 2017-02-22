<?php 
	require_once("logica-usuario.php");
	verificaUsuario();

	require_once("cabecalho.php"); 
	require_once("banco-categoria.php");

	$categorias = listaCategorias($conexao);

	$produto = array('nome' => '', 'preco' => '', 'descricao' => '', 'categoria_id' => 1);
	$usado = "";
?>

	<h1>Formulário de Produto</h1>

	<form action="adiciona-produto.php" method="post">
		<table class="table">
			<?php include("produto-formulario-base.php"); ?>
			<tr>
				<td><button class="btn btn-primary" type="submit">Cadastrar</button></td>
			</tr>
		</table>		
	</form>

<?php 
	include("rodape.php");
