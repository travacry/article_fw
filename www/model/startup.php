<?php

function startup()
{
	// ��������� ����������� � ��.
	$hostname = 'localhost';	
	$username = 'root'; 
	$password = '';
	$dbName   = 'wg';
	
	// �������� ���������.
	setlocale(LC_ALL, 'ru_RU.CP1251');	
	
	// ����������� � ��.
	mysql_connect($hostname, $username, $password) or die('No connect with data base'); 
	mysql_query('SET NAMES cp1251');
	mysql_select_db($dbName) or die('No data base');

	// �������� ������.
	session_start();		
}
