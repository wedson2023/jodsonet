app

.factory('http', function($http){
	return {
		acesso : function(data){
			return $http.post('http://wedsonwebdesigner.com.br/jodsonet/admin/processa.php', data);
		}
	}			
})

.factory('progresso', function(ngProgressFactory){
		return { 
			create : ngProgressFactory.createInstance()			
		}
})