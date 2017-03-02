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

			$tipoProduto = get_class($produto);

			$query = "INSERT INTO produtos (nome, preco,descricao,categoria_id, usado, isbn, tipoProduto) VALUES ('{$produto->getNome()}',{$produto->getPreco()}, '{$produto->getDescricao()}', {$produto->getCategoria()->getId()}, {$produto->getUsado()}, '{$isbn}', '{$tipoProduto}')";

			return mysqli_query($this->conexao, $query);
		}

		function alteraProduto(Produto $produto){
			$isbn = "";
			if ($produto->temIsbn()) {
				$isbn = $produto->getIsbn();
			} 

			$tipoProduto = get_class($produto);

			$query = "UPDATE produtos SET nome = '{$produto->getNome()}', preco = {$produto->getPreco()}, descricao = '{$produto->getDescricao()}', categoria_id = {$produto->getCategoria()->getId()}, usado = {$produto->getUsado()}, isbn = '{$isbn}', tipoProduto = '{$tipoProduto}' WHERE id = '{$produto->getId()}'";
			return mysqli_query($this->conexao, $query);
		}

		function removerProduto($id){
			$query = "DELETE FROM produtos WHERE id = '{$id}'";
			return mysqli_query($this->conexao, $query);
		}

		function listaProdutos(){
			$query = "SELECT p.*, c.nome AS categoria_nome FROM produtos p JOIN categorias c ON (p.categoria_id = c.id) ORDER BY p.id";
			$resultado = mysqli_query($this->conexao, $query);

			$produtos = array();
			while ($produto_array = mysqli_fetch_assoc($resultado)){

				$categoria = new Categoria();
				$categoria->setNome($produto_array["categoria_nome"]); 

				$nome = $produto_array["nome"];
				$preco = $produto_array["preco"];
				$descricao = $produto_array["descricao"];
				$usado = $produto_array["usado"];
				$isbn = $produto_array["isbn"];
				$tipoProduto = $produto_array["tipoProduto"];

				if ($tipoProduto == "Livro") {
					$produto = new Livro($nome,$preco,$descricao,$categoria,$usado);
					$produto->setIsbn($isbn);
				} else {
					$produto = new Produto($nome,$preco,$descricao,$categoria,$usado);	
				}
				
				$produto->setId($produto_array["id"]);

				array_push($produtos, $produto);
			}

			return $produtos;
		}

		function buscaProduto($id){
			$query = "SELECT * FROM produtos WHERE id = {$id}";
			$resultado = mysqli_query($this->conexao, $query);
			$produto_buscado = mysqli_fetch_assoc($resultado);

			$categoria = new Categoria();
	    	$categoria->setId($produto_buscado['categoria_id']);

			$nome = $produto_buscado["nome"];
			$preco = $produto_buscado["preco"];
			$descricao = $produto_buscado["descricao"];
			$usado = $produto_buscado["usado"];
			$isbn = $produto_buscado["isbn"];
			$tipoProduto = $produto_buscado["tipoProduto"];

			if ($tipoProduto == "Livro") {
				$produto = new Livro($nome, $preco, $descricao, $categoria, $usado);
				$produto->setIsbn($isbn);
			} else {
				$produto = new Produto($nome, $preco, $descricao, $categoria, $usado);	
			}

			$produto->setId($produto_buscado["id"]);

			return $produto;
		}
	}