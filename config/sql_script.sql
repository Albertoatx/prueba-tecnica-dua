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