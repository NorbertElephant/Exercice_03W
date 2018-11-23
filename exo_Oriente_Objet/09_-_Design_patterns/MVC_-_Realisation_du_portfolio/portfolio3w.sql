SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `allowed_to`;
CREATE TABLE IF NOT EXISTS `allowed_to` (
  `role` varchar(25) NOT NULL COMMENT 'superadmin | administrator | seo | contributor | subscriber',
  `capability` varchar(25) NOT NULL,
  PRIMARY KEY (`role`,`capability`),
  KEY `role` (`role`),
  KEY `capability` (`capability`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `allowed_to`;
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'create_users');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'delete_comments');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'delete_others_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'delete_others_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'delete_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'delete_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'delete_private_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'delete_private_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'delete_published_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'delete_published_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'delete_users');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'edit_comments');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'edit_dashboard');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'edit_others_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'edit_others_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'edit_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'edit_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'edit_private_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'edit_private_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'edit_published_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'edit_published_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'edit_users');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'list_users');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'manage_categories');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'manage_options');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'moderate_comments');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'promote_users');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'publish_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'publish_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('administrator', 'upload_files');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('contributor', 'edit_comments');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('contributor', 'edit_dashboard');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('contributor', 'edit_others_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('contributor', 'edit_others_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('contributor', 'edit_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('contributor', 'edit_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('contributor', 'edit_published_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('contributor', 'edit_published_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('contributor', 'list_users');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('contributor', 'upload_files');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'create_users');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'edit_comments');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'edit_dashboard');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'edit_others_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'edit_others_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'edit_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'edit_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'edit_published_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'edit_published_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'edit_users');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'list_users');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'manage_categories');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'manage_options');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'moderate_comments');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'promote_users');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'publish_pages');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'publish_posts');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('seo', 'upload_files');
INSERT INTO `allowed_to` (`role`, `capability`) VALUES('subscriber', 'upload_files');

