<?php
	include("conecta.php");

	function inserirProduto($conexao, $nome, $preco){
		$query = "INSERT INTO produtos (nome, preco) VALUES ('{$nome}',{$preco})";
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