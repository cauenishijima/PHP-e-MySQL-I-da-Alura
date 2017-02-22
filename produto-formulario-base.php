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