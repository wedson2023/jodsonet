<?php
class Clientes extends Create{
	private $dados;
	private $result;

	public function __construct($dados){		
		$this->dados = Helpers::limpar($dados);
	}

	public function cadastrar(){
		parent::ExeCreate('clientes', (array) $this->dados);
		$this->result = parent::getResult();
	}

	public function alterar(){
		$up = new Update;
		$up->ExeUpdate('clientes',  (array) $this->dados, 'WHERE id = :id', 'id=' . $this->dados->id);
		$this->result = $up->getResult();
	}

	public function getResult(){
		return $this->result;
	}
}