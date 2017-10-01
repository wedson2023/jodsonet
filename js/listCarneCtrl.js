app.controller('listCarneCtrl', function(http,  carne){
	var self = this;

	self.carne = carne.data;

	self.excluir_carne = function(dados){
		var con = confirm('Tem certeza que deseja excluir esse boleto.');
		if(con){
			dados.funcao = 'del_boleto';
			http.acesso(dados).then(function(response){
				self.carne.splice(self.carne.indexOf(dados), 1);
			})
		}
	}

	self.dar_baixa = function(dados){		
		dados.funcao = 'dar_baixa';
		http.acesso(dados).then(function(response){
			dados.status = parseInt(dados.status) == 0 ? 1 : ( parseInt(dados.status) == 2 ? 1 : ( parseInt(dados.status) == 1 ? 2 : 0));
		})
	}
})