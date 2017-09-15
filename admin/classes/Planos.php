<?php
class Planos extends Create{
	private $dados;
	private $result;

	public function __construct($dados){		
		$this->dados = Helpers::limpar($dados);
	}

	public function cadastrar(){
		parent::ExeCreate('planos', (array) $this->dados);
		$this->result = parent::getResult();
	}

	public function alterar(){
		parent::ExeUpdate('planos',  (array) $this->dados, 'WHERE id = :id', 'id=' . $this->dados->id);
		$this->result = parent::getResult();
	}

	public function ler(){
		$read = new Read;
		$read->ExeRead('planos', null, null, 'id, nome');
		$this->result = $read->getResult();
	}

	public function getResult(){
		return $this->result;
	}
}