-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 20 Oca 2022, 22:31:58
-- Sunucu sürümü: 10.4.19-MariaDB
-- PHP Sürümü: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `courses`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `courses`
--

CREATE TABLE `courses` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `couponCode` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `courses`
--

INSERT INTO `courses` (`id`, `title`, `couponCode`, `price`) VALUES
(3, 'Nuxt.js Kursu', NULL, NULL),
(4, 'Codeigniter CMS Kursu', 'VSCMSDISCOUNT', 50.00),
(5, 'MySQL Kursu', 'SQLDISCOUNT', 20.00),
(8, 'RODE Kursu', 'RODENT', 123.00),
(9, 'Vue Native ilə Mobil Programlamlaşdırma Kursu', 'VUENATIVE', 25.00),
(12, 'GO Programlamlaşdırma Dili', 'GOGOGO', 50.00),
(14, 'Vuetify Kursu', 'VUETIFY', 25.00);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
