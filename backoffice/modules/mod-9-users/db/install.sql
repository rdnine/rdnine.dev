INSERT INTO `{c2r-prefix}_modules` (`name`, `folder`, `code`) VALUES ("{c2r-mod-name}", "{c2r-mod-folder}", '{\"fa-icon\":\"fa-users\",\"img\":\"\",\"sub-items\":{\"List\":{\"url\":\"\"},\"Add user\":{\"url\":\"add\"},\"Logs\":{\"url\":\"logs\"}},\"sidebar\":true,\"dropdown\":false}');

CREATE TABLE `{c2r-prefix}_9_users` (
	`id` int(11) NOT NULL,
	`username` varchar(255) DEFAULT NULL,
	`password` varchar(255) DEFAULT NULL,
	`rank` enum('owner','manager','member') DEFAULT 'member',
	`email` varchar(255) DEFAULT NULL,
	`code` text,
	`custom_css` text NOT NULL,
	`user_key` text,
	`status` tinyint(1) NOT NULL DEFAULT '0',
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`date_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `{c2r-prefix}_9_users_fields` (
	`id` int(11) NOT NULL,
	`name` text NOT NULL,
	`value` text NOT NULL,
	`type` text NOT NULL,
	`placeholder` text NOT NULL,
	`required` tinyint(1) NOT NULL DEFAULT '0',
	`sort` int(11) NOT NULL,
	`status` tinyint(1) NOT NULL DEFAULT '0',
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`date_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `{c2r-prefix}_9_users`
	ADD PRIMARY KEY (`id`),
	ADD UNIQUE KEY `name` (`username`),
	ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `{c2r-prefix}_9_users_fields`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `{c2r-prefix}_9_users`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
