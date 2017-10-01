	<section class="listar conteiner animated bounceInUp">
		<div class="pesquisar">
			<input type="search" class="nome" ng-model="nome" placeholder="Digite um nome" />
			<input type="search" class="id" ng-model="id" placeholder="Digite um id" />
		</div>
		<div id="clientes" class="clientes scroll">					
			<div class="listar_carne" ng-repeat="carne in ctrl.carne | filter : { nome : nome, id : id }">
				<span class="nome" ng-bind="carne.nome.substr(0,10)"></span>
				<span class="numero" ng-bind="carne.numero"></span>
				<span class="vencimento" ng-bind="carne.vencimento | date : 'dd/MM/yyyy'"></span>
				<span class="status" ng-class=" carne.status == 1 ? 'pago' : ( carne.status == 2 ? 'atrasado' : null)" ng-bind="carne.status | opcao"></span>
				<span class="excluir" ng-click="ctrl.excluir_carne(carne)">Excluir</span>
				<span class="baixa" ng-click="ctrl.dar_baixa(carne)">Dar baixa</span>
			</div>				
		</div>
	</section>