	<section class="listar conteiner animated bounceInUp">
	<style type="text/css">
		.capitalize { text-transform: capitalize; }
		section.listar input[type=search] { color: #666; width: 100%; padding: 15px; border: solid thin #f1f1f1; outline: none; margin-bottom: 10px;}
		section.listar div.header{ display: flex; flex-wrap: wrap; width: 100%; border: solid thin #f1f1f1; }
		section.listar div.header span{ text-align: center; font-size: 0.9em; border: solid thin #f1f1f1; padding: 5px; color: #ccc; cursor: pointer; background: #4b7e9d; color: #fff;}
		section.listar div.body { display: flex; flex-wrap: wrap; width: 100%; border: solid thin #f1f1f1;}
		section.listar div.body span{ text-align: center; font-size: 0.9em; border: solid thin #f1f1f1; padding: 5px; color: #ccc; cursor: pointer; color: #999;}
		section.listar div.body .icon { width: 70%; }

		section.listar .nome{  width: 22.5%; }
		section.listar .cidade{  width: 22.5%; }		
		section.listar .telefone{  width: 20%; }
		section.listar .plano{  width: 20%; }
		section.listar .valor{  width: 10%; }
		section.listar .imprimir{  width: 5%; }

	</style>
		<input type="search" ng-model="pesquisar" placeholder="Digite um segmento" />
		<div class="header">
			<span class="capitalize nome">Nome</span>
			<span class="capitalize cidade">Cidade</span>
			<span class="capitalize telefone">telefone</span>
			<span class="capitalize plano">Plano</span>
			<span class="capitalize valor">Valor</span>
			<span class="capitalize imprimir">P</span>
		</div>
		<div class="body">
			<span class="capitalize nome">Nome</span>
			<span class="capitalize cidade">Cidade</span>
			<span class="capitalize telefone">telefone</span>
			<span class="capitalize plano">Plano</span>
			<span class="capitalize valor">Valor</span>
			<span class="capitalize imprimir"><img class="icon" src="../imagens/print.png"></span>
		</div>
	</section>