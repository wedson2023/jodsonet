app

.directive('toque', function(){
	return {
		restrict : 'A',
		link : function(scope, element, attr){
			element.click(function(){
				$(this).children('span.informacoes').slideToggle().css('opacity', '1');
			})
		}

	}		
})