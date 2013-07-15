CREATE TABLE `privs` (
  `id_priv` int(5) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `description` varchar(512) default NULL,
  PRIMARY KEY  (`id_priv`),
  UNIQUE KEY `name` (`name`)
);

CREATE TABLE `privs2roles` (
  `id_priv` int(5) NOT NULL,
  `id_role` int(5) NOT NULL,
  PRIMARY KEY  (`id_priv`,`id_role`)
);

CREATE TABLE `roles` (
  `id_role` int(5) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `description` varchar(512) default NULL,
  PRIMARY KEY  (`id_role`),
  UNIQUE KEY `name` (`name`)
);

CREATE TABLE `sessions` (
  `id_session` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_last` datetime NOT NULL,
  PRIMARY KEY  (`id_session`),
  UNIQUE KEY `sid` (`sid`)
);

CREATE TABLE `users` (
  `id_user` int(5) NOT NULL auto_increment,
  `login` varchar(256) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_role` int(5) default NULL,
  `name` varchar(256) default NULL,
  PRIMARY KEY  (`id_user`),
  UNIQUE KEY `login` (`login`)
);

INSERT INTO `roles` (`name`, `description`) VALUES ('test', 'Роль для примера');

INSERT INTO `privs` (`name`, `description`) VALUES ('USE_SECRET_FUNCTIONS', 'Привилегия для примера');

INSERT INTO `privs2roles` (`id_priv`, `id_role`) VALUES ('1', '1');

INSERT INTO `users` (`login`, `password`, `id_role`, `name`) VALUES ('test@test.ru', '202cb962ac59075b964b07152d234b70', '1', 'test');
