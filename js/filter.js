app

.filter('opcao', function(){
	return  function(opt){
		return opt == 0 ? 'Aguardando' : ( opt == 1 ? 'Pago' : 'Atrasado' );
	}			
})