<?php
	
	function listaCategorias($conexao){
		$categorias = [];
		$query = 'SELECT * FROM categorias';
		$resultado = mysqli_query($conexao,$query);

		while ($categoria = mysqli_fetch_assoc($resultado)):
			array_push($categorias, $categoria);
		endwhile;

		return $categorias;
	}