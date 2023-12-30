-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th12 30, 2023 lúc 04:33 AM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `drinkshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cat_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
('cf', 'COFFEE'),
('fr', 'FREEZE'),
('ft', 'FRUITEA');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `drink`
--

DROP TABLE IF EXISTS `drink`;
CREATE TABLE IF NOT EXISTS `drink` (
  `drink_id` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `drink_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `img` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cat_id` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`drink_id`),
  KEY `maloai` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `drink`
--

INSERT INTO `drink` (`drink_id`, `drink_name`, `price`, `img`, `cat_id`) VALUES
('CF1', 'Phin Đen Đá', 20000, '1701237013.jpg', 'cf'),
('CF2', 'Bạc Xỉu Đá', 30000, '1703332296.jpg', 'cf'),
('CF3', 'Phin Sữa Nóng', 25000, '1701237061.jpg', 'cf'),
('FR1', 'Freeze Quả Mộng Anh Đào', 50000, '1701237469.jpg', 'fr'),
('FR2', 'Freeze Trà Xanh', 50000, '1701237491.jpg', 'fr'),
('FR3', 'Freeze Cookies & Cream', 50000, '1701237518.jpg', 'fr'),
('FT1', 'Trà Sen Vàng', 40000, '1701237299.jpg', 'ft'),
('FT2', 'Trà Thạch Vãi', 35000, '1701237335.jpg', 'ft'),
('FT3', 'Trà Thạch Đào', 35000, '1701237355.jpg', 'ft');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `status` int NOT NULL DEFAULT '0',
  `email_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id_order`) USING BTREE,
  KEY `od_ibfk_1` (`email_user`),
  KEY `email_user` (`email_user`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id_order`, `name`, `address`, `phone`, `status`, `email_user`) VALUES
(69, 'Nguyễn Hữu Vinh', 'Phước Thới, Phước Lại, Cần Giuộc', '0338493406', 1, 'tuan@gmail.com'),
(76, 'Nguyễn Hữu Vinh', 'Phước Thới, Phước Lại, Cần Giuộc', '0338493406', 0, 'tuan@gmail.com'),
(71, 'Nguyễn Hữu Vinh', 'Phước Thới, Phước Lại, Cần Giuộc', '0338493406', 1, 'tuan@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_detail`
--

DROP TABLE IF EXISTS `orders_detail`;
CREATE TABLE IF NOT EXISTS `orders_detail` (
  `id_order` int NOT NULL,
  `id_drink` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` int NOT NULL,
  KEY `odd_ibfk_1` (`id_order`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `orders_detail`
--

INSERT INTO `orders_detail` (`id_order`, `id_drink`, `price`, `quantity`, `subtotal`) VALUES
(69, 'FT2', 35000, 1, 35000),
(69, 'FR3', 50000, 2, 100000),
(69, 'CF3', 25000, 4, 100000),
(69, 'CF1', 20000, 2, 40000),
(71, 'FT3', 35000, 3, 105000),
(71, 'FT2', 35000, 2, 70000),
(76, 'CF2', 30000, 2, 60000),
(76, 'CF1', 20000, 2, 40000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Hữu Vinh', 'vinh@gmail.com', NULL, 1, '$2y$12$L6QxFj7zDM2U67KaDjk2U.blq2Je6TzmbbT1g1LJfA0vC0ZfY5X0e', NULL, '2023-12-18 23:22:49', '2023-12-24 22:21:58'),
(24, 'Thái Tuấn', 'tuan@gmail.com', NULL, 0, '$2y$12$daN5ViT0rtHzDiiH6mxPVepjPL8PJxV38zGSV7t30lRuqQufYm/fq', NULL, '2023-12-27 19:50:24', '2023-12-27 19:50:24'),
(19, 'admin', 'admin@admin.com', NULL, 1, '$2y$12$4Vb6wDyxtMvxfG56ezEzZOUEZeO1AKOpm2y0fTFFFSK/4XeUixm6C', NULL, '2023-12-24 21:49:47', '2023-12-24 21:50:31'),
(23, 'b', 'b@b.com', NULL, 0, '$2y$12$xFKR6pBkWUVWW0VHyYooX.woUzMwt/PqThF84eeEMTT4uUHiwFx/i', NULL, '2023-12-24 23:05:11', '2023-12-24 23:05:11');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `drink`
--
ALTER TABLE `drink`
  ADD CONSTRAINT `drink_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
