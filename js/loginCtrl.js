app.controller('loginCtrl', function(http, $window, progresso){
	var self = this;

	progresso = progresso.create;
	progresso.setColor('#15B9FF');

	self.login = {
		nome : null,
		senha : null
	};
	

	self.logar = function(dados){
		progresso.start();	
		dados.funcao = 'logar';

		http.acesso(dados).then(function(response){
			
			if(response.data == 'null'){
				alert('Login ou senha incorreta tente novamente!'); 
				progresso.complete();
				return false;
			}

			dados.nome = null;
			dados.senha = null;

			progresso.complete();
			localStorage.setItem('token', response.data.token);			
			if(localStorage.getItem('token')){
				$window.location.href = 'admin/cadastrar-cliente';
			}
			
		}, function(err){
			progresso.complete();
			alert('Por favor verifique sua conexão com a internet ou tente novamente');
		})
	}
})