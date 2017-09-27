<?php
class Carne extends Read{
	private $dados;
	private $lastDate;

	public function __construct($dados){
		$this->dados = Helpers::limpar($dados);
		$this->dados->vencimento = date('Y-m-d', strtotime($this->dados->vencimento));

		$this->validacao();
	}

	public function getResult(){
		return $this->result;
	}

	private function vencimento(){
		parent::ExeRead('carne', 'WHERE cliente_id = :cliente_id', 'cliente_id=' . $this->dados->cliente_id, 'MAX(vencimento) as vencimento');
		$this->lastDate = [ 'vencimento' => parent::getResult()[0]->vencimento ];
	}

	private function validacao(){
		$this->vencimento();
		if($this->dados->vencimento <= $this->lastDate['vencimento']):
				$this->result = [ 'resposta' => false, 'mensagem' => 'A data fornecida é menor ou igual que o último boleto já gerado ou seja menor que ' . date('d/m/Y', strtotime($this->lastDate['vencimento'])) . ', por favor coloque uma data com mês superior ao último carne do cliente.' ];
			elseif(date('m', strtotime($this->dados->vencimento)) <= date('m', strtotime($this->lastDate['vencimento']))):
				$this->result = [ 'resposta' => false, 'mensagem' => 'Já existe um carne com vencimento para esse mês, coloque outra data ou remova o carne correpondente ao mês que vc deseja gerar um novo boleto, data do último carne foi ' . date('d/m/Y', strtotime($this->lastDate['vencimento'])) . '.' ];
			else:
			$create = new Create;
			for($a = 0; $a < $this->dados->qtde; $a++):

				$collection = [
					'cliente_id' => $this->dados->cliente_id,
					'vencimento' => date('Y-m-d', strtotime($this->dados->vencimento . ' +' . $a . ' month'))
				];

				$create->ExeCreate('carne', $collection);
			endfor;

			$this->result = [ 'resposta' => true, 'mensagem' => 'Carner gerado com sucesso!'];
		endif;
	}
}