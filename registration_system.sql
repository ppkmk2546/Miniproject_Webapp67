-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 06:52 PM
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
-- Database: `registration_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `file_name`, `product_id`) VALUES
(1, 'SAMBA_1728749653.png', 7),
(2, 'SAMBA_1728749653.png', 7),
(3, 'SAMBA_1728749653.png', 7),
(4, 'jd_M1000JA_a_1728665048_1728747068.webp', 1),
(5, 'jd_M1000JA_a_1728665048_1728747068.webp', 1),
(6, 'jd_M1000JA_a_1728665048_1728747068.webp', 1),
(7, 'ZoomVomero5_1728757136.webp', 5),
(8, 'ZoomVomero5_1728757136.webp', 5),
(9, 'ZoomVomero5_1728757136.webp', 5),
(10, 'NIKE COCO_1728757031.png', 2),
(11, 'NIKE COCO_1728757031.png', 2),
(12, 'NIKE COCO_1728757031.png', 2),
(13, 'Air 4 Retro_1728747843.webp', 6),
(14, 'Air 4 Retro_1728747843.webp', 6),
(15, 'Air 4 Retro_1728747843.webp', 6),
(16, 'Crocs_1728750049.png', 19),
(17, 'Crocs_1728750049.png', 19),
(18, 'Crocs_1728750049.png', 19),
(19, 'New Balance women\'s shoes 530_1728750501.png', 20),
(20, 'New Balance women\'s shoes 530_1728750501.png', 20),
(21, 'New Balance women\'s shoes 530_1728750501.png', 20),
(22, 'Nike Air Force 1 \'07 Men\'s Shoes_1728750680.png', 21),
(23, 'Nike Air Force 1 \'07 Men\'s Shoes_1728750680.png', 21),
(24, 'Nike Air Force 1 \'07 Men\'s Shoes_1728750680.png', 21),
(25, 'samba_OG_Women_1728750987.png', 22),
(26, 'samba_OG_Women_1728750987.png', 22),
(27, 'samba_OG_Women_1728750987.png', 22),
(31, '462549215_1440580843276986_6072923094003668147_n_1728919872.jpg', 27),
(32, 'before_1728919872.png', 27),
(40, 'istockphoto-1434150819-612x612_1728922354.jpg', 28),
(41, 'istockphoto-1675676766-612x612_1728922354.jpg', 28),
(43, 'Jordan Air 1 Low Boots_1728752777.png', 23),
(44, 'istockphoto-1434150819-612x612_1728922955.jpg', 29),
(45, 'istockphoto-1675676766-612x612_1728922955.jpg', 29),
(46, 'istockphoto-1434150819-612x612_1728923108.jpg', 30),
(47, 'istockphoto-1675676766-612x612_1728923108.jpg', 30),
(48, 'istockphoto-1434150819-612x612_1728923143.jpg', 31),
(49, 'istockphoto-1675676766-612x612_1728923143.jpg', 31),
(50, 'istockphoto-1434150819-612x612_1728923310.jpg', 32),
(51, 'istockphoto-1675676766-612x612_1728923380.jpg', 33),
(52, 'istockphoto-1675676766-612x612_1728923467.jpg', 34),
(53, 'istockphoto-1675676766-612x612_1728923595.jpg', 35),
(54, 'istockphoto-1675676766-612x612_1728923614.jpg', 36),
(55, 'istockphoto-1675676766-612x612_1728923940.jpg', 37),
(56, 'istockphoto-1675676766-612x612_1728924031.jpg', 38),
(57, 'istockphoto-1434150819-612x612_1728924274.jpg', 39),
(58, 'istockphoto-1675676766-612x612_1728924274.jpg', 39);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Brand` varchar(255) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `Size` int(11) NOT NULL,
  `Color` varchar(50) NOT NULL,
  `Price` int(11) NOT NULL,
  `ProductDescription` text DEFAULT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `UpdatedDate` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `Discount` int(11) NOT NULL DEFAULT 0,
  `rating` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `Brand`, `Category`, `Size`, `Color`, `Price`, `ProductDescription`, `CreatedDate`, `UpdatedDate`, `Discount`, `rating`) VALUES
