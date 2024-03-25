-- À propos du data type pour l'enregistrement des UUID: https://stackoverflow.com/questions/43056220/store-uuid-v4-in-mysql

CREATE TABLE `user` (
  `id` CHAR(36) PRIMARY KEY,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
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

-- Generate fake data for the user table
INSERT INTO `user` (`id`, `full_name`, `email`, `phone`, `password`)
VALUES 
    (UUID(), 'John Doe', 'john@example.com', '0612345678', 'password123'),
    (UUID(), 'Jane Smith', 'jane@example.com', '0712345678', 'password456'),
    (UUID(), 'Alice Johnson', 'alice@example.com', '0698765432', 'password789'),
    (UUID(), 'Bob Brown', 'bob@example.com', '0765432109', 'passwordABC');

-- Generate fake data for the license table
INSERT INTO `license` (`id`, `plate`)
VALUES 
    (UUID(), 'ABC123'),
    (UUID(), 'DEF456'),
    (UUID(), 'GHI789'),
    (UUID(), 'JKL012');

-- Generate fake data for the vehicule table
INSERT INTO `vehicule` (`id`, `brand`, `model`, `horsepower`, `daily_price`, `license_id`)
VALUES 
    (UUID(), 'Ferrari', '488 GTB', 670, 1500.00, (SELECT id FROM license WHERE plate = 'ABC123')),
    (UUID(), 'Lamborghini', 'Huracan', 610, 1800.00, (SELECT id FROM license WHERE plate = 'DEF456')),
    (UUID(), 'Porsche', '911', 450, 1200.00, (SELECT id FROM license WHERE plate = 'GHI789')),
    (UUID(), 'Audi', 'R8', 550, 1600.00, (SELECT id FROM license WHERE plate = 'JKL012'));

-- Generate fake data for the rental table
INSERT INTO `rental` (`id`, `start_date`, `end_date`, `vehicule_id`, `user_id`)
VALUES 
    (UUID(), '2020-07-28', '2020-08-05', (SELECT id FROM vehicule WHERE brand = 'Ferrari' AND model = '488 GTB'), (SELECT id FROM user WHERE full_name = 'John Doe')),
    (UUID(), '2020-08-10', '2020-08-15', (SELECT id FROM vehicule WHERE brand = 'Lamborghini' AND model = 'Huracan'), (SELECT id FROM user WHERE full_name = 'Jane Smith')),
    (UUID(), '2020-09-01', '2020-09-10', (SELECT id FROM vehicule WHERE brand = 'Porsche' AND model = '911'), (SELECT id FROM user WHERE full_name = 'Alice Johnson')),
    (UUID(), '2020-10-05', '2020-10-15', (SELECT id FROM vehicule WHERE brand = 'Audi' AND model = 'R8'), (SELECT id FROM user WHERE full_name = 'Bob Brown'));

-- Generate fake data for the category table
INSERT INTO `category` (`id`, `name`)
VALUES 
    (UUID(), 'Sports Car'),
    (UUID(), 'Luxury Car'),
    (UUID(), 'SUV'),
    (UUID(), 'Convertible');

-- Generate fake data for the category_vehicule table
INSERT INTO `category_vehicule` (`id`, `vehicule_id`, `category_id`)
VALUES 
    (UUID(), (SELECT id FROM vehicule WHERE brand = 'Ferrari' AND model = '488 GTB'), (SELECT id FROM category WHERE name = 'Sports Car')),
    (UUID(), (SELECT id FROM vehicule WHERE brand = 'Ferrari' AND model = '488 GTB'), (SELECT id FROM category WHERE name = 'Luxury Car')),
    (UUID(), (SELECT id FROM vehicule WHERE brand = 'Lamborghini' AND model = 'Huracan'), (SELECT id FROM category WHERE name = 'Sports Car')),
    (UUID(), (SELECT id FROM vehicule WHERE brand = 'Porsche' AND model = '911'), (SELECT id FROM category WHERE name = 'Sports Car')),
    (UUID(), (SELECT id FROM vehicule WHERE brand = 'Audi' AND model = 'R8'), (SELECT id FROM category WHERE name = 'Sports Car'));
