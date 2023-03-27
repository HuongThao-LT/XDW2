-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 18, 2022 lúc 06:29 PM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `coffeeshop`
--

--
-- Đang đổ dữ liệu cho bảng `coffee_brands`
--

INSERT INTO `coffee_brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Nescafé', NULL, NULL),
(2, 'Seattle\'s Best', NULL, NULL),
(3, 'Eight O\'Clock Coffee', NULL, NULL),
(4, 'Folgers', NULL, NULL),
(5, 'Starbucks', NULL, NULL);

--
-- Đang đổ dữ liệu cho bảng `coffee_types`
--

INSERT INTO `coffee_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Cortado', NULL, NULL),
(2, 'Flat White', NULL, NULL),
(3, 'Macchiato', NULL, NULL),
(4, 'Espresso', NULL, NULL),
(5, 'Doppio', NULL, NULL);

--
-- Đang đổ dữ liệu cho bảng `coffees`
--

INSERT INTO `coffees` (`id`, `name`, `image`, `price`, `status`, `brand`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Coconut coffee', 'coconut-iced-coffee1650297205.jpg', 3, 1, 1, 2, 'Coconut coffee is made with robust coffee and coconut milk', '2022-04-04 08:53:25', '2022-04-18 08:53:25'),
(2, 'Iced Vanilla Latte', 'Iced-Vanilla-Latte1650297273.jpg', 4, 1, 4, 5, 'A vanilla iced latte is espresso or strong brewed coffee that is chilled over ice and sweetened with a touch of cream and vanilla syrup', '2022-04-18 08:53:25', '2022-04-18 08:54:33'),
(3, 'Iced White Chocolate Mocha', 'iced-white-mocha1650297338.jpg', 3.5, 1, 3, 5, 'Our signature espresso meets white chocolate sauce, milk and ice, and then is finished off with sweetened whipped cream to create this supreme white chocolate delight', '2022-04-18 08:53:25', '2022-04-18 08:55:38'),
(4, 'Caffe Mocha', 'Cafe-Mocha1650297660.jpg', 3.4, 1, 4, 5, 'It is made up of espresso, milk, and chocolate', '2022-03-11 08:53:25', '2022-04-18 09:01:00'),
(5, 'Caramel Macchiato', 'IcedCaramelMacchiato1650297735.jpg', 3.2, 1, 3, 5, 'A Caramel Macchiato is a coffee beverage with steamed milk, espresso, vanilla syrup and caramel drizzle', '2022-03-07 08:53:25', '2022-04-18 09:02:15'),
(6, 'Asian Dolce Latte', 'asian-dolce-latte1650297830.jpg', 3, 1, 4, 5, 'Double-shots of the premium, dark-roasted Starbucks Espresso Roast, combine with the uniquely developed dolce sauce', '2022-04-18 08:53:25', '2022-04-18 09:03:50'),
(7, 'Cold Foam Iced Espresso', 'Cold-Foam-Iced-Espresso1650297837.jpg', 3.5, 1, 4, 5, 'Slightly sweetened ice-cold espresso, poured through a distinct layer of surprisingly creamy, nonfat milk cold foam', '2022-03-16 08:53:25', '2022-04-18 09:03:57'),
(8, 'Espresso Con Panna', 'EspressoConPanna1650297858.jpg', 3.6, 1, 4, 5, 'a single or double shot of espresso topped with whipped cream', '2022-04-18 08:53:25', '2022-04-18 09:04:18'),
(9, 'Matcha & Espresso Fusion', 'Iced-Matcha-Espresso-Fusion1650297914.jpg', 3.8, 1, 4, 4, 'Matcha Espresso Fusion is a beautifully layered drink of matcha green tea and espresso with milk', '2022-04-18 08:53:25', '2022-04-18 09:05:14'),
(10, 'Almond Milk Hazelnut Frappuccino Cream', 'java-chip-frappuccino1650298044.jpg', 4.2, 1, 1, 5, 'Coffee blended with toffee nut syrup, milk and ice. Topped with hazelnut drizzle', '2022-03-22 08:53:25', '2022-04-18 09:07:24'),
(11, 'Green Tea Cream Frappuccino', 'green-tea-cream-cappuchino1650298093.jpg', 3.5, 1, 2, 3, 'We blend sweetened premium matcha green tea, milk and ice and top it with sweetened whipped cream to give you a delicious boost of energy', '2022-04-18 08:53:25', '2022-04-18 09:08:13'),
(12, 'Black Tea', 'black-tea1650298129.jpg', 3.2, 1, 1, 2, 'Delicious', '2022-04-01 08:53:25', '2022-04-18 09:08:49'),
(13, 'American Coffee', 'Caffe-americano-grande1650298165.jpg', 3, 1, 1, 1, 'Yummy', '2022-04-18 08:53:25', '2022-04-18 09:09:25'),
(14, 'Black Tea Cream Cheese', 'hong-tra-kem-cheese1650298238.png', 2.9, 1, 1, 1, 'Delicious', '2022-04-14 08:53:25', '2022-04-18 09:10:38'),
(15, 'Oolong Tea Boba', 'Oolong-Milk-Tea1650298303.jpg', 3.4, 1, 1, 2, 'Delicious', '2022-04-18 08:53:25', '2022-04-18 09:11:43'),
(16, 'Peach tea', 'peach-tea1650298369.jpg', 3.2, 1, 1, 3, 'sweetened with peach, this beverage tastes extra refreshing in warm weather', '2022-04-10 08:53:25', '2022-04-18 09:12:49'),
(17, 'Cappuccino', 'Cappuccino1650298382.png', 3, 1, 1, 2, 'Cappuccino is a coffee drink that today is typical composed of singed espresso shot and hot milk', '2022-04-18 08:53:25', '2022-04-18 09:13:02'),
(18, 'Lychee tea', 'lychee-tea1650298446.jpg', 4, 1, 1, 3, 'Lychee tea is a fruit tea that is scented with a sweet lychee aroma. It is mainly made with black tea leaves.', '2022-03-08 08:53:25', '2022-04-18 09:14:06'),
(19, 'Hazelnut Macchiato', 'hazelnut-macchiato1650298464.jpg', 6.4, 1, 5, 4, 'Delicious Hazelnut Macchiato', '2022-04-18 08:53:25', '2022-04-18 09:14:24'),
(20, 'Ristretto Bianco', 'ristretto-bianco1650298474.jpg', 7.2, 1, 5, 4, 'Delicious Ristretto Bianco', '2022-03-30 08:53:25', '2022-04-18 09:14:34'),
(21, 'Caffè Americano', 'Caffe-Americano1650298486.jpg', 6.47, 1, 5, 4, 'Delicious Caffè Americano', '2022-04-18 08:53:25', '2022-04-18 09:14:46'),
(22, 'Flavored Latte', 'IcedFlavoredLatte1650298509.jpg', 6.92, 1, 5, 4, 'Delicious Flavored Latte', '2022-04-17 08:53:25', '2022-04-18 09:15:09'),
(23, 'Iced Caffè Mocha', 'iced-caffee-mocha1650298522.jpg', 4.42, 1, 5, 4, 'Delicious Iced Caffè Mocha', '2022-04-18 08:53:25', '2022-04-18 09:15:22'),
(24, 'Skinny Flavored Latte', 'Skinny-Flavored-Latte1650298530.jpg', 5.78, 1, 5, 4, 'Delicious Skinny Flavored Latte', '2022-04-06 08:53:25', '2022-04-18 09:15:30');

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'User', NULL, NULL),
(2, 'Administrator', NULL, NULL);

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `type`) VALUES
(1, 'John Wick', 'john@gmail.com', '781223332', 'john123', NULL, '$2y$13$MkX0sAqXTJIlT8gz3SWzwO1xELuI986ojjK4gJLrN0knM2FGhW842', NULL, NULL, NULL, 1),
(2, 'Admin', 'admin@gmail.com', '1112222', 'admin', NULL, '$2y$13$MkX0sAqXTJIlT8gz3SWzwO1xELuI986ojjK4gJLrN0knM2FGhW842', NULL, NULL, NULL, 2),
(3, 'Kaiser', 'kaiser@gmail.com', '3322420000', 'kaiser199', NULL, '$2y$13$MkX0sAqXTJIlT8gz3SWzwO1xELuI986ojjK4gJLrN0knM2FGhW842', NULL, NULL, NULL, 1),
(4, 'Developer', 'dev@gmail.com', '1113335557', 'developerAdmin', NULL, '$2y$13$MkX0sAqXTJIlT8gz3SWzwO1xELuI986ojjK4gJLrN0knM2FGhW842', NULL, NULL, NULL, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
