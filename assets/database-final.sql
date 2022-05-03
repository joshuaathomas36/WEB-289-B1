-- Username: admintester
-- Password: Jj*6P0E5tv&D

-- Username: membertester
-- Password: 47CRCyJ%bXog

DROP DATABASE IF EXISTS `joshuaat_delight`;
CREATE DATABASE IF NOT EXISTS `joshuaat_delight`;
USE `joshuaat_delight`;

CREATE TABLE `site_user` (
  `user_id` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255),
  `password` varchar(255),
  `user_level` ENUM ('M', 'A', 'S'),
  `first_name` varchar(50),
  `last_name` varchar(50),
  `email` varchar(100)
);

CREATE TABLE `recipe` (
  `recipe_id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50),
  `cook_time` int,
  `instructions` json,
  `subcategory_id` int,
  `approved` boolean
);

CREATE TABLE `review` (
  `review_id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `recipe_id` int,
  `rating` tinyint,
  `review` text
);

CREATE TABLE `favorite` (
  `favorite_id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `recipe_id` int
);

CREATE TABLE `meal_planner` (
  `meal_planner_id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `recipe_id` int
);

CREATE TABLE `recommended` (
  `recommended_id` int PRIMARY KEY AUTO_INCREMENT,
  `recommender_user_id` int,
  `user_id` int,
  `recommended_recipe_id` int
);

CREATE TABLE `ingredient` (
  `ingredient_id` int PRIMARY KEY AUTO_INCREMENT,
  `ingredient_name` varchar(50)
);

CREATE TABLE `measurement` (
  `measurement_id` int PRIMARY KEY AUTO_INCREMENT,
  `measurement` varchar(50)
);

CREATE TABLE `recipe_ingredient` (
  `recipe_ingredient_id` int PRIMARY KEY AUTO_INCREMENT,
  `recipe_id` int,
  `amount` int,
  `measurement_id` int,
  `ingredient_id` int
);

CREATE TABLE `uploaded_image` (
  `uploaded_image_id` int PRIMARY KEY AUTO_INCREMENT,
  `recipe_id` int,
  `uploaded_image` varchar(200)
);

CREATE TABLE `subcategory` (
  `subcategory_id` int PRIMARY KEY AUTO_INCREMENT,
  `subcategory_name` varchar(20),
  `category_id` int
);

CREATE TABLE `category` (
  `category_id` int PRIMARY KEY AUTO_INCREMENT,
  `category_name` varchar(20)
);

ALTER TABLE `review` ADD FOREIGN KEY (`user_id`) REFERENCES `site_user` (`user_id`);
ALTER TABLE `review` ADD FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`);

ALTER TABLE `favorite` ADD FOREIGN KEY (`user_id`) REFERENCES `site_user` (`user_id`);
ALTER TABLE `favorite` ADD FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`);

ALTER TABLE `meal_planner` ADD FOREIGN KEY (`user_id`) REFERENCES `site_user` (`user_id`);
ALTER TABLE `meal_planner` ADD FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`);

ALTER TABLE `recommended` ADD FOREIGN KEY (`recommender_user_id`) REFERENCES `site_user` (`user_id`);
ALTER TABLE `recommended` ADD FOREIGN KEY (`user_id`) REFERENCES `site_user` (`user_id`);
ALTER TABLE `recommended` ADD FOREIGN KEY (`recommended_recipe_id`) REFERENCES `recipe` (`recipe_id`);

ALTER TABLE `recipe_ingredient` ADD FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`ingredient_id`);
ALTER TABLE `recipe_ingredient` ADD FOREIGN KEY (`measurement_id`) REFERENCES `measurement` (`measurement_id`);
ALTER TABLE `recipe_ingredient` ADD FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`);

