	<section class="listar conteiner animated bounceInUp">
		<input type="search" ng-model="pesquisar" placeholder="Digite um segmento" />
		<div class="header">
			<span class="capitalize nome">Nome</span>
			<span class="capitalize cidade">Cidade</span>
			<span class="capitalize telefone">telefone</span>
			<span class="capitalize plano">Plano</span>
			<span class="capitalize valor">Valor</span>
		</div>
		<div id="clientes" class="clientes scroll">
			<div class="body" ng-repeat="cliente in ctrl.clientes | filter : pesquisar" toque>
				<span class="capitalize nome" ng-bind="cliente.nome"></span>
				<span class="capitalize cidade" ng-bind="cliente.cidade"></span>
				<span class="capitalize telefone" ng-bind="cliente.celular"></span>
				<span class="capitalize plano" ng-bind="cliente.plano"></span>
				<span class="capitalize valor" ng-bind="cliente.valor"></span>
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
							<form ng-submit="ctrl.gerar(data)">
								<input type="date" required ng-model="data"/>
								<input type="submit" value="Gerar" />
							</form>
						</li>
						<li><a class="deletar" ng-click="ctrl.deletar(cliente)">Deletar</a><a class="alterar" ng-href="alterar-cliente/{{ cliente.id }}">Alterar</a></li>
					</ul>				
				</span>
			</div>
		</div>
	</section>