SET NAMES utf8;
SET time_zone = '+00:00';
SET NAMES utf8mb4;

DROP TABLE IF EXISTS `aggregate_events`;
DROP TABLE IF EXISTS `streams_events`;

CREATE TABLE `streams_events`
(
    `id`                bigint(20) unsigned                                   NOT NULL AUTO_INCREMENT,
    `aggregate_id`      binary(36)                                            NOT NULL,
    `aggregate_type`    text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `event_type`        text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `aggregate_version` int(11)                                               NOT NULL,
    `payload`           text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;


ALTER TABLE `streams_events` RENAME TO `aggregate_events`;

DROP TABLE IF EXISTS aggregates;
CREATE TABLE `aggregates`
(
    `id`                bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `aggregate_id`      binary(36)      NOT NULL,
    `aggregate_type`    text            NOT NULL,
    `created_timestamp` timestamp       NOT NULL
) ENGINE = 'InnoDB'  COLLATE 'utf8mb4_unicode_ci';

ALTER TABLE `aggregate_events` DROP `aggregate_type`;
ALTER TABLE `aggregates` CHANGE `created_timestamp` `created_timestamp` int(11) NOT NULL AFTER `aggregate_type`;
