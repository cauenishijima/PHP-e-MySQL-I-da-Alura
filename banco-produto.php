<?php
	require_once("conecta.php");

	function inserirProduto($conexao, Produto $produto){
		$query = "INSERT INTO produtos (nome, preco,descricao,categoria_id, usado) VALUES ('{$produto->getNome()}',{$produto->getPreco()}, '{$produto->getDescricao()}', {$produto->getCategoria()->getId()}, {$produto->getUsado()})";
		return mysqli_query($conexao, $query);
	}

	function alteraProduto($conexao, Produto $produto){
		$query = "UPDATE produtos SET nome = '{$produto->getNome()}', preco = {$produto->getPreco()}, descricao = '{$produto->getDescricao()}', categoria_id = {$produto->getCategoria()->getId()}, usado = {$produto->getUsado()} WHERE id = '{$produto->getId()}'";
		return mysqli_query($conexao, $query);
	}

	function removerProduto($conexao, $id){
		$query = "DELETE FROM produtos WHERE id = '{$id}'";
		return mysqli_query($conexao, $query);
	}

	function listaProdutos($conexao){
		$query = "SELECT p.*, c.nome AS categoria_nome FROM produtos p JOIN categorias c ON (p.categoria_id = c.id) ORDER BY p.id";
		$resultado = mysqli_query($conexao, $query);

		$produtos = array();
		while ($produto_array = mysqli_fetch_assoc($resultado)){

			$categoria = new Categoria();
			$categoria->setNome($produto_array["categoria_nome"]); 

			$nome = $produto_array["nome"];
			$preco = $produto_array["preco"];
			$descricao = $produto_array["descricao"];
			$usado = $produto_array["usado"];

			$produto = new Produto($nome,$preco,$descricao,$categoria,$usado);
			$produto->setId($produto_array["id"]);

			array_push($produtos, $produto);
		}

		return $produtos;
	}

	function buscaProduto($conexao, $id){
		$query = "SELECT * FROM produtos WHERE id = {$id}";
		$resultado = mysqli_query($conexao, $query);
		$produto_buscado = mysqli_fetch_assoc($resultado);

		$categoria = new Categoria();
    	$categoria->setId($produto_buscado['categoria_id']);

		$nome = $produto_buscado["nome"];
		$preco = $produto_buscado["preco"];
		$descricao = $produto_buscado["descricao"];
		$usado = $produto_buscado["usado"];

		$produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
		$produto->setId($produto_buscado["id"]);

		return $produto;
	}