-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Dec 09. 08:58
-- Kiszolgáló verziója: 10.4.24-MariaDB
-- PHP verzió: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `skripto_project`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `type` varchar(50) NOT NULL,
  `image_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `foods`
--

INSERT INTO `foods` (`id`, `name`, `description`, `price`, `type`, `image_link`) VALUES
(7, 'Pizza Margherita', 'Classic Margherita pizza with tomato, mozzarella, and basil.', '12.98', 'Pizza', 'https://media.istockphoto.com/id/938742222/photo/cheesy-pepperoni-pizza.jpg?s=612x612&w=0&k=20&c=D1z4xPCs-qQIZyUqRcHrnsJSJy_YbUD9udOrXpilNpI='),
(14, 'Chicken Salad', 'Witch chicken', '19.00', 'Salad', 'https://www.wellplated.com/wp-content/uploads/2023/04/Lemon-Grilled-Chicken-Salad.jpg'),
(19, 'Hawaii', 'With ananas', '23.00', 'Pizza', 'https://thestayathomechef.com/wp-content/uploads/2023/04/Hawaiian-Pizza-2.jpg'),
(20, 'Pizza Margherita', 'Classic pizza with tomato sauce and mozzarella cheese', '8.99', 'Pizza', 'https://images.prismic.io/eataly-us/ed3fcec7-7994-426d-a5e4-a24be5a95afd_pizza-recipe-main.jpg?auto=compress,format'),
(21, 'Caesar Salad', 'Fresh romaine lettuce, croutons, parmesan cheese, and Caesar dressing', '7.49', 'Salad', 'https://www.mindmegette.hu/images/387/Social/lead_Social_eredeti-cezar-salata-recept.jpg'),
(22, 'Spaghetti Bolognese', 'Spaghetti pasta with rich meat sauce', '9.99', 'Noodle', 'https://www.countdown.co.nz/Content/Recipes/230232-Classic-SpagBol_810x520.jpg'),
(23, 'Vegetarian Pizza', 'Delicious pizza with assorted vegetables and mozzarella cheese', '10.99', 'Pizza', 'https://www.simplyrecipes.com/thmb/wyfKZ6r4an5GdL19fFiAFlgr19c=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/Simply-Recipes-Vegetarian-Pizza-LEAD-5-03d81aaf35f24e5b99de36d2c29c15eb.jpg'),
(24, 'Greek Salad', 'Healthy salad with tomatoes, cucumbers, olives, and feta cheese', '8.49', 'Salad', 'https://hips.hearstapps.com/hmg-prod/images/greek-salad-index-642f292397bbf.jpg?crop=0.6666666666666667xw:1xh;center,top&resize=1200:*'),
(25, 'Chicken Alfredo Pasta', 'Creamy Alfredo sauce with grilled chicken over fettuccine pasta', '11.99', 'Noodle', 'https://amandascookin.com/wp-content/uploads/2021/08/Chicken-Alfredo-RC-SQ.jpg'),
(26, 'Pepperoni Pizza', 'Classic pizza with pepperoni, tomato sauce, and mozzarella cheese', '9.99', 'Pizza', 'https://www.allrecipes.com/thmb/iXKYAl17eIEnvhLtb4WxM7wKqTc=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/240376-homemade-pepperoni-pizza-Beauty-3x4-1-6ae54059c23348b3b9a703b6a3067a44.jpg'),
(27, 'Cobb Salad', 'Tossed salad with grilled chicken, avocado, bacon, and blue cheese', '8.99', 'Salad', 'https://www.allrecipes.com/thmb/lUCXnzWTl9WOQ9NRAT08hA4O2lE=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/14415-cobb-salad-DDMFS-4x3-608ba9c5768b49079eb75fe9a9898307.jpg'),
(28, 'Shrimp Scampi', 'Sautéed shrimp in a garlic butter and white wine sauce over linguine pasta', '12.49', 'Noodle', 'https://www.allrecipes.com/thmb/jiV_4f8vXFle1RdFLgd8-_31J3M=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/229960-shrimp-scampi-with-pasta-DDMFS-4x3-e065ddef4e6d44479d37b4523808cc23.jpg'),
(29, 'Mushroom Pizza', 'Pizza topped with mushrooms, tomato sauce, and mozzarella cheese', '10.49', 'Pizza', 'https://www.allrecipes.com/thmb/3qkooqf4vsQ3DjzjIZy0s6ZSwC0=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/36107allies-mushroom-pizzafabeveryday4x3-005f809371b147378094d60f28daf212.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(4, 'ubnt', '123'),
(5, 'admin', 'admin'),
(6, 'tamas', 'asd');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
