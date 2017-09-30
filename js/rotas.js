app.config(function($routeProvider, $locationProvider){
		$routeProvider
		.when('/cadastrar-cliente', {
			templateUrl: 'content/cadastrar-cliente.php',
			controller: 'cadClienteCtrl as ctrl',
			resolve: {
				planos : function(http){
					return http.acesso({ funcao : 'ler_planos' });
					}
				}
			})

		.when('/alterar-cliente:id', {
			templateUrl: 'content/alterar-cliente.php',
			controller: 'altClienteCtrl as ctrl',
			resolve: {
				planos : function(http){
					return http.acesso({ funcao : 'ler_planos' });
					}
				}			
			})

		.when('/listar-cliente', {
			templateUrl: 'content/listar-cliente.php',
			controller: 'listClienteCtrl as ctrl',
			resolve: {
				clientes : function(http){
					return http.acesso({ funcao : 'ler_clientes' });
					}
				}
			})

		.when('/listar-carne', {
			templateUrl: 'content/listar-carne.php',
			controller: 'listCarneCtrl as ctrl',
			resolve: {
				carne : function(http){
					return http.acesso({ funcao : 'ler_carne' });
					}
				}
			})
						
		.otherwise({
			redirectTo : '/cadastrar-cliente'
			});
			
		$locationProvider.html5Mode(true);
	})