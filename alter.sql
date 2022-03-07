--02-12-2021
ALTER TABLE `deallist` ADD `profile_id` INT NULL AFTER `id`;

--03-12-2021
CREATE TABLE `keypeople_titles` ( `id` INT NOT NULL AUTO_INCREMENT , `users_id` INT NOT NULL , `title` VARCHAR(255) NOT NULL , `color` VARCHAR(255) NULL , `created_at` DATETIME NULL , `updated_at` DATETIME NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `keypeoples` ( `id` INT NOT NULL AUTO_INCREMENT , `keypeople_title_id` INT NULL , `sender_id` INT NOT NULL , `receiver_id` INT NOT NULL , `status` INT NULL DEFAULT '0' , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `users_profile_media` ADD `downloadable_only_mkp_radio` INT NULL DEFAULT '0' COMMENT '0=no, 1=yes' AFTER `locked`;

ALTER TABLE `users_profile_media` ADD `created_at` DATETIME NULL AFTER `downloadable_only_mkp_radio`;

ALTER TABLE `users_profile_media` ADD `updated_at` DATETIME NULL AFTER `created_at`;

ALTER TABLE `users_profile_media` ADD `album_cover` VARCHAR(255) NULL AFTER `media_location`;

--10-12-2021

ALTER TABLE `users_profile_media` ADD `tag_user_ids` VARCHAR(255) NULL AFTER `status`;

ALTER TABLE `users_profiles_picture` ADD `tag_user_ids` VARCHAR(255) NULL AFTER `likes`;

--14-12-2021

ALTER TABLE `keylist_media` ADD `pin` VARCHAR(50) NULL AFTER `status`;

ALTER TABLE `keylist_media` ADD `pin_bg_color` VARCHAR(100) NULL AFTER `pin`;

ALTER TABLE `keylist_media` ADD `media_url` VARCHAR(255) NULL AFTER `media_id`;

ALTER TABLE `keylist_media` CHANGE `media_id` `media_id` INT(11) NULL COMMENT 'related to any tables like users_profiles, project table etc';

ALTER TABLE `users_profile_media_comments` ADD `is_reply` INT NULL DEFAULT '0' COMMENT '0=no, 1=yes' AFTER `comments`, ADD `reply_comment_id` INT NULL COMMENT 'this should be self join' AFTER `is_reply`;

ALTER TABLE `users_profile_media_comments` ADD `parent_comment_id` INT NULL AFTER `reply_comment_id`;

ALTER TABLE `users_profile_picture_comments` CHANGE `users_profile_picture_id` `users_profile_media_id` INT(11) NOT NULL;

ALTER TABLE `users_profile_picture_comments` ADD `is_reply` INT NULL DEFAULT '0' COMMENT '0=no, 1=yes ' AFTER `comments`, ADD `reply_comment_id` INT NULL AFTER `is_reply`, ADD `parent_comment_id` INT NULL AFTER `reply_comment_id`;