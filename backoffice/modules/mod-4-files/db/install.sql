INSERT INTO `{c2r-prefix}_modules` (`name`, `folder`, `code`) VALUES ("{c2r-mod-name}", "{c2r-mod-folder}", '{\r\n	\"fa-icon\": \"fa-file\",\r\n	\"img\": \"\",\r\n	\"sub-items\": {},\r\n\"sidebar\": true,\r\n\"dropdown\": false\r\n}');

CREATE TABLE IF NOT EXISTS `{c2r-prefix}_4_files` (
	`id` int(11) NOT NULL,
	`file` varchar(255) NOT NULL,
	`type` varchar(255) NOT NULL,
	`module` varchar(255) NOT NULL,
	`id_ass` int(11) NOT NULL,
	`description` varchar(255) NOT NULL,
	`code` text NOT NULL,
	`sort` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`date_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
