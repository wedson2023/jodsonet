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

		.when('/listar-cliente', {
			templateUrl: 'content/listar-cliente.php',
			controller: 'listClienteCtrl as ctrl',
			resolve: {
				planos : function(http){
					return http.acesso({ funcao : 'ler_planos' });
					}
				}
			})
						
		.otherwise({
			redirectTo : '/cadastrar-cliente'
			});
			
		$locationProvider.html5Mode(true);
	})