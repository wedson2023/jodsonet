<?php
class Login extends Read{
	private $dados;
	private $result;

	public function __construct($dados){		
		$this->dados = Helpers::limpar($dados);
		$this->leitura();
	}

	private function leitura(){
		parent::ExeRead('login', 'WHERE nome = :nome', 'nome=' . $this->dados->nome, 'senha, token');
		if(parent::getRowCount()):
			foreach(parent::getResult() as $dados):
				if($dados->senha == md5($this->dados->senha)):
					session_start();
					$_SESSION['token'] = $dados->token;
					$this->result = [ 'resposta' => true, 'token' => $dados->token ];
				endif;
			endforeach;
		endif;
	}

	public function getResult(){
		return $this->result;
	}
}