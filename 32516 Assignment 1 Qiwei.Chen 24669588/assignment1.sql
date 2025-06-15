-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2025 at 01:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment1`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `product_name` varchar(20) DEFAULT NULL,
  `unit_price` float(8,2) DEFAULT NULL,
  `unit_quantity` varchar(15) DEFAULT NULL,
  `in_stock` int(10) UNSIGNED DEFAULT NULL,
  `category` varchar(30) DEFAULT NULL,
  `image_path` varchar(100) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `unit_price`, `unit_quantity`, `in_stock`, `category`, `image_path`, `keywords`) VALUES
(1000, 'Fish Fingers', 2.55, '400 gram', 1500, 'Frozen > Seafood', 'img/fish_fingers.jpeg', 'fish fingers seafood frozen pack quick meal'),
(1001, 'Fish Fingers', 5.00, '1000 gram', 750, 'Frozen > Seafood', 'img/fish_fingers1kg.jpeg', 'fish fingers seafood frozen large pack quick meal'),
(1002, 'Hamburger Patties', 2.35, 'Pack 10', 1200, 'Fresh > Meat', 'img/hamburger_patties.jpeg', 'hamburger patties beef meat fresh burger'),
(1003, 'Shelled Prawns', 6.90, '250 gram', 300, 'Frozen > Seafood', 'img/ShelledPrawns.jpeg', 'prawns seafood frozen shellfish quick cook'),
(1004, 'Tub Ice Cream', 1.80, 'I Litre', 800, 'Frozen > Dessert', 'img/tub_ice_cream.jpeg', 'ice cream frozen sweet dessert snack'),
(1005, 'Tub Ice Cream', 3.40, '2 Litre', 1200, 'Frozen > Dessert', 'img/tub_ice_cream2l.jpeg', 'ice cream dessert frozen sweet cold dairy'),
(2000, 'Panadol', 3.00, 'Pack 24', 2000, 'Pharmacy > Pain Relief', 'img/panadol_16.jpeg', 'panadol medicine strong headache pain'),
(2001, 'Panadol', 5.50, 'Bottle 50', 1000, 'Pharmacy > Pain Relief', 'img/panadol_16.jpeg', 'panadol bottle liquid pain relief medicine'),
(2002, 'Bath Soap', 2.60, 'Pack 6', 500, 'Home > Personal Care', 'img/bath_soap.jpeg', 'soap bath hygiene body wash personal'),
(2003, 'Garbage Bags Small', 1.50, 'Pack 10', 500, 'Home > Rubbish Bags', 'img/garbage_bags_small.jpeg', 'garbage bag small home clean disposable'),
(2004, 'Garbage Bags Large', 5.00, 'Pack 50', 300, 'Home > Rubbish Bags', 'img/garbage_bags_large.jpeg', 'garbage bag large heavy duty clean home'),
(2005, 'Washing Powder', 4.00, '1000 gram', 800, 'Home > Cleaning', 'img/washing_powder.jpeg', 'washing powder clothes laundry clean detergent'),
(3000, 'Cheddar Cheese', 8.00, '500 gram', 997, 'Fresh > Dairy', 'img/cheddar_cheese_500.jpeg', 'cheddar cheese dairy frozen milk product'),
(3001, 'Cheddar Cheese', 15.00, '1000 gram', 999, 'Fresh > Dairy', 'img/cheddar_cheese_1kg.jpeg', 'cheddar cheese shredded frozen dairy pizza'),
(3002, 'T Bone Steak', 7.00, '1000 gram', 200, 'Fresh > Meat', 'img/t_bone_steak.jpeg', 'steak beef fresh meat t bone premium'),
(3003, 'Navel Oranges', 3.99, 'Bag 20', 194, 'Fresh > Fruit', 'img/navel_oranges.jpeg', 'orange fruit fresh vitamin c sweet'),
(3004, 'Bananas', 1.49, 'Kilo', 394, 'Fresh > Fruit', 'img/bananas.jpeg', 'banana fruit fresh energy snack natural'),
(3005, 'Peaches', 2.99, 'Kilo', 494, 'Fresh > Fruit', 'img/peaches.jpeg', 'peach fruit fresh soft juicy'),
(3006, 'Grapes', 3.50, 'Kilo', 200, 'Fresh > Fruit', 'img/grapes.jpeg', 'grapes fruit fresh snack bunch'),
(3007, 'Apples', 1.99, 'Kilo', 500, 'Fresh > Fruit', 'img/apples.jpeg', 'apple fruit fresh red healthy'),
(4000, 'Earl Grey Tea Bags', 2.49, 'Pack 25', 1199, 'Beverages > Tea', 'img/earl_grey_25.jpeg', 'tea bags pack earl grey aroma drink'),
(4001, 'Earl Grey Tea Bags', 7.25, 'Pack 100', 1198, 'Beverages > Tea', 'img/earl_grey_100.jpeg', 'tea bags earl grey strong morning drink'),
(4002, 'Earl Grey Tea Bags', 13.00, 'Pack 200', 800, 'Beverages > Tea', 'img/earl_grey_200.jpeg', 'tea bags earl grey premium full flavour'),
(4003, 'Instant Coffee', 2.89, '200 gram', 499, 'Beverages > Coffee', 'img/instant_coffee_200.jpeg', 'coffee instant drink morning energy boost'),
(4004, 'Instant Coffee', 5.10, '500 gram', 498, 'Beverages > Coffee', 'img/instant_coffee_500.jpeg', 'coffee instant strong bold flavor energy'),
(4005, 'Chocolate Bar', 2.50, '500 gram', 300, 'Snacks > Chocolate', 'img/chocolate_bar.jpeg', 'chocolate bar snack dessert sweet milk'),
(5000, 'Dry Dog Food', 5.95, '5 kg Pack', 400, 'Pet-food > Dog', 'img/dry_dog_5kg.jpeg', 'dog food dry kibble 5kg large breed'),
(5001, 'Dry Dog Food', 1.95, '1 kg Pack', 400, 'Pet-food > Dog', 'img/dry_dog_1kg.jpeg', 'dog food dry kibble 1kg pack puppy'),
(5002, 'Bird Food', 3.99, '500g packet', 200, 'Pet-food > Bird', 'img/bird_food.jpeg', 'bird food pet seed packet parrot finch'),
(5003, 'Cat Food', 2.00, '500g tin', 200, 'Pet-food > Cat', 'img/cat_food.jpeg', 'cat food pet dry kibble packet feline'),
(5004, 'Fish Food', 3.00, '500g packet', 200, 'Pet-food > Fish', 'img/fish_food.jpeg', 'fish food aquarium packet water pet'),
(2006, 'Laundry Bleach', 3.55, '2 Litre Bottle', 500, 'Home > Cleaning', 'img/laundry_bleach.jpeg', 'laundry bleach home wash clean clothes white'),
(3008, 'Apple', 3.99, '500g', 0, 'Fresh > Fruits', 'img/apple.jpg', 'apple fruit fresh red healthy'),
(3009, 'Milk', 5.99, '1L', 0, 'Beverages > Milk', 'img/milk.jpeg', 'milk drink dairy fresh cold'),
(3010, 'Pizza', 12.99, '1 piece', 10, 'Frozen > Ready Meals', 'img/pizza.jpeg', 'frozen pizza cheese meal quick'),
(3011, 'Lettuce', 2.50, '1 head', 15, 'Fresh > Vegetables', 'img/lettuce.jpeg', 'lettuce vegetable green healthy'),
(3012, 'Juice', 4.80, '500ml', 7, 'Beverages > Juice', 'img/juice.jpeg', 'orange juice drink healthy fresh');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
