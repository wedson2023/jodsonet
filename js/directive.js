app

.directive('toque', function(){
	return {
		restrict : 'A',
		link : function(scope, element, attr){
			element.click(function(){
				$(this).parent().parent().children('div.conteiner').slideToggle();
			})
		}

	}		
})