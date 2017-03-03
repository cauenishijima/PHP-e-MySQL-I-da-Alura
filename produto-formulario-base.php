			<tr>
				<td>Nome</td>
				<td><input class="form-control" type="text" name="nome" value="<?=$produto->getNome()?>"></td>
			</tr>
			<tr>
				<td>Preço</td>
				<td><input class="form-control" type="number" name="preco" value="<?=$produto->getPreco()?>"></td>
			</tr>
			<tr>
				<td>Descrição</td>
				<td><textarea class="form-control" name="descricao"><?=$produto->getDescricao()?></textarea></td>
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
								$EssaEhACategoria = ($categoria->getId() == $produto->getCategoria()->getId());
								$selecao = $EssaEhACategoria ? "selected='selected'" : "";
						?>
							<option <?=$selecao?> value="<?=$categoria->getId()?>"><?=$categoria->getNome()?></option>  
						<?php
							endforeach;
						?>
					</select>
				</td>
			</tr>

			<tr>
				<td>Tipo do produto</td>
    			<td>
        			<select name="tipoProduto" class="form-control">
        				<optgroup label="Livros">
				            <?php
					            $tipos = array("Livro Fisico","Ebook");

					            foreach($tipos as $tipo) : 
					            	$tipoSemEspaco = str_replace(' ', '', $tipo);
					                $esseEhOTipo = get_class($produto) == $tipoSemEspaco;
					                $selecaoTipo = $esseEhOTipo ? "selected='selected'" : "";
					        ?>
					                <option value="<?=$tipoSemEspaco?>" <?=$selecaoTipo?>>
					                    <?=$tipo?>
					                </option>
				            <?php
				            	endforeach
				            ?>
			            </optgroup>
       	 			</select>
    			</td>
			</tr>


			<tr>
			    <td>ISBN (caso seja um Livro)</td>
			    <td>
			        <input type="text" name="isbn" class="form-control" 
			            value="<?php if ($produto->temIsbn()) { echo $produto->getIsbn(); } ?>" >
			    </td>
			</tr>

			<tr>
			    <td>Taxa Impressao (caso seja um Livro Fisico)</td>
			    <td>
			        <input type="text" name="taxaImpressao" class="form-control" 
			            value="<?php if ($produto->temTaxaImpressao()) { echo $produto->getTaxaImpressao(); } ?>" >
			    </td>
			</tr>

			<tr>
			    <td>Marca d'agua (caso seja um Ebook)</td>
			    <td>
			        <input type="text" name="waterMark" class="form-control" 
			            value="<?php if ($produto->temWaterMark()) { echo $produto->getWaterMark(); } ?>" >
			    </td>
			</tr>