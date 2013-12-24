CREATE TABLE categories (
id INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
parent_id INTEGER(10) DEFAULT NULL,
lft INTEGER(10) DEFAULT NULL,
rght INTEGER(10) DEFAULT NULL,
name VARCHAR(255) DEFAULT '',
PRIMARY KEY  (id)
);

Now insert some record:
INSERT INTO `categories` (`id`, `name`, `parent_id`, `lft`, `rght`) VALUES(1, 'Tutorials', NULL, 1, 8);
INSERT INTO `categories` (`id`, `name`, `parent_id`, `lft`, `rght`) VALUES(2, 'PHP', 1, 2, 5);
INSERT INTO `categories` (`id`, `name`, `parent_id`, `lft`, `rght`) VALUES(3, 'MySQL', 1, 6, 7);
INSERT INTO `categories` (`id`, `name`, `parent_id`, `lft`, `rght`) VALUES(4, 'CakePHP', 2, 3, 4);
