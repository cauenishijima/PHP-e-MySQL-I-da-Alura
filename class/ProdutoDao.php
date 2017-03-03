<?php 
	class ProdutoDao
	{
		private $conexao;

		function __construct($conexao){
			$this->conexao = $conexao;
		}

		function inserirProduto(Produto $produto){
			$isbn = "";
			if ($produto->temIsbn()) {
				$isbn = $produto->getIsbn();
			} 

			$waterMark = "";
			if ($produto->temWaterMark()) {
				$waterMark = $produto->getWaterMark();
			}

			$taxaImpressao = "";
			if ($produto->temTaxaImpressao()){
				$taxaImpressao = $produto->getTaxaImpressao();
			}

			$tipoProduto = get_class($produto);

			$query = "INSERT INTO produtos (nome, preco,descricao,categoria_id, usado, isbn, tipoProduto, taxaImpressao, waterMark) VALUES ('{$produto->getNome()}',{$produto->getPreco()}, '{$produto->getDescricao()}', {$produto->getCategoria()->getId()}, {$produto->getUsado()}, '{$isbn}', '{$tipoProduto}','{$taxaImpressao}','{$waterMark}')";

			return mysqli_query($this->conexao, $query);
		}

		function alteraProduto(Produto $produto){
			$isbn = "";
			if ($produto->temIsbn()) {
				$isbn = $produto->getIsbn();
			} 

			$waterMark = "";
			if ($produto->temWaterMark()) {
				$waterMark = $produto->getWaterMark();
			}

			$taxaImpressao = "";
			if ($produto->temTaxaImpressao()){
				$taxaImpressao = $produto->getTaxaImpressao();
			}

			$tipoProduto = get_class($produto);

			$query = "UPDATE produtos SET nome = '{$produto->getNome()}', preco = {$produto->getPreco()}, descricao = '{$produto->getDescricao()}', categoria_id = {$produto->getCategoria()->getId()}, usado = {$produto->getUsado()}, isbn = '{$isbn}', tipoProduto = '{$tipoProduto}', taxaImpressao = '{$taxaImpressao}', waterMark = '{$waterMark}' WHERE id = '{$produto->getId()}'";

			echo $query;

			return mysqli_query($this->conexao, $query);
		}

		function removerProduto($id){
			$query = "DELETE FROM produtos WHERE id = '{$id}'";
			return mysqli_query($this->conexao, $query);
		}

		function listaProdutos(){
			$query = "SELECT p.*, c.nome AS categoria_nome FROM produtos p JOIN categorias c ON (p.categoria_id = c.id) ORDER BY p.id";
			$resultado = mysqli_query($this->conexao, $query);

			$factory = new ProdutoFactory();

			$produtos = array();
			while ($produto_array = mysqli_fetch_assoc($resultado)){
				$tipoProduto = $produto_array["tipoProduto"];
				$produto_id = $produto_array["id"];
				$categoria_nome = $produto_array["categoria_nome"];

				$produto = $factory->criaPor($tipoProduto, $produto_array);
				$produto->getCategoria()->setNome($categoria_nome);
				$produto->setId($produto_id);
				$produto->atualizaBaseadoEm($produto_array);

				array_push($produtos, $produto);
			}

			return $produtos;
		}

		function buscaProduto($id){
			$query = "SELECT * FROM produtos WHERE id = {$id}";
			$resultado = mysqli_query($this->conexao, $query);
			$produto_buscado = mysqli_fetch_assoc($resultado);

			$tipoProduto = $produto_buscado["tipoProduto"];
			$categoria_id = $produto_buscado['categoria_id'];
			$produto_id = $produto_buscado["id"];

			$factory = new ProdutoFactory();
			$produto = $factory->criaPor($tipoProduto,$produto_buscado);
			$produto->setId($produto_id);
			$produto->getCategoria()->setId($categoria_id);
			$produto->atualizaBaseadoEm($produto_buscado);			

			return $produto;
		}
	}