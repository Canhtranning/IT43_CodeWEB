-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 16, 2020 lúc 12:03 PM
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
-- Cấu trúc bảng cho bảng `nv4_vi_book_orders`
--

CREATE TABLE `nv4_vi_book_orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên khách hàng',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Địa chỉ email',
  `phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Số ĐT',
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Địa chỉ',
  `total_price` float NOT NULL COMMENT 'Tổng bill',
  `order_note` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Lưu ý đơn hàng',
  `payment_method` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Phương thức thanh toán',
  `weight` int(10) DEFAULT 1 COMMENT 'Vị trí sắp xếp\r\n',
  `active` tinyint(4) DEFAULT 1 COMMENT 'Hiển thị 0 chưa giao hàng, 1 đã giao hàng',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời gian tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời gian cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `nv4_vi_book_orders`
--
ALTER TABLE `nv4_vi_book_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `nv4_vi_book_orders`
--
ALTER TABLE `nv4_vi_book_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
