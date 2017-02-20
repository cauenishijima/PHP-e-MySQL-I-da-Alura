<?php 
	include("cabecalho.php"); 
	include("conecta.php");
	include("banco-categoria.php");
	include("banco-produto.php");

	$categorias = listaCategorias($conexao);

	$id = $_GET['id'];
	$produto = buscaProduto($conexao, $id);

	$usado = $produto['usado'] ? "checked='checked'" : "";
?>

	<h1>Alteração de Produto</h1>

	<form action="altera-produto.php" method="post">
		<table class="table">
			<input type="hidden" name="id" value="<?=$produto['id']?>">
			<tr>
				<td>Nome</td>
				<td><input class="form-control" type="text" name="nome" value="<?=$produto['nome']?>"></td>
			</tr>
			<tr>
				<td>Preço</td>
				<td><input class="form-control" type="number" name="preco" value="<?=$produto['preco']?>"></td>
			</tr>
			<tr>
				<td>Descrição</td>
				<td><textarea class="form-control" name="descricao"><?=$produto['descricao']?></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="checkbox" name="usado" <?=$usado?> value="True">Usado</td>
			</tr>
			<tr>
				<td>Categoria</td>
				<td>
					<select name="categoria_id" class="form-control">
						<?php 
							foreach ($categorias as $categoria) :
								$EssaEhACategoria = ($categoria["id"] == $produto["categoria_id"]);
								$selecao = $EssaEhACategoria ? "selected='selected'" : "";
						?>
							<option <?=$selecao?> value="<?=$categoria['id']?>"><?=$categoria['nome']?></option>  
						<?php
							endforeach;
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><button class="btn btn-primary" type="submit">Alterar</button></td>
			</tr>
		</table>		
	</form>

<?php 
	include("rodape.php");
