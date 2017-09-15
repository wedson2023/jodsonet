<!DOCTYPE html>
<html lang="pt-br" ng-app="app">
<head>
	<meta charset="utf-8"/>
	<meta name="robots" content="noindex, nofollow" />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="icon" href="imagens/icon.png">	
	<title>Gerar Boletos</title>
	<link rel="stylesheet" href="css/ngProgress.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
<form ng-submit="ctrl.logar(ctrl.login)" ng-controller="loginCtrl as ctrl">
	<img class="logo" src="imagens/logo.png">
	<input type="text" autofocus required title="É necessário informar o nome de usuário" ng-model="ctrl.login.nome" placeholder="Seu Login" />
	<input type="password" required title="É necessário informar a senha" ng-model="ctrl.login.senha" placeholder="Sua senha" />
	<input class="send" type="submit" value="Entrar" />
</form>
<script src="js/lib/angular.min.js"></script>
<script src="js/lib/ngprogress.js"></script>
<script src="js/lib/mask.js"></script>
<script src="js/lib/angular-route.min.js"></script>
<script src="js/module.js"></script>
<script src="js/factory.js"></script>
<script src="js/loginCtrl.js"></script>
</body>
</html>