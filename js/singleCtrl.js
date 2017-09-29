app.controller('singleCtrl', function($window, http, $timeout, progresso){
	var self = this;

	progresso = progresso.create;
	progresso.setColor('#15B9FF');

	self.jan_planos = function(){
		angular.element(document.getElementById('tela')).fadeToggle(); 
		angular.element(document.getElementById('jan_planos')).fadeToggle(); 
	}

	http.acesso({ funcao : 'ler_planos' }).then(function(response){
		console.log(response.data)
		self.planos = response.data;
	})

	self.excluir = function(dados){
		var con = confirm('tem certeza que deseja excluir esse plano?');
		if(con){
			dados.funcao = 'del_planos';
			http.acesso(dados).then(function(response){
				self.planos.splice(self.planos.indexOf(dados), 1);
			})
		}
		
	}

	self.planos = {
		nome : null,
		valor : null
	};

	self.logout = function(){
		progresso.start();
		http.acesso({ funcao : 'sair' }).then(function(response){
			if(response.data){
				progresso.complete();
				$window.location.href = '../';
			}
		}, function(err){
			alert('Por favor verifique sua conexão com a internet ou tente novamente');
		})
	}

	self.cadastrar = function(dados){
		console.log(dados);
		progresso.start();	
		dados.funcao = 'cadastrar_planos';

		http.acesso(dados).then(function(response){
			progresso.complete();
			angular.element(document.getElementById('mensagem_cadastro_planos')).fadeIn();
			$timeout(function(){
				dados.nome = null;
				dados.valor = null;
				angular.element(document.getElementById('mensagem_cadastro_planos')).fadeOut();	
				}, 3500);			
		}, function(err){
			progresso.complete();
			alert('Por favor verifique sua conexão com a internet ou tente novamente');
		})
	}
})