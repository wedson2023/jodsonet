app.controller('cadClienteCtrl', function($scope, http, $timeout, planos){
	var self = this;

	self.planos = planos.data;
	console.log(planos);
	self.cpf = '999.999.999-99';
	self.cep = '99999-999';
	self.celular = '(99) 99999-9999';

	self.cadastro = {
			nome : null,
			apelido : null,
			celular : null,
			cpf : null,
			cidade : null,
			cep : null,
			rua : null,
			numero : null,
			desconto : null,
			plano : null,
			bairro : null,
		};

	self.cadastrar = function(dados){
		console.log(dados)
		dados.funcao = 'cadastrar_cliente';		
		if(dados.desconto > 100){ alert('O campo desconto não pode ser maior que 100, coloque outro valor. :)'); return false; }
		angular.element(document.getElementById('mensagem_cadastro_cliente')).fadeIn();
		http.acesso(dados).then(function(response){
			console.log(response.data)						
			$timeout(function(){
				self.cadastro.nome = null;
				self.cadastro.apelido = null;
				self.cadastro.celular = null;
				self.cadastro.cpf = null;
				self.cadastro.rua = null;
				self.cadastro.numero = null;
				self.cadastro.desconto = null;
				self.cadastro.plano = null;
				self.cadastro.bairro = null;
				angular.element(document.getElementById('mensagem_cadastro_cliente')).fadeOut();	
				}, 3500);
		}, function(err){
			alert('Por favor verifique sua conexão com a internet ou tente novamente');
		});	
	}
})