	<section class="cadastro conteiner animated bounceInUp">
		<form class="formulario" ng-submit="ctrl.cadastrar(ctrl.cadastro)">
		<article>			
			<fieldset>
				<legend>Informações Pessoais</legend>				
			<label>
				<input type="text" required placeholder="Nome" ng-model="ctrl.cadastro.nome" />
			</label>				
			<label>
				<input type="text" placeholder="Apelido" ng-model="ctrl.cadastro.apelido"/>
			</label>
			<label>
				<input type="text" title="Digite um número de celular" required ui-mask="{{ctrl.celular}}" ng-model="ctrl.cadastro.celular" />
			</label>
			<label>
				<input type="text" title="Digite seu CPF" required ui-mask="{{ctrl.cpf}}" ng-model="ctrl.cadastro.cpf" />
			</label>
			<label>
				<select class="plano" ng-options="planos.id as planos.nome for planos in ctrl.planos" required ng-model="ctrl.cadastro.plano">
					<option value="">Selecione um plano</option>
				</select>
				<input type="text" class="desconto" pattern="[0-9]+$" title="Desconto" placeholder="% Desconto" ng-model="ctrl.cadastro.desconto"/>
			</label>
			</fieldset>
			<fieldset>
				<legend>Localização</legend>				
			<label>
				<input type="text" required placeholder="Cidade" list="cidade" ng-model="ctrl.cadastro.cidade" />
				<datalist id="cidade">
				  <option value="Agrestina">
				  <option value="São Joaquim do Monte">
				</datalist>
			</label>				
			<label>
				<input type="text"  title="Digite o cep da cidade" ui-mask="{{ctrl.cep}}" ng-model="ctrl.cadastro.cep" />
			</label>
			<label>
				<input type="text" required class="rua" required placeholder="Rua" ng-model="ctrl.cadastro.rua"/>
				<input type="text" class="numero" placeholder="Nº" ng-model="ctrl.cadastro.numero"/>
			</label>
			<label>
				<input type="text" required placeholder="Bairro" ng-model="ctrl.cadastro.bairro"/>
			</label>
			</fieldset>
		</article>
		<div>
			<input type="submit" class="send" value="Cadastrar" />
			<span id="mensagem_cadastro_cliente" class="mensagem animated fadeIn">Informações salvas com sucesso!</span>
			</div>
		</form>
	</section>