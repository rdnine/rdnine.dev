INSERT INTO `{c2r-prefix}_modules` (`name`, `folder`, `code`) VALUES ('{c2r-mod-name}', '{c2r-mod-folder}', '{\r\n	\"fa-icon\": \"fa-list\",\r\n	\"img\": \"\",\r\n	\"sub-items\": {\r\n		\"List\": {\r\n			\"url\": \"\"\r\n		},\r\n		\"Add category\": {\r\n			\"url\": \"add\"\r\n		}\r\n	},\r\n\"sidebar\": true,\r\n\"dropdown\": false\r\n}');

CREATE TABLE `{c2r-prefix}_8_categories` (
	`id` int(11) NOT NULL,
	`parent_id` int(11) NOT NULL,
	`category_section` varchar(255) NOT NULL,
	`code` text NOT NULL,
	`sort` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,
	`published` tinyint(1) NOT NULL,
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`date_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `{c2r-prefix}_8_categories_lang` (
	`id` int(11) NOT NULL,
	`category_id` int(11) NOT NULL,
	`lang_id` int(11) NOT NULL,
	`title` varchar(255) NOT NULL,
	`text` text NOT NULL,
	`meta-keywords` text NOT NULL,
	`meta-description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE  `{c2r-prefix}_8_categories_rel` (
	`id` INT(11) NOT NULL ,
	`category_id` INT(11) NOT NULL ,
	`object_id` INT(11) NOT NULL ,
	`module` VARCHAR(255) NOT NULL ,
	`date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	`date_update` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `{c2r-prefix}_8_categories`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `{c2r-prefix}_8_categories_lang`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `{c2r-prefix}_8_categories_rel`
	ADD PRIMARY KEY (`id`);


ALTER TABLE `{c2r-prefix}_8_categories`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{c2r-prefix}_8_categories_lang`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{c2r-prefix}_8_categories_rel`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
