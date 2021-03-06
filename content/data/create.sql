# Create tables
CREATE TABLE `edge_content`.`categories` ( `id` INT NOT NULL , `name` VARCHAR(64) NOT NULL , PRIMARY KEY (`id`) ) ENGINE = InnoDB;
CREATE TABLE `edge_content`.`contacts` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(256) NOT NULL , `email` VARCHAR(256) NOT NULL , `phone` VARCHAR(256) NOT NULL , `facebook` VARCHAR(256) NULL , PRIMARY KEY (`id`) ) ENGINE = InnoDB;
CREATE TABLE `edge_content`.`events` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(256) NOT NULL , `category_id` INT NOT NULL , `description` TEXT NOT NULL , `file` VARCHAR(256) NOT NULL , `contact_id1` INT NULL, `contact_id2` INT NULL , PRIMARY KEY (`id`) , FOREIGN KEY(contact_id1) REFERENCES contacts(id) , FOREIGN KEY(contact_id2) REFERENCES contacts(id) , FOREIGN KEY(category_id) REFERENCES categories(id) ) ENGINE = InnoDB;

# Insert categories
INSERT INTO `edge_content`.`categories` (`id`, `name`) VALUES (1, 'Compute Aid');
INSERT INTO `edge_content`.`categories` (`id`, `name`) VALUES (2, 'Cyber Crusade');
INSERT INTO `edge_content`.`categories` (`id`, `name`) VALUES (3, 'Robotics');
INSERT INTO `edge_content`.`categories` (`id`, `name`) VALUES (4, 'Food For Fun');
INSERT INTO `edge_content`.`categories` (`id`, `name`) VALUES (5, 'Money Matters');
INSERT INTO `edge_content`.`categories` (`id`, `name`) VALUES (6, 'Newron');
INSERT INTO `edge_content`.`categories` (`id`, `name`) VALUES (7, 'In Focus');
INSERT INTO `edge_content`.`categories` (`id`, `name`) VALUES (8, 'Create It');
INSERT INTO `edge_content`.`categories` (`id`, `name`) VALUES (9, 'Innovati');
INSERT INTO `edge_content`.`categories` (`id`, `name`) VALUES (10, 'Just Like That');
INSERT INTO `edge_content`.`categories` (`id`, `name`) VALUES (11, 'Online events');

# Insert events
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Flawless', 1, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Code Mart', 1, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Bug Hunt', 1, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Crypto Quest', 1, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'NFS Most Wanted', 2, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Counter Strike Pro League', 2, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Fifa College League', 2, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Counter Strike College League', 2, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Fifa Pro League', 2, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Dota', 2, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Mortal Kombat', 2, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'City Rush', 3, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Street Soccer', 3, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Tour de Track', 3, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Hedge d Maze', 3, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Shadows', 3, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Make-a-bot', 3, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Blitzkreig Apocalypse', 3, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Gather The Litter', 3, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'X-Quiz''it', 4, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Nutrishopping', 4, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Beer Game', 4, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Creation X-nihilo', 4, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Word Warriors', 4, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Modelpoint.ppt', 4, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'B-Plan', 5, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'B-Quiz', 5, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Addomedia', 5, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Electronically Yours', 6, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Speak Out', 6, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'The Quiz', 6, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Crumbs', 7, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Odyssey', 7, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Rags to Riches', 8, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Mekanix', 8, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Project View', 9, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Khul Ja Sim Sim', 10, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Get ''Selfie''-ish', 10, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Code Out', 11, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Stock It', 11, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'KwizNet', 11, '', '', NULL, NULL);
INSERT INTO `edge_content`.`events` (`id`, `name`, `category_id`, `description`, `file`, `contact_id1`, `contact_id2`) VALUES (NULL, 'Game of Zones', 11, '', '', NULL, NULL);
