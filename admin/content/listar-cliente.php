	<section class="listar conteiner animated bounceInUp">
		<div class="pesquisar">
			<input type="search" class="nome" ng-model="nome" placeholder="Digite um nome" />
			<input type="search" class="id" ng-model="id" placeholder="Digite um id" />
		</div>
		<div class="header">
			<span class="capitalize nome">Nome</span>
			<span class="capitalize cidade">Cidade</span>
			<span class="capitalize telefone">telefone</span>
			<span class="capitalize plano">Plano</span>
			<span class="capitalize valor">Valor</span>			
			<span class="capitalize down"><img class="icon" src="../imagens/down.png"></span>
			<span class="capitalize via"><img class="icon" src="../imagens/2via_white.png"></span>
		</div>
		<div id="clientes" class="clientes scroll">
			<div class="body" ng-repeat="cliente in ctrl.clientes | filter : { nome : nome, id : id }">
				<span class="capitalize nome" ng-bind="cliente.nome.substr(0,10)"></span>
				<span class="capitalize cidade" ng-bind="cliente.cidade.substr(0,10)"></span>
				<span class="capitalize telefone" ng-bind="cliente.celular.substr(0,15)"></span>
				<span class="capitalize plano" ng-bind="cliente.plano.substr(0,10)"></span>
				<span class="capitalize valor" ng-bind="cliente.valor.substr(0,7)"></span>				
				<span class="capitalize down"><img class="icon" title="Detalhes" toque src="../imagens/down-black.png"></span>
				<span class="capitalize via"><img class="icon" title="Emitir segunda vía" ng-click="ctrl.segunda_via(cliente)" src="../imagens/2via_black.png"></span>
				<div class="conteiner">
					<span class="capitalize informacoes">
						<ul>
							<li><strong>Nome:</strong> <p class="capitalize" ng-bind="cliente.nome"></p></li>
							<li><strong>Apelido:</strong> <p class="capitalize" ng-bind="cliente.apelido"></p></li>
							<li><strong>Celular:</strong> <p class="capitalize" ng-bind="cliente.celular"></p></li>
							<li><strong>CPF:</strong> <p class="capitalize" ng-bind="cliente.cpf"></p></li>
							<li><strong>Plano:</strong> <p class="capitalize" ng-bind="cliente.plano"></p></li>
							<li><strong>Desconto:</strong> <p class="capitalize" ng-bind="cliente.desconto"></p></li>
						</ul>
						<ul>					
							<li><strong>Cidade:</strong> <p class="capitalize" ng-bind="cliente.cidade"></p></li>
							<li><strong>CEP:</strong> <p class="capitalize" ng-bind="cliente.cep"></p></li>
							<li><strong>Rua:</strong> <p class="capitalize" ng-bind="cliente.rua"></p></li>
							<li><strong>Número:</strong> <p class="capitalize" ng-bind="cliente.numero"></p></li>
							<li><strong>Bairro:</strong> <p class="capitalize" ng-bind="cliente.bairro"></p></li>
							<li><strong>Cadastro:</strong> <p class="capitalize" ng-bind="cliente.created_at | date"></p></li>					
						</ul>
						<ul>					
							<li>
								<form ng-submit="ctrl.gerar({ vencimento : vencimento, qtde : qtde, cliente_id : cliente.id })">
									<input type="date" required ng-model="vencimento"/>
									<input type="text" required pattern="[0-9]+$" ng-model="qtde" ng-init="qtde = 6"/>
									<input type="submit" value="Gerar" />
								</form>
							</li>
							<li><a class="deletar" ng-click="ctrl.deletar(cliente)">Deletar</a><a class="alterar" ng-href="alterar-cliente{{ cliente.id }}">Alterar</a></li>
						</ul>				
					</span>				
				</div> <!-- // final do conteiner -->
				<div class="conteiner">				
					<div class="carne" ng-repeat="carne in cliente.carne">
						<span class="numero" ng-bind="carne.numero"></span>
						<span class="vencimento" ng-bind="carne.vencimento | date : 'dd/MM/yyyy'"></span>
						<span class="status" ng-class=" carne.status == 1 ? 'pago' : ( carne.status == 2 ? 'atrasado' : null)" ng-bind="carne.status | opcao"></span>
						<span class="excluir" ng-click="ctrl.excluir_carne(carne)">Excluir</span>
						<span class="baixa" ng-click="ctrl.dar_baixa(carne)">Dar baixa</span>
					</div>
				</div>
			</div>
		</div>
	</section>