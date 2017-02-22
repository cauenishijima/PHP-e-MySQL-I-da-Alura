<?php
	require_once("conecta.php");

	function inserirProduto($conexao, $nome, $preco, $descricao, $categoria_id, $usado){
		$query = "INSERT INTO produtos (nome, preco,descricao,categoria_id, usado) VALUES ('{$nome}',{$preco}, '{$descricao}', {$categoria_id}, {$usado})";
		return mysqli_query($conexao, $query);
	}

	function alteraProduto($conexao, $id, $nome, $preco, $descricao, $categoria_id, $usado){
		$query = "UPDATE produtos SET nome = '{$nome}', preco = {$preco}, descricao = '{$descricao}', categoria_id = {$categoria_id}, usado = {$usado} WHERE id = '{$id}'";
		return mysqli_query($conexao, $query);
	}

	function removerProduto($conexao, $id){
		$query = "DELETE FROM produtos WHERE id = '{$id}'";
		return mysqli_query($conexao, $query);
	}

	function listaProdutos($conexao){
		$query = "SELECT p.*, c.nome AS categoria_nome FROM produtos p JOIN categorias c ON (p.categoria_id = c.id)";
		$resultado = mysqli_query($conexao, $query);

		$produtos = array();
		while ($produto = mysqli_fetch_assoc($resultado)){
			array_push($produtos, $produto);
		}

		return $produtos;
	}

	function buscaProduto($conexao, $id){
		$query = "SELECT * FROM produtos WHERE id = {$id}";
		$resultado = mysqli_query($conexao, $query);
		return mysqli_fetch_assoc($resultado);
	}