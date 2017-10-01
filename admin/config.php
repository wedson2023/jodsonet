<?php
header('Access-Control-Allow-Origin: *'); 

session_start();

include 'classes/Ponte.php';
include 'classes/Read.php';

$read = new Read;

if(isset($_SESSION['token'])):
	$token = $_SESSION['token'];
	$read->ExeRead('login', 'WHERE token = :token', 'token=' . $token);
	if(!$read->getRowCount()):
		header('Location: ../');
	endif;
	else:
		header('Location: ../');
endif;
