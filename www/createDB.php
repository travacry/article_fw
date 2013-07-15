<?php
$con = mysql_connect("localhost","root","");
if (!$con){
	die('Could not connect: ' . mysql_error());
}

if (mysql_query("CREATE DATABASE wg",$con)){
	echo "Database created <br><hr>";
}
else{
	echo "Error creating database: " . mysql_error() . "<br><hr>";
}

mysql_select_db("wg", $con);

$sql = "CREATE TABLE `privs` (
  `id_priv` int(5) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `description` varchar(512) default NULL,
  PRIMARY KEY  (`id_priv`),
  UNIQUE KEY `name` (`name`)
);";
managementTable($sql, $con);

$sql = "CREATE TABLE `privs2roles` (
  `id_priv` int(5) NOT NULL,
  `id_role` int(5) NOT NULL,
  PRIMARY KEY  (`id_priv`,`id_role`)
)";
managementTable($sql, $con);

$sql = "CREATE TABLE `roles` (
  `id_role` int(5) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `description` varchar(512) default NULL,
  PRIMARY KEY  (`id_role`),
  UNIQUE KEY `name` (`name`)
)";
managementTable($sql, $con);

$sql = "CREATE TABLE `sessions` (
  `id_session` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_last` datetime NOT NULL,
  PRIMARY KEY  (`id_session`),
  UNIQUE KEY `sid` (`sid`)
)";
managementTable($sql, $con);

$sql = "CREATE TABLE `users` (
  `id_user` int(5) NOT NULL auto_increment,
  `login` varchar(256) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_role` int(5) default NULL,
  `name` varchar(256) default NULL,
  PRIMARY KEY  (`id_user`),
  UNIQUE KEY `login` (`login`)
)";
managementTable($sql, $con);

$sql = "INSERT INTO `roles` (`name`, `description`) VALUES ('test', 'Роль для примера')";
managementTable($sql, $con);

$sql = "INSERT INTO `privs` (`name`, `description`) VALUES ('USE_SECRET_FUNCTIONS', 'Привилегия для примера')";
managementTable($sql, $con);

$sql = "INSERT INTO `privs2roles` (`id_priv`, `id_role`) VALUES ('1', '1')";
managementTable($sql, $con);

$sql = "INSERT INTO `users` (`login`, `password`, `id_role`, `name`) VALUES ('test@test.ru', '202cb962ac59075b964b07152d234b70', '1', 'test')";
managementTable($sql, $con);

function managementTable($sql, $con){
	preg_match( "/(CREATE|INSERT)( +?)(TABLE)( +?)(\`|\'|\")([0-9a-zA-Z]+)/", $sql, $name);
	if (mysql_query($sql, $con)){
		if ($name[1] == "CREATE")
			echo "Table '$name[6]' creating! <br><hr>";
		else if ($name[1] == "INSERT")
			echo "Table '$name[6]' insert! <br><hr>";
	}else{
		if ($name[1] == "CREATE")
			echo "Error creating table '$name[6]' <br><hr>";
		else if ($name[1] == "INSERT")
			echo "Error insert table '$name[6]' <br><hr>";
	};	
}


mysql_close($con);
?>