app.controller('listClienteCtrl', function(http, clientes, $window, progresso){
	var self = this;

	self.clientes = clientes.data;

	progresso = progresso.create;
	progresso.setColor('#15B9FF');

	self.deletar = function(dados){
		progresso.start();
		dados.funcao = 'deletar_cliente';
		var con = confirm('Tem certeza que deseja deletar esse cliente, todo o histórico dele será removido?');
		if(con){
			http.acesso(dados).then(function(response){
				self.clientes.splice(self.clientes.indexOf(dados), 1);
				progresso.complete();
			}, function(err){
				progresso.complete();
				alert('Por favor verifique sua conexão com a internet ou tente novamente');
			})					
		}
	}

	self.gerar = function(dados){
		dados.funcao = 'gerar';
		http.acesso(dados).then(function(response){
			console.log(response.data);
			if(!response.data.resposta){ 
				alert(response.data.mensagem);
				}else{				
				impressao = window.open('about:blank');
				impressao.document.write(response.data.mensagem);
				impressao.window.print();
				impressao.window.close();
				return impressao;
			}
		}, function(err){
			alert('Por favor verifique sua conexão com a internet ou tente novamente');
		})		
	}
})