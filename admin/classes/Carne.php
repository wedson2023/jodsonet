<?php
class Carne extends Read{
	private $dados;
	private $lastDate;
	private $cliente;
	private $numero_documento;
	private $qtde_carne;

	public function __construct($dados){
		$this->dados = Helpers::limpar($dados);
		$this->dados->vencimento = date('Y-m-d', strtotime($this->dados->vencimento));

		$this->cliente();
		//$this->carne();
		$this->validacao();
	}

	public function getResult(){
		return $this->result;
	}

	private function vencimento(){
		parent::ExeRead('carne', 'WHERE cliente_id = :cliente_id',
		'cliente_id=' . $this->dados->cliente_id, 'MAX(vencimento) as vencimento');
		$this->lastDate = [ 'vencimento' => parent::getResult()[0]->vencimento ];
	}

	private function cliente(){
		$campos = 'clientes.id, clientes.desconto, planos.valor, clientes.nome, clientes.rua, clientes.bairro, clientes.cep, clientes.numero';
		parent::ExeRead('clientes inner join planos on clientes.plano = planos.id',
		'WHERE clientes.id = :id', 'id=' . $this->dados->cliente_id, $campos);
		$this->cliente = parent::getResult()[0];
	}

	private function carne(){
		$campos = 'MAX(numero) as numero_documento';
		parent::ExeRead('carne', 'WHERE cliente_id = :cliente_id GROUP BY data', 'cliente_id=' . $this->dados->cliente_id, $campos);

		$qtde = parent::getRowCount();

		$this->qtde_carne = $qtde ? $qtde + 1 : 1;
		$this->numero_documento = parent::getRowCount() ? parent::getResult()[$qtde - 1]->numero_documento + 1 : 1;
	}

	private function validacao(){
		$this->vencimento();
		if($this->dados->vencimento <= $this->lastDate['vencimento']):
				$this->result = [ 'resposta' => false, 'mensagem' => 'A data fornecida é menor ou igual que o último boleto já gerado ou seja menor que ' . date('d/m/Y', strtotime($this->lastDate['vencimento'])) . ', por favor coloque uma data com mês superior ao último carne do cliente.' ];
			elseif(date('m', strtotime($this->dados->vencimento)) <= date('m', strtotime($this->lastDate['vencimento']))):
				$this->result = [ 'resposta' => false, 'mensagem' => 'Já existe um carne com vencimento para esse mês, coloque outra data ou remova o carne correpondente ao mês que vc deseja gerar um novo boleto, data do último carne foi ' . date('d/m/Y', strtotime($this->lastDate['vencimento'])) . '.' ];
			else:
			$this->carne();

			$create = new Create;

			$html = '<style>';
				$html .= file_get_contents('../css/carne.css');
			$html .= '</style>';

			$boleto = file_get_contents('content/boleto.html');

			for($a = 0; $a < $this->dados->qtde; $a++):	

				$vencimento = date('Y-m-d', strtotime($this->dados->vencimento . ' +' . $a . ' month'));			
				
				$collection = [
					'cliente_id' => $this->dados->cliente_id,
					'vencimento' => $vencimento,
					'numero' => $this->numero_documento,
					'data' => $this->dados->vencimento
				];

				if($a >= 3 && ($a % 3) == 0):
					$html .= '<br><br><br><br><br><br><br><br><br>';
				endif;

				$html .= $this->substituir($boleto, $this->cliente, $vencimento, $this->numero_documento);

				$create->ExeCreate('carne', $collection);
				$this->numero_documento++;
			endfor;			
			$this->result = [ 'resposta' => true, 'mensagem' => $html ];
		endif;
	}

	private function substituir($html, $dados, $vencimento, $numero_documento){
		$procurar = [ 
			'#numero#', '#digito#', '#numero do documento#', '#vencimento#', '#valor documento#', "#desconto#", '#nome#', '#rua#',
			'#numero#','#bairro#', '#cep#', '#data do documento#', '#numero do documento#' ];
		$substituir = [
			$dados->id,
			$this->qtde_carne,
			$numero_documento,
			date('d/m/Y', strtotime($vencimento)),
			number_format($dados->valor, 2, ',', '.'),
			!is_null($dados->desconto) ? number_format($dados->desconto, 2, ',', '.') : '',
			$dados->nome,
			$dados->rua,
			$dados->numero,
			$dados->bairro,
			$dados->cep,
			date('d/m/Y'),
			$numero_documento
		];
		return str_replace($procurar, $substituir, $html);
	}
}