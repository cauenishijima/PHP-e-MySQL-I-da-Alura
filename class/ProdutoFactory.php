<?php 
	class ProdutoFactory{

		private $classes = array("LivroFisico","Ebook");

		public function criaPor($tipoProduto,$params){
			$nome = $params['nome'];
			$preco = $params['preco'];
			$descricao = $params['descricao'];
			$categoria = new Categoria();
			if (array_key_exists('usado', $params)) {
				$usado = "true";
			} else {
				$usado = "false";
			}



			if (in_array($tipoProduto, $this->classes)){
				return new $tipoProduto($nome,$preco,$descricao,$categoria,$usado);
			} else {
				return new LivroFisico($nome,$preco,$descricao,$categoria,$usado);
			}
		}
	}
