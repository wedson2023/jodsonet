<?php
session_start();

include 'classes/Ponte.php';
include 'classes/Read.php';

$read = new Read;

if(isset($_SESSION['token'])):
	$token = $_SESSION['token'];
	$read->ExeRead('login', 'WHERE token = :token', 'token=' . $token);
	if(!$read->getRowCount()):
		header('Location: index.php');
	endif;
	else:
		header('Location: index.php');
endif;
