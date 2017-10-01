app

.factory('http', function($http){
	return {
		acesso : function(data){
			return $http.post('http://localhost/jodsonet/admin/processa.php', data);
		}
	}			
})

.factory('progresso', function(ngProgressFactory){
		return { 
			create : ngProgressFactory.createInstance()			
		}
})