<?php
	include("conecta.php");

	function inserirProduto($conexao, $nome, $preco, $descricao, $categoria_id){
		$query = "INSERT INTO produtos (nome, preco,descricao,categoria_id) VALUES ('{$nome}',{$preco}, '{$descricao}', {$categoria_id})";
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