ALTER TABLE `uploaded_image` ADD FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`);
ALTER TABLE `recipe` ADD FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`subcategory_id`);
ALTER TABLE `subcategory` ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

INSERT INTO `site_user` (`user_id`, `username`, `password`, `user_level`, `first_name`, `last_name`, `email`) VALUES
(1, 'joshuaathomas36', '$2y$10$Ip41CgKq90y8Zf3Oi0PHquIrx9VWlshElXJ1cYn1JMMUq/661Qivu', 'S', 'Joshua', 'Thomas', 'joshuaathomas36@students.abtech.edu'),
(2, 'admintester', '$2y$10$K5mZaFQA/KpvTB9oNRWuNO9SviyXbtOntp/BDwqtva19J4c7RwjPm', 'A', 'Admin', 'Tester', 'admintester@email.com'),
(3, 'membertester', '$2y$10$vRQdyAg4qohElFESR/4Ji.ps4cp7dEQdkGg77yCE5Dgqevqhz4PDG', 'M', 'Member', 'Tester', 'membertester@email.com'),
(4, 'johndoe', '$2y$10$vRQdyAg4qohElFESR/4Ji.ps4cp7dEQdkGg77yCE5Dgqevqhz4PDG', 'M', 'John', 'Doe', 'johndoe@email.com');

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Breakfast'), (2, 'Lunch'), (3, 'Dinner'), (4, 'Dessert');

INSERT INTO `subcategory` (`subcategory_id`, `subcategory_name`, `category_id`) VALUES
(1, 'Pancakes', 1), (2, 'Sandwich', 2), (3, 'Pasta', 3),
(4, 'Pork', 3), (5, 'Pizza', 3), (6, 'Cake', 4);

INSERT INTO `recipe` (`recipe_id`, `name`, `cook_time`, `instructions`, `subcategory_id`, `approved`) VALUES 
(1, 'Blueberry Pancakes', 60, '{"Step 1" : "Example text 1", "Step 2" : "Example text 2", "Step 3" : "Example text 3"}', 1, TRUE),
(2, 'Sandwich', 5, '{"Step 1" : "Example text 1", "Step 2" : "Example text 2", "Step 3" : "Example text 3"}', 2, TRUE),
(3, 'Spaghetti', 90, '{"Step 1": "Example text 1", "Step 2": "Example text 2", "Step 3": "Example text 3"}', 3, TRUE),
(4, 'Pork Ribs', 90, '{"Step 1" : "Example text 1", "Step 2" : "Example text 2", "Step 3" : "Example text 3"}', 4, TRUE),
(5, 'Chocolate Cake', 120, '{"Step 1" : "Example text 1", "Step 2" : "Example text 2", "Step 3" : "Example text 3"}', 6, TRUE);

INSERT INTO `review` (`review_id`, `user_id`, `recipe_id`, `rating`, `review`) VALUES
(1, 3, 1, 5, 'This is a review.'),
(2, 3, 2, 5, 'This is a review.'),
(3, 3, 3, 4, 'This is a review.'),
(4, 4, 4, 5, 'This is a review.');

INSERT INTO `favorite` (`favorite_id`, `user_id`, `recipe_id`) VALUES
(1, 3, 1);

INSERT INTO `meal_planner` (`meal_planner_id`, `user_id`, `recipe_id`) VALUES
(1, 3, 2);

INSERT INTO `recommended` (`recommended_id`, `recommender_user_id`, `user_id`, `recommended_recipe_id`) VALUES
(1, 4, 3, 4);

INSERT INTO `ingredient` (`ingredient_id`, `ingredient_name`) VALUES
(1, 'Blueberries'), (2, 'Eggs'), (3, 'Bisquick'), (4, 'Milk'),
(5, 'Nutmeg'), (6, 'Cinnamon'), (7, 'Spaghetti Sauce'), (8, 'Water'),
(9, 'Spaghetti Noddles'), (10, 'Salt'), (11, 'Pepper'), (12, 'Applesauce'),
(13, 'Pork Loin'), (14, 'Onion'), (15, 'Steak'), (16, 'Pork Chops'),
(17, 'Chicken'), (18, 'Breaded Chicken'), (19, 'butter'), (20, 'Bread'),
(21, 'margarine'), (22, 'American Cheese'), (23, 'Tomato'), (24, 'jalapeno pepper');

INSERT INTO `measurement` (`measurement_id`, `measurement`) VALUES
(1, 'tsp'), (2, 'Tbsp'), (3, 'Oz'), (4, 'fl. Oz'), (5, 'Cup'), (6, 'Cups'), (7, 'qt'), (8, 'pt'),
(9, 'gal'), (10, 'lb'), (11, 'mL'), (12, 'g'), (13, 'kg'), (14, 'l');

INSERT INTO `recipe_ingredient` (`recipe_ingredient_id`, `recipe_id`, `amount`, `measurement_id`, `ingredient_id`) VALUES
(1, 1, 1, 1, 1), (2, 1, 1, 1, 2), (3, 1, 1, 1, 3), (4, 1, 1, 1, 4), (5, 1, 1, 1, 5), (6, 1, 1, 1, 6),
(7, 3, 1, 1, 7), (8, 3, 1, 1, 8), (9, 3, 1, 1, 9), (10, 2, 1, 1, 19), (11, 2, 1, 1, 20),
(12, 2, 1, 1, 22), (13, 2, 1, 1, 23), (14, 2, 1, 1, 24), (15, 4, 1, 1, 10), (16, 4, 1, 1, 11),
(17, 4, 1, 1, 12), (18, 4, 1, 1, 13), (19, 4, 1, 1, 14);

INSERT INTO `uploaded_image` (`uploaded_image_id`, `recipe_id`, `uploaded_image`) VALUES
(1, 1, 'IMG-1.jpg'), (2, 2, 'IMG-2.jpg'),
(3, 3, 'IMG-3.jpg'), (4, 4, 'IMG-4.jpg'), (5, 5, 'IMG-5.jpg');