(1, 'New Balance men\'s shoes M1000', 'New Balance', 'Men\'s shoes', 10, 'Black', 6700, 'The New Balance 1000 returns as a millennial classic. First released in 1999, the 1000 reflected the era\'s bold, cutting-edge style with a sleek design but intricate details. A standard mesh upper and inverted synthetic overlay design feature a mesh plate that emerges from bolder overlay panels for a refined tech-inspired look. A segmented sole features ABZORB cushioning in the heel and forefoot, plus a Stability Web midfoot overlay.', '2024-10-11 16:32:26', '2024-10-12 22:31:08', 10, 5),
(2, 'Nike Dunk Low Women\'s Shoes', 'Nike', 'Women\'s shoes', 7, 'Brown', 3700, 'Built for the hardwood but also popular on the streets, an \'80s basketball icon returns with perfectly shiny overlays and classic team colors. Featuring an iconic hoops design, the Nike Dunk Low brings \'80s vintage back to the streets, while a low-profile, padded collar lets you take your game anywhere in comfort.', '2024-10-11 16:32:26', '2024-10-13 01:17:11', 10, 3),
(5, 'Nike Men\'s Zoom Vomero 5 Shoes', 'Nike', 'Men\'s shoes', 11, 'White', 6000, 'Blaze a new trail in the Zoom Vomero 5, a sophisticated, dimensional and easy-to-style favorite. Its fully layered design includes textile, leather and plastic accents that come together to create one of the coolest sneakers of the season.', '2024-10-11 16:32:26', '2024-10-13 01:18:56', 20, 5),
(6, 'Jordan Big Kids Air 4 Retro Shoes', 'Nike', 'Big Kids', 4, 'White', 5200, 'A take on the classic AJ4. This one returns with full-grain leather, synthetics, and premium fabrics. Vibrant colors and metallics give this shoe a modern twist, while original design elements like the floating eyepiece and mesh keep it feeling just as fresh as it did in \'89.', '2024-10-11 19:27:42', '2024-10-12 22:47:36', 30, 1),
(7, 'Adidas men\'s Samba OG shoes', 'Adidas', 'Men\'s shoes', 8, 'White', 3800, 'The Samba was born on the grass before becoming a timeless street style icon. This shoe stays true to its roots, with a soft leather upper and suede overlays.', '2024-10-11 16:32:26', '2024-10-12 23:14:13', 0, 4),
(19, 'Crocs Women\'s Classic Platform Clog', 'Crocs', 'Women\'s shoes', 4, 'Beige', 2590, 'CROCS Classic Platform Clog slip-on casual shoes, heel strap style, outstanding with a 1.6-inch shoe height, providing an elegant look but still maintaining the lightweight comfort of CROCS style with an upper made from Croslite ™ material that is highly durable and lightweight. The outsole is decorated with a pattern that provides good traction on both wet and dry floors. The insole is made from Croslite ™ foam, combined with Iconic Crocs Comfort ™ technology, providing flexible foot support and providing 360-degree softness and comfort for the soles throughout the wear.', '2024-10-12 23:20:49', NULL, 10, 0),
(20, 'New Balance women\'s shoes 530', 'New Balance', 'Women\'s shoes', 6, 'White', 3900, 'The 530 sneakers are a throwback to one of our classic running shoes. Combining everyday style with modern technology, ABZORB cushioning pads under the foot add unparalleled comfort. Put a retro touch on every step of the way with the 530 model.', '2024-10-12 23:28:21', NULL, 0, 0),
(21, 'Nike Air Force 1 \'07 Men\'s Shoes', 'Nike', 'Men\'s shoes', 9, 'White', 3700, 'The shine continues in the Nike Air Force 1 \'07, the OG basketball shoe that reimagines what you know best: durable stitched overlays, clean lines and the perfect amount of flash to make you shine.', '2024-10-12 23:31:20', NULL, 10, 0),
(22, 'Adidas women\'s shoes Samba OG', 'Adidas', 'Women\'s shoes', 5, 'White', 3800, 'The Samba was born on the grass before becoming a timeless street style icon. This shoe stays true to its roots, with a soft leather upper and suede overlays.', '2024-10-12 23:36:27', NULL, 10, 0),
(23, 'Jordan Air 1 Low Boots', 'Nike', 'Big Kids', 8, 'Black', 3300, 'An iconic look that will last, this AJ1 pairs the classic design of the original with premium materials that will keep you going all day long.', '2024-10-13 00:06:17', '2024-10-14 23:16:56', 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `urole`, `created_at`, `username`) VALUES
(1, 'PpLarry@gmail.com', '$2y$10$CMaUdER9Un15NF4a/xzGteTEEvy2iDBayVecaSwNjt8q70GMzHbAS', 'user', '2024-10-10 22:10:36', 'pplarry'),
(2, 'ppV2@gmail.com', '$2y$10$Xwv1RPD3XRr0OaNUlmr4HOWZzwaoAR.Pip2DNiFBQr7MsrCCXtigG', 'user', '2024-10-10 22:51:12', 'ppV2'),
(3, 'LarryAdmin@gmail.com', '$2y$10$4d2st6XPpF0PAxOpLyKEKuzvW0H3b.AEM9B6Q5OMGEcNgXS1X7aLm', 'admin', '2024-10-10 23:53:20', 'LarryAdmin'),
(4, 'Adam@gmail.com', '$2y$10$MoJu2BU89yHI8H3fOQtX9OeIUniSLoh9eE.AkO18SqlRswFmBPD2O', 'user', '2024-10-11 07:47:22', 'Adam'),
(5, 'test@test.test', '$2y$10$Ofoce8EKiTD031CEOZMZQO0keJ3uiItRsH5IYQk4hFzteG3zIsrBa', 'admin\r\n', '2024-10-11 09:18:12', 'mark'),
(6, 'com@com.com', '$2y$10$Ofoce8EKiTD031CEOZMZQO0keJ3uiItRsH5IYQk4hFzteG3zIsrBa', 'admin', '2024-10-11 09:18:12', 'mark');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
