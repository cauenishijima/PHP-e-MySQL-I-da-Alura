<?php
 	class Produto
	{
		private $id;
		private $nome;
		private $preco;
		private $descricao;
		private $categoria;
		private $usado;
		private $tipoProduto;

		function __construct($nome,$preco,$descricao,Categoria $categoria,$usado){
			$this->nome = $nome;
			$this->preco = $preco;
			$this->descricao = $descricao;
			$this->categoria = $categoria;
			$this->usado = $usado;
		}

		function _toString(){
			return $this->nome . " | R$ " . $this->preco . " | " . $this->descricao;
		}

		public function temIsbn(){
			return $this instanceof Livro;
		}


		public function getId(){
			return $this->id;
		}
		public function getNome(){
			return $this->nome;
		}

		public function getPreco(){
			return $this->preco;
		}

		public function getDescricao(){
			return $this->descricao;
		}

		public function getCategoria(){
			return $this->categoria;
		}

		public function getUsado(){
			return $this->usado;
		}

		public function getTipoProduto(){
			return $this->tipoProduto;
		}

		public function setTipoProduto($tipoProduto){
			$this->tipoProduto = $tipoProduto;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function setUsado($usado){
			$this->usado = $usado;
		}

		public function precoComDesconto($valor = 0.1){
			$valorComDesconto = $this->preco;

			if ($valor > 0 && $valor <= 0.5){
				$valorComDesconto *= (1 - $valor); 
			}
			return $valorComDesconto;
		}
	}