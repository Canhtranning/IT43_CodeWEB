-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 16, 2020 lúc 12:04 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nukeviet`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nv4_vi_book_product`
--

CREATE TABLE `nv4_vi_book_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tên sản phẩm',
  `image` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Ảnh ',
  `price` float NOT NULL COMMENT 'giá sản phẩm',
  `sale_price` float DEFAULT 0 COMMENT 'Giá sản phẩm khuyến mãi',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Nôi dung sản phẩm',
  `slug` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'alias_product',
  `category_id` int(11) NOT NULL COMMENT 'id danh mục',
  `weight` int(10) DEFAULT 1 COMMENT 'sắp xếp',
  `active` tinyint(4) DEFAULT 1 COMMENT 'Hiển thị 0 ẩn 1 hiển thị',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'thời gian tao ',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Cập nhật thời gian'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `nv4_vi_book_product`
--
ALTER TABLE `nv4_vi_book_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `name` (`name`);


--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `nv4_vi_book_product`
--
ALTER TABLE `nv4_vi_book_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
