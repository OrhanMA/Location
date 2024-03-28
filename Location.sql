-- À propos du data type CHAR(36) pour l'enregistrement des UUID: https://stackoverflow.com/questions/43056220/store-uuid-v4-in-mysql

CREATE TABLE `user` (
  `id` CHAR(36) PRIMARY KEY,
  `first_name` varchar(50),
  `last_name` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL
);

-- La raison pour l'utilisation d'une length 255 pour le password: 
-- https://www.php.net/manual/fr/function.password-hash.php#:~:text=Notez%20que%20cette,tr%C3%A8s%20bon%20choix).

CREATE TABLE `rental` (
  `id` CHAR(36) PRIMARY KEY,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `vehicule_id` CHAR(36) NOT NULL,
  `user_id` CHAR(36) 
);

CREATE TABLE `vehicule` (
  `id` CHAR(36) PRIMARY KEY,
  `brand` varchar(30) NOT NULL,
  `model` varchar(50) NOT NULL,
  `horsepower` int(4) NOT NULL,
  `daily_price` float NOT NULL,
  `image_name` varchar(20),
  `license_id` CHAR(36) NOT NULL
);

CREATE TABLE `category` (
  `id` CHAR(36) PRIMARY KEY,
  `name` varchar(30) NOT NULL
);

CREATE TABLE `category_vehicule` (
  `id` CHAR(36) PRIMARY KEY,
  `vehicule_id` CHAR(36),
  `category_id` CHAR(36)
);

CREATE TABLE `license` (
  `id` CHAR(36) PRIMARY KEY,
  `plate` varchar(7) NOT NULL
);

ALTER TABLE `vehicule` ADD FOREIGN KEY (`license_id`) REFERENCES `license` (`id`);

ALTER TABLE `rental` ADD FOREIGN KEY (`vehicule_id`) REFERENCES `vehicule` (`id`);

ALTER TABLE `rental` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `category_vehicule` ADD FOREIGN KEY (`vehicule_id`) REFERENCES `vehicule` (`id`);

ALTER TABLE `category_vehicule` ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

-- Fixtures
INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`)
VALUES 
    (UUID(), 'John', 'Doe', 'john@example.com', '0612345678', 'password123'),
    (UUID(), 'Jane', 'Smith', 'jane@example.com', '0712345678', 'password456'),
    (UUID(), 'Alice', 'Johnson', 'alice@example.com', '0698765432', 'password789'),
    (UUID(), 'Bob', 'Brown', 'bob@example.com', '0765432109', 'passwordABC');

-- Fixtures
INSERT INTO `license` (`id`, `plate`)
VALUES 
    (UUID(), 'ABC123'),
    (UUID(), 'DEF456'),
    (UUID(), 'GHI789'),
    (UUID(), 'JKL012');

-- Fixtures
INSERT INTO `vehicule` (`id`, `brand`, `model`, `horsepower`, `daily_price`, `image_name`, `license_id`)
VALUES 
    (UUID(), 'Nissan', 'GTR R35', 670, 1500.00, 'GTR.jpg', (SELECT id FROM license WHERE plate = 'ABC123')),
    (UUID(), 'BMW', 'M4 Competition', 610, 1800.00, 'M4.jpg', (SELECT id FROM license WHERE plate = 'DEF456')),
    (UUID(), 'Porsche', '911 GT3 RS', 450, 1200.00, '911.jpeg', (SELECT id FROM license WHERE plate = 'GHI789')),
    (UUID(), 'Koenigsegg', 'One:1', 550, 1600.00, 'ONE.jpeg', (SELECT id FROM license WHERE plate = 'JKL012'));

-- Fixtures
INSERT INTO `rental` (`id`, `start_date`, `end_date`, `vehicule_id`, `user_id`)
VALUES 
    (UUID(), '2020-07-28', '2020-08-05', (SELECT id FROM vehicule WHERE brand = 'Nissan' AND model = 'GTR R35'), (SELECT id FROM user WHERE email = 'john@example.com')),
    (UUID(), '2020-08-10', '2020-08-15', (SELECT id FROM vehicule WHERE brand = 'BMW' AND model = 'M4 Competition'), (SELECT id FROM user WHERE email = 'jane@example.com')),
    (UUID(), '2020-09-01', '2020-09-10', (SELECT id FROM vehicule WHERE brand = 'Porsche' AND model = '911 GT3 RS'), (SELECT id FROM user WHERE email = 'alice@example.com')),
    (UUID(), '2020-10-05', '2020-10-15', (SELECT id FROM vehicule WHERE brand = 'Koenigsegg' AND model = 'One:1'), (SELECT id FROM user WHERE email = 'bob@example.com'));

-- Fixtures
INSERT INTO `category` (`id`, `name`)
VALUES 
    (UUID(), 'Sportive'),
    (UUID(), 'Circuit'),
    (UUID(), 'Street'),
    (UUID(), 'Hypercar');

-- Fixtures
INSERT INTO `category_vehicule` (`id`, `vehicule_id`, `category_id`)
VALUES 
    (UUID(), (SELECT id FROM vehicule WHERE brand = 'Nissan' AND model = 'GTR R35'), (SELECT id FROM category WHERE name = 'Sportive')),
    (UUID(), (SELECT id FROM vehicule WHERE brand = 'Nissan' AND model = 'GTR R35'), (SELECT id FROM category WHERE name = 'Circuit')),
    (UUID(), (SELECT id FROM vehicule WHERE brand = 'BMW' AND model = 'M4 Competition'), (SELECT id FROM category WHERE name = 'Street')),
    (UUID(), (SELECT id FROM vehicule WHERE brand = 'Porsche' AND model = '911 GT3 RS'), (SELECT id FROM category WHERE name = 'Sportive')),
    (UUID(), (SELECT id FROM vehicule WHERE brand = 'Koenigsegg' AND model = 'One:1'), (SELECT id FROM category WHERE name = 'Hypercar'));
