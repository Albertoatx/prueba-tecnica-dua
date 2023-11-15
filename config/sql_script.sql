CREATE DATABASE duacode_test;


CREATE USER 'albertomm'@'localhost' IDENTIFIED VIA mysql_native_password USING '***';
GRANT ALL PRIVILEGES ON *.* TO 'albertomm'@'localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;


CREATE TABLE team (
    `id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(255) NULL,
    `city` VARCHAR(255) NULL,
    `sport` ENUM('Fútbol', 'Baloncesto', 'Formula 1') NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);


-- Only for testing
-- INSERT INTO `team` (`id`, `name`, `city`, `sport`, `created_at`) VALUES (NULL, 'Real Madrid', 'Madrid', 'Fútbol', current_timestamp());
-- INSERT INTO `team` (`id`, `name`, `city`, `sport`, `created_at`) VALUES (NULL, 'Deportivo de La Coruña', 'La Coruña', 'Fútbol', current_timestamp());
-- INSERT INTO `team` (`id`, `name`, `city`, `sport`, `created_at`) VALUES (NULL, 'McLaren', 'Woking', 'Formula 1', current_timestamp());
-- INSERT INTO `team` (`id`, `name`, `city`, `sport`, `created_at`) VALUES (NULL, 'Ferrari', 'Maranello', 'Formula 1', current_timestamp());


CREATE TABLE IF NOT EXISTS `player` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NULL,
    `number` INT NULL,
    `team_id` INT NOT NULL,
    `created_at` DATETIME NOT NULL,
    `edited_at` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_teamId_Player_Team` 
    FOREIGN KEY (`team_id`) 
    REFERENCES `team` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_unicode_ci; 


-- Only for testing 
INSERT INTO `player` (`id`, `name`, `number`, `team_id`, `created_at`, `edited_at`) VALUES (NULL, 'Luka Modric', 10, 1, current_timestamp(), current_timestamp());
INSERT INTO `player` (`id`, `name`, `number`, `team_id`, `created_at`, `edited_at`) VALUES (NULL, 'Brahim Díaz', 21, 1, current_timestamp(), current_timestamp());
INSERT INTO `player` (`id`, `name`, `number`, `team_id`, `created_at`, `edited_at`) VALUES (NULL, 'Arda Güler', 24, 1, current_timestamp(), current_timestamp());
INSERT INTO `player` (`id`, `name`, `number`, `team_id`, `created_at`, `edited_at`) VALUES (NULL, 'Oscar Piastri', 81, 3, current_timestamp(), current_timestamp());
INSERT INTO `player` (`id`, `name`, `number`, `team_id`, `created_at`, `edited_at`) VALUES (NULL, 'Lando Norris', 4, 3, current_timestamp(), current_timestamp());



ALTER TABLE `player`
ADD COLUMN `is_captain` BOOLEAN DEFAULT 0 AFTER `team_id`;