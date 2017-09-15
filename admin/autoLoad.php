<?php
	function __autoLoad($classe){
		if(!file_exists('classes/'. $classe .'.php')):
			echo('A classe '. $classe .' não existe.');
			else:
			include 'classes/'. $classe .'.php';
		endif;	
		}