DROP TABLE IF EXISTS `capability`;
CREATE TABLE IF NOT EXISTS `capability` (
  `keyword` varchar(25) NOT NULL,
  `denomination` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `capability`;
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('create_users', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('delete_comments', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('delete_others_pages', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('delete_others_posts', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('delete_pages', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('delete_posts', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('delete_private_pages', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('delete_private_posts', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('delete_published_pages', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('delete_published_posts', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('delete_users', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('edit_comments', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('edit_dashboard', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('edit_others_pages', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('edit_others_posts', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('edit_pages', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('edit_posts', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('edit_private_pages', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('edit_private_posts', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('edit_published_pages', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('edit_published_posts', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('edit_users', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('list_users', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('manage_categories', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('manage_options', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('moderate_comments', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('promote_users', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('publish_pages', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('publish_posts', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('update_core', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('update_plugins', '', '');
INSERT INTO `capability` (`keyword`, `denomination`, `description`) VALUES('upload_files', '', '');

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `mime` varchar(255) NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'DEFAULT CURRENT_TIME',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `media`;
INSERT INTO `media` (`id`, `uri`, `title`, `description`, `mime`, `upload_date`) VALUES(1, 'picto_objectif3w_19700101000000.svg', 'Damien TIVELET', 'Avatar', 'image/svg+xml', '1970-01-01 00:00:00');

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `excerpt` text NOT NULL,
  `release_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'DEFAULT CURRENT_TIME',
  `tab` int(11) NOT NULL DEFAULT '0' COMMENT 'DEFAULT 0',
  `type` varchar(25) NOT NULL COMMENT 'post_type : category | post | page',
  `status` varchar(25) NOT NULL COMMENT 'post_status : draft | pending | publish | revision | trash',
  `access` varchar(25) NOT NULL COMMENT 'post_access : private | protected | public',
  `format` varchar(25) NOT NULL COMMENT 'post_format : nav_menu | gallery | image | audio | video | quote | link | code',
  `parent` int(11) NOT NULL,
  `author` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `status` (`status`),
  KEY `access` (`access`),
  KEY `format` (`format`),
  KEY `parent` (`parent`),
  KEY `author` (`author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `post`;
DROP TABLE IF EXISTS `published_on`;
CREATE TABLE IF NOT EXISTS `published_on` (
  `media` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  PRIMARY KEY (`media`,`post`),
  KEY `media` (`media`),
  KEY `post` (`post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `published_on`;
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `keyword` varchar(25) NOT NULL COMMENT 'superadmin | administrator | seo | contributor | subscriber',
  `denomination` varchar(50) NOT NULL,
  `power` int(11) NOT NULL,
  PRIMARY KEY (`keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `role`;
INSERT INTO `role` (`keyword`, `denomination`, `power`) VALUES('administrator', '[:en]Administrator[:fr]Administrateur', 1);
INSERT INTO `role` (`keyword`, `denomination`, `power`) VALUES('contributor', '[:en]Contributor[:fr]Contributeur', 100);
INSERT INTO `role` (`keyword`, `denomination`, `power`) VALUES('seo', '[:en]SEO[:fr]Référenceur', 10);
INSERT INTO `role` (`keyword`, `denomination`, `power`) VALUES('subscriber', '[:en]Subscriber[:fr]Abonné', 999999999);
INSERT INTO `role` (`keyword`, `denomination`, `power`) VALUES('superadmin', '[:en]Super Administrator[:fr]Super Administrateur', 0);

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `denomination` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `setting`;
INSERT INTO `setting` (`id`, `denomination`, `value`) VALUES(1, 'general_settings', '{"site_title":"[:en]PortfoliO3W[:fr]PortfoliO3W","site_baseline":"[:en]MY PORTFOLIO\\\\r\\\\nWITH THE MVC PATTERN[:fr]MON PORTFOLIO\\\\r\\\\nAVEC LE MOTIF MVC","address":{"street":"2214 bd de la Lironde","additional":"Parc scientifique Agropolis","zipcode":"34980","city":"Montferrier-sur-Lez"},"contacts":{"email":"d.tivelet@objectif3w.com","phone":"+33 4 67 15 01 66"}}');

DROP TABLE IF EXISTS `taxonomy`;
CREATE TABLE IF NOT EXISTS `taxonomy` (
  `keyword` varchar(25) NOT NULL COMMENT 'post_type | post_status | post_format | post_access',
  `denomination` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='A taxonomy is a way to group things together';

TRUNCATE TABLE `taxonomy`;
INSERT INTO `taxonomy` (`keyword`, `denomination`, `description`) VALUES('post_access', '', '');
INSERT INTO `taxonomy` (`keyword`, `denomination`, `description`) VALUES('post_format', '', '');
INSERT INTO `taxonomy` (`keyword`, `denomination`, `description`) VALUES('post_status', '', '');
INSERT INTO `taxonomy` (`keyword`, `denomination`, `description`) VALUES('post_type', '', '');

DROP TABLE IF EXISTS `term`;
CREATE TABLE IF NOT EXISTS `term` (
  `keyword` varchar(25) NOT NULL COMMENT 'post_type : category | post | page post_status : draft | pending | publish | revision | trash post_access : private | protected | public post_format : nav_menu | gallery | image | audio | video | quote | link | code',
  `denomination` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `taxonomy` varchar(25) NOT NULL COMMENT 'post_type | post_status | post_format | post_access',
  PRIMARY KEY (`keyword`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `term`;
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('audio', 'Audio player', '', 'post_format');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('category', 'Category', '', 'post_type');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('code', 'Block code', '', 'post_format');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('draft', 'Draft', '', 'post_status');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('gallery', 'Gallery', '', 'post_format');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('image', 'Image', '', 'post_format');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('link', 'Link', '', 'post_format');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('nav_menu', 'Navigation menu', '', 'post_format');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('page', 'Page', '', 'post_type');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('pending', 'Waiting for approval', '', 'post_status');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('post', 'Post', '', 'post_type');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('private', 'Private', 'Only an Administrator can see this', 'post_access');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('protected', 'Protected', 'Password protected', 'post_access');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('public', 'Public', 'Everyone can see this', 'post_access');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('publish', 'Published', '', 'post_status');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('quote', 'Blockquote', '', 'post_format');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('revision', 'Auto-draft', '', 'post_status');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('trash', 'Trash', '', 'post_status');
INSERT INTO `term` (`keyword`, `denomination`, `description`, `taxonomy`) VALUES('video', 'Video player', '', 'post_format');

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(100) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(75) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `registration_date` datetime NOT NULL,
  `last_connection_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '-1 (waiting for validation) 0 (deactivated) 1 (activated) 9 (banished)',
  `avatar` int(11) DEFAULT NULL,
  `token` varchar(75) DEFAULT NULL,
  `role` varchar(25) NOT NULL COMMENT 'superadmin | administrator | seo | contributor | subscriber',
  PRIMARY KEY (`email`),
  KEY `FK_user_role` (`role`),
  KEY `FK_user_avatar` (`avatar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `user`;
INSERT INTO `user` (`email`, `login`, `password`, `lastname`, `firstname`, `registration_date`, `last_connection_date`, `status`, `avatar`, `token`, `role`) VALUES('d.tivelet@objectif3w.com', 'luCkyTiv', '$2y$08$DFDExaaDbWZBqBbGnV9MiOJ/kAPFHDbqlSD5ZOvjYtpR7.nkGPi6e', 'TIVELET', 'Damien', '1970-01-01 00:00:00', '2017-06-27 16:55:17', 1, 1, '$2y$08$G35JHGEnsKKVlN/9tk34fO5psoQKFZ0dVe41NrvHLMjblX3.wvkz.', 'superadmin');
INSERT INTO `user` (`email`, `login`, `password`, `lastname`, `firstname`, `registration_date`, `last_connection_date`, `status`, `avatar`, `token`, `role`) VALUES('testman@testenv.tld', 'testman', '$2y$08$7soT3il2aoTVMXC5D4g7Fe34uhvVNswhZ3EYynO5YGMXGDj7c6FEe', 'TEST', 'Manof', '2017-06-25 17:29:18', NULL, 1, NULL, NULL, 'subscriber');


ALTER TABLE `allowed_to`
  ADD CONSTRAINT `FK_allowed_to_capability` FOREIGN KEY (`capability`) REFERENCES `capability` (`keyword`),
  ADD CONSTRAINT `FK_allowed_to_role` FOREIGN KEY (`role`) REFERENCES `role` (`keyword`);

ALTER TABLE `post`
  ADD CONSTRAINT `FK_post_access` FOREIGN KEY (`access`) REFERENCES `term` (`keyword`),
  ADD CONSTRAINT `FK_post_author` FOREIGN KEY (`author`) REFERENCES `user` (`email`),
  ADD CONSTRAINT `FK_post_format` FOREIGN KEY (`format`) REFERENCES `term` (`keyword`),
  ADD CONSTRAINT `FK_post_parent` FOREIGN KEY (`parent`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_post_status` FOREIGN KEY (`status`) REFERENCES `term` (`keyword`),
  ADD CONSTRAINT `FK_post_type` FOREIGN KEY (`type`) REFERENCES `term` (`keyword`);

ALTER TABLE `published_on`
  ADD CONSTRAINT `FK_media_published_on` FOREIGN KEY (`media`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `FK_published_on_post` FOREIGN KEY (`post`) REFERENCES `post` (`id`);

ALTER TABLE `term`
  ADD CONSTRAINT `FK_term_taxonomy` FOREIGN KEY (`taxonomy`) REFERENCES `taxonomy` (`keyword`);

ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_avatar` FOREIGN KEY (`avatar`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `FK_user_role` FOREIGN KEY (`role`) REFERENCES `role` (`keyword`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
