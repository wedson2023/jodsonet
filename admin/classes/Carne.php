<?php
class Carne extends Read{
	private $dados;
	private $lastDate;
	private $cliente;
	private $numero_documento;
	private $qtde_carne;

	public function __construct($dados){
		$this->dados = $dados;
		$this->dados->vencimento = isset($this->dados->vencimento) ? date('Y-m-d', strtotime($this->dados->vencimento)) : null;

		$this->cliente();
	}

	public function getResult(){
		return $this->result;
	}

	private function vencimento(){
		parent::ExeRead('carne', 'WHERE cliente_id = :cliente_id',
		'cliente_id=' . $this->dados->cliente_id, 'MAX(vencimento) as vencimento');
		if(parent::getRowCount()):
			$this->lastDate = [ 'vencimento' => parent::getResult()[0]->vencimento ];
		endif;
	}

	private function cliente(){
		$campos = 'clientes.id, clientes.desconto, planos.valor, planos.desc, clientes.nome, clientes.rua, clientes.bairro, clientes.cep, clientes.numero';
		parent::ExeRead('clientes inner join planos on clientes.plano = planos.id',
		'WHERE clientes.id = :id', 'id=' . $this->dados->cliente_id, $campos);
		foreach(parent::getResult() as $dados):
			$this->cliente = $dados;
		endforeach;
	}

	private function carne(){
		$campos = 'MAX(numero) as numero_documento';
		parent::ExeRead('carne', 'WHERE cliente_id = :cliente_id GROUP BY data', 'cliente_id=' . $this->dados->cliente_id, $campos);

		$qtde = parent::getRowCount();

		$this->qtde_carne = $qtde ? $qtde + 1 : 1;
		$this->numero_documento = parent::getRowCount() ? parent::getResult()[$qtde - 1]->numero_documento + 1 : 1;
	}

	public function segunda_via(){		
		$campos = 'MAX(numero) as numero_documento';
		parent::ExeRead('carne', 'WHERE cliente_id = :cliente_id GROUP BY data',
		'cliente_id=' . $this->dados->cliente_id, $campos);

		$qtde = parent::getRowCount();

		$this->qtde_carne = $qtde ? $qtde : 1;

		parent::ExeRead('clientes inner join planos ');
		$campos = 'clientes.id, clientes.desconto, planos.valor, planos.desc,  clientes.nome, clientes.rua, clientes.bairro, clientes.cep, clientes.numero';
		parent::ExeRead('clientes inner join planos on clientes.plano = planos.id',
		'WHERE clientes.id = :id', 'id=' . $this->dados->cliente_id, $campos);
		
		$html = '<style>';
			$html .= file_get_contents('../css/carne.css');
		$html .= '</style>';

		$boleto = file_get_contents('content/boleto.html');

		foreach(parent::getResult() as $dados):
			parent::ExeRead('carne', 'WHERE cliente_id = :cliente_id and data = (SELECT data FROM carne WHERE cliente_id = ' . $dados->id . ' and  Month(vencimento) = ' . date('n') . ' and Year(vencimento) = ' . date('Y') . ') ORDER BY numero', 'cliente_id=' . $dados->id);
			if(parent::getRowCount()):
				foreach(parent::getResult() as $carne):

					if($dados->numero >= 3 && ($dados->numero % 3) == 0):
						$html .= '<br><br><br><br><br><br><br><br><br>';
					endif;

					$html .= $this->substituir($boleto, $dados, $carne->vencimento, $carne->numero);

					$this->result = [ 'resposta' => true, 'mensagem' => $html ];
				endforeach;
				else:
				parent::ExeRead('carne', 'WHERE cliente_id = :cliente_id ORDER BY numero DESC', 'cliente_id=' . $dados->id);
				if(parent::getRowCount()):
					
					foreach(parent::getResult() as $carne):

						if($carne->numero >= 3 && ($carne->numero % 3) == 0):
							$html .= '<br><br><br><br><br><br><br><br><br>';
						endif;

						$html .= $this->substituir($boleto, $dados, $carne->vencimento, $carne->numero);

						$this->result = [ 'resposta' => true, 'mensagem' => $html ];
					endforeach;
				else:
					$this->result = [ 'resposta' => false, 'mensagem' => 'Não existe carner gerado para esse cliente.' ];
				endif;
			endif;
			
		endforeach;
		

	}

	public function validacao(){
		$this->vencimento();
		if($this->dados->vencimento <= $this->lastDate['vencimento']):
				$this->result = [ 'resposta' => false, 'mensagem' => 'A data fornecida é menor ou igual que o último boleto já gerado ou seja menor que ' . date('d/m/Y', strtotime($this->lastDate['vencimento'])) . ', por favor coloque uma data com mês superior ao último carne do cliente.' ];
			elseif(isset($this->lastDate['vencimento']) && date('m', strtotime($this->dados->vencimento)) <= date('m', strtotime($this->lastDate['vencimento']))):
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
					'cliente_id' => addslashes(strip_tags(trim($this->dados->cliente_id))),
					'vencimento' => addslashes(strip_tags(trim($vencimento))),
					'numero' => addslashes(strip_tags(trim($this->numero_documento))),
					'data' => addslashes(strip_tags(trim($this->dados->vencimento)))
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
			'#numero_casa#','#bairro#', '#cep#', '#data do documento#', '#numero do documento#', '#desc#' ];
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
			$numero_documento,
			number_format($dados->desc, 2, ',', '.')
		];
		return str_replace($procurar, $substituir, $html);
	}
}
