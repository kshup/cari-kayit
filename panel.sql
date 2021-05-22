-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 16 May 2021, 17:40:28
-- Sunucu sürümü: 10.4.14-MariaDB
-- PHP Sürümü: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `panel`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `account_date` date NOT NULL DEFAULT current_timestamp(),
  `account_authorized_name_surname` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `account_company` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `account_email` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `account_phone` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `account_tax_office` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `account_tax_number` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `account_iban` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `account_adress` text COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `admins_id` int(11) NOT NULL,
  `admins_namesurname` varchar(50) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `admins_username` varchar(50) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `admins_pass` varchar(50) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `admins_status` enum('0','1') COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `admins_must` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`admins_id`, `admins_namesurname`, `admins_username`, `admins_pass`, `admins_status`, `admins_must`) VALUES
(1, 'Ali Murat Tava', 'admin', '507e1566b9e3693304075e39b6d8bff8', '1', 0),
(5, 'test', 'test', '81dc9bdb52d04dc20036dbd8313ed055', '1', 0),
(7, 'testt', 'test1', '827ccb0eea8a706c4c34a16891f84e7b', '0', 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admins_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `admins_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
