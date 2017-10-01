app.controller('altClienteCtrl', function($scope, http, $timeout, $routeParams, planos){
	var self = this;

	self.planos = planos.data;

	self.cpf = '999.999.999-99';
	self.cep = '99999-999';
	self.celular = '(99) 99999-9999';

	var id = $routeParams.id;
	http.acesso({ funcao : 'ler_cliente', id : $routeParams.id }).then(function(response){
		self.cadastro = response.data;
	}, function(err){		
		alert('Por favor verifique sua conexão com a internet ou tente novamente');
	});	

	self.alterar = function(dados){
		dados.funcao = 'alterar_cliente';		
		if(dados.desconto > 100){ alert('O campo desconto não pode ser maior que 100, coloque outro valor. :)'); return false; }
		angular.element(document.getElementById('mensagem_cadastro_cliente')).fadeIn();
		http.acesso(dados).then(function(response){
			console.log(response.data)						
			$timeout(function(){				
				angular.element(document.getElementById('mensagem_cadastro_cliente')).fadeOut();	
				}, 3500);
		}, function(err){
			alert('Por favor verifique sua conexão com a internet ou tente novamente');
		});	
	}
})