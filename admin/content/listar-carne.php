	<section class="carne conteiner animated bounceInUp">
		<div class="pesquisar">
			<div>
				<input type="search" class="nome" ng-model="nome" placeholder="Digite um nome" />
				<input type="search" class="id" ng-model="numero" placeholder="Digite o número" />	
			</div>
			<form ng-submit="ctrl.listar_carne(dados)">
				<fieldset>
					<select ng-model="dados.status">
						<option value="">Status</option>
						<option value="2">Atrasados</option>
						<option value="1">Pagos</option>
						<option value="0">Aguardando</option>
					</select>	
					<input title="Coloque uma data de início" required type="date" class="inicio" ng-model="dados.inicio">
					<input title="Coloque uma data final" required type="date" class="fim" ng-model="dados.fim">
					<input type="submit" value="Buscar">	
				</fieldset>
			</form>
		</div>
		<div id="clientes" class="clientes scroll">					
			<div class="listar_carne" ng-repeat="carne in ctrl.carne | filter : { nome : nome, numero : numero }">
				<span class="nome" ng-bind="carne.nome.substr(0,10)"></span>
				<span class="numero" ng-bind="carne.numero"></span>
				<span class="vencimento" ng-bind="carne.vencimento | date : 'dd/MM/yyyy'"></span>
				<span class="status" ng-class=" carne.status == 1 ? 'pago' : ( carne.status == 2 ? 'atrasado' : null)" ng-bind="carne.status | opcao"></span>
				<span class="excluir" ng-click="ctrl.excluir_carne(carne)">Excluir</span>
				<span class="baixa" ng-click="ctrl.dar_baixa(carne)">Dar baixa</span>
			</div>				
		</div>
	</section>
