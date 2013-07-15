<?php
include_once('model/startup.php');
include_once('controller/C_Login.php');
include_once('controller/C_Welcome.php');

// Инициализация.
startup();

// Выбор контроллера.
switch ($_GET['c'])
{
case 'login':
	$controller = new C_Login();
	break;
default:
	$controller = new C_Welcome();
}

// Обработка запроса.
$controller->Request();
