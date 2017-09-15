<?php 
class Helpers {
	public static function limpar($dados){
		$search = array('"', '\'', ';', '=', '<', '>', '!', '--', '#', '//', '\\');
		$replace = array('', '', '', '', '', '', '', '', '', '', '');
		
		foreach($dados as $key => $val):
			$dados->$key = str_replace($search, $replace, addslashes(strip_tags(trim($val))));
		endforeach;
		return $dados;
		}

	public static function limpeza($dados){
		$search = array('"', '\'', ';', '=', '<', '>', '!', '--', '#', '//', '\\');
		$replace = array('', '', '', '', '', '', '', '', '', '', '');		
		
		return str_replace($search, $replace, addslashes(strip_tags(trim($dados))));
		}
	}