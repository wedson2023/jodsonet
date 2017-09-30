app.controller('listClienteCtrl', function(http, clientes, $window, progresso){
	var self = this;

	self.clientes = clientes.data;

	progresso = progresso.create;
	progresso.setColor('#15B9FF');

	self.deletar = function(dados){
		dados.funcao = 'deletar_cliente';
		var con = confirm('Tem certeza que deseja deletar esse cliente, todo o histórico dele será removido?');
		if(con){
			http.acesso(dados).then(function(response){
				self.clientes.splice(self.clientes.indexOf(dados), 1);
			}, function(err){
				progresso.complete();
				alert('Por favor verifique sua conexão com a internet ou tente novamente');
			})					
		}
	}

	self.gerar = function(dados){
		dados.funcao = 'gerar';
		http.acesso(dados).then(function(response){
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

	self.excluir_carne = function(dados){
		var con = confirm('Tem certeza que deseja excluir esse boleto.');
		if(con){
			dados.funcao = 'del_boleto';
			http.acesso(dados).then(function(response){
				var cliente = self.clientes.filter(function(elemento){ return elemento.id == dados.cliente_id })[0];
				cliente.carne.splice(cliente.carne.indexOf(dados), 1);
			})
		}
	}

	self.dar_baixa = function(dados){
		
		dados.funcao = 'dar_baixa';
		http.acesso(dados).then(function(response){
			dados.status = parseInt(dados.status) == 0 ? 1 : ( parseInt(dados.status) == 2 ? 1 : ( parseInt(dados.status) == 1 ? 2 : 0));
		})
	}

	self.segunda_via = function(dados){
		dados.funcao = 'segunda_via';
		dados.cliente_id = dados.id;
		http.acesso(dados).then(function(response){		
			if(!response.data.resposta){ 
				alert(response.data.mensagem);
				}else{				
				impressao = window.open('about:blank');
				impressao.document.write(response.data.mensagem);
				impressao.window.print();
				impressao.window.close();
				return impressao;
			}
		});
	}
})