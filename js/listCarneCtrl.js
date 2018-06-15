app.controller('listCarneCtrl', function(http, carne, $filter, progresso){
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

	self.listar_carne = function(dados){
		var inicio = $filter('date')(dados.inicio, 'yyyy-MM-dd');
		var fim = $filter('date')(dados.fim, 'yyyy-MM-dd');
		var funcao = 'listar_por_data';
		http.acesso({ inicio : inicio, fim : fim, funcao : funcao, status : dados.status }).then(function(response){
			self.carne = response.data;
		})
	}

	self.dar_baixa = function(dados){		
		dados.funcao = 'dar_baixa';
		http.acesso(dados).then(function(response){
			dados.status = parseInt(dados.status) == 0 ? 1 : ( parseInt(dados.status) == 2 ? 1 : ( parseInt(dados.status) == 1 ? 2 : 0));
		})
	}
})