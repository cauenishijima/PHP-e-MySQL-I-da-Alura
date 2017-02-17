<?php
	include("conecta.php");

	function inserirProduto($conexao, $nome, $preco, $descricao){
		$query = "INSERT INTO produtos (nome, preco,descricao) VALUES ('{$nome}',{$preco}, '{$descricao}')";
		return mysqli_query($conexao, $query);
	}

	function removerProduto($conexao, $id){
		$query = "DELETE FROM produtos WHERE id = '{$id}'";
		return mysqli_query($conexao, $query);
	}

	function listaProdutos($conexao){
		$query = "SELECT * FROM produtos";
		$resultado = mysqli_query($conexao, $query);

		$produtos = array();
		while ($produto = mysqli_fetch_assoc($resultado)){
			array_push($produtos, $produto);
		}

		return $produtos;
	}