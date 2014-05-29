CREATE TABLE IF NOT EXISTS `erp_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Table structure for table `erp_users`
--

ALTER TABLE `erp_users` ADD `group_id` INT( 11 ) NOT NULL AFTER `id` ;

-- ALTER TABLE `erp_users` CHANGE `groups_id` `group_id` INT( 11 ) NOT NULL ;

ALTER TABLE `erp_events` ADD `user_id` INT( 11 ) NOT NULL AFTER `id` ;

ALTER TABLE `erp_events` ADD `image_path` VARCHAR(255) NULL AFTER `city`, ADD `image` VARCHAR(255) NULL AFTER `image_path`;

ALTER TABLE `erp_sponsors` ADD `company_path` VARCHAR(255) NULL AFTER `companyName`;

ALTER TABLE `erp_sponsors` ADD `image_path` VARCHAR(255) NULL AFTER `productsName`;