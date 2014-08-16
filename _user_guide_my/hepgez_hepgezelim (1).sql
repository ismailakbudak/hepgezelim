-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 06 May 2014, 13:31:53
-- Sunucu sürümü: 5.5.31
-- PHP Sürümü: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `hepgez_hepgezelim`
--
CREATE DATABASE IF NOT EXISTS `hepgez_hepgezelim` DEFAULT CHARACTER SET utf8 COLLATE utf8_turkish_ci;
USE `hepgez_hepgezelim`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) DEFAULT '1',
  `username` varchar(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `surname` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_turkish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `admin_users`
--

INSERT INTO `admin_users` (`id`, `is_active`, `username`, `password`, `name`, `surname`, `email`, `created_at`, `updated_at`) VALUES
(1, 1, 'iso', 'cfd1db80feab1f6edda2d1280ebb3e3f', 'ismail', 'akbudak', NULL, '2014-04-09 20:23:42', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `alerts`
--

CREATE TABLE IF NOT EXISTS `alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `arac` tinyint(1) DEFAULT '0',
  `arac_again` tinyint(1) DEFAULT '1',
  `tercih` tinyint(1) DEFAULT '0',
  `bio` tinyint(1) DEFAULT '0',
  `photo` tinyint(1) DEFAULT '0',
  `phone` tinyint(1) DEFAULT '0',
  `email` tinyint(1) DEFAULT '0',
  `face` tinyint(1) DEFAULT '0',
  `extra_tr` varchar(300) COLLATE utf8_turkish_ci DEFAULT NULL,
  `extra_en` varchar(300) COLLATE utf8_turkish_ci DEFAULT NULL,
  `extra_read` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=25 ;

--
-- Tablo döküm verisi `alerts`
--

INSERT INTO `alerts` (`id`, `user_id`, `arac`, `arac_again`, `tercih`, `bio`, `photo`, `phone`, `email`, `face`, `extra_tr`, `extra_en`, `extra_read`, `created_at`) VALUES
(17, 1, 1, 1, 1, 1, 1, 0, 1, 1, NULL, NULL, 1, '2014-04-26 12:23:35'),
(18, 2, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, '2014-04-27 20:39:12'),
(19, 3, 1, 1, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, '2014-04-27 20:43:44'),
(20, 5, 1, 1, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, '2014-04-27 23:29:55'),
(21, 6, 0, 1, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, '2014-04-28 09:21:23'),
(22, 7, 1, 1, 1, 0, 0, 0, 0, 0, NULL, NULL, 1, '2014-04-28 14:32:32'),
(23, 8, 1, 1, 1, 1, 1, 0, 1, 1, NULL, NULL, 1, '2014-04-28 17:54:18'),
(24, 9, 1, 1, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, '2014-05-04 11:48:20');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `alert_user`
--

CREATE TABLE IF NOT EXISTS `alert_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_user_id` int(11) DEFAULT NULL,
  `received_user_id` int(11) DEFAULT NULL,
  `message_id` int(11) DEFAULT NULL,
  `explain` varchar(200) COLLATE utf8_turkish_ci DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sender_user_id` (`sender_user_id`),
  KEY `received_user_id` (`received_user_id`),
  KEY `message_id` (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `block_user`
--

CREATE TABLE IF NOT EXISTS `block_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `blocked_user_id` int(11) DEFAULT NULL,
  `explain` text COLLATE utf8_turkish_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `blocked_user_id` (`blocked_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cars`
--

CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `plate` varchar(30) DEFAULT 'Belirsiz',
  `foto_name` varchar(50) DEFAULT 'car.png',
  `foto_onay` tinyint(1) DEFAULT '1',
  `foto_exist` tinyint(1) DEFAULT '0',
  `make` varchar(50) DEFAULT 'Belirsiz',
  `model` varchar(50) DEFAULT 'Belirsiz',
  `comfort` int(11) DEFAULT '3',
  `number_of_seats` int(11) DEFAULT '4',
  `colour` varchar(30) DEFAULT NULL,
  `type` varchar(40) DEFAULT NULL,
  `explain` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_cars_on_user_id` (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Tablo döküm verisi `cars`
--

INSERT INTO `cars` (`id`, `user_id`, `plate`, `foto_name`, `foto_onay`, `foto_exist`, `make`, `model`, `comfort`, `number_of_seats`, `colour`, `type`, `explain`, `created_at`, `updated_at`) VALUES
(3, 3, 'Belirsiz', 'car.png', 1, 0, 'Belirsiz', 'Belirsiz', 3, 6, NULL, NULL, NULL, '2014-04-27 20:43:44', NULL),
(4, 5, 'Belirsiz', 'car.png', 1, 0, 'Belirsiz', 'Belirsiz', 3, 6, NULL, NULL, NULL, '2014-04-27 23:29:55', NULL),
(5, 6, 'Belirsiz', 'car.png', 1, 0, 'Belirsiz', 'Belirsiz', 3, 4, NULL, NULL, NULL, '2014-04-28 09:21:23', NULL),
(6, 7, 'Belirsiz', 'car.png', 1, 0, 'Belirsiz', 'Belirsiz', 3, 4, NULL, NULL, NULL, '2014-04-28 14:32:32', NULL),
(8, 9, 'Belirsiz', 'alert-32.png', 0, 0, 'ACURA', 'Test', 4, 4, 'Siyah', NULL, NULL, '2014-05-04 11:48:20', '2014-05-04 17:48:46'),
(9, 8, 'Belirsiz', 'car.png', 1, 0, 'ACURA', 'Das', 3, 5, '', '', '', '2014-05-05 10:45:40', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('b10a551e759b9e4d6b0c4aa6c419bc69', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/34.0.1847.116 Chrome/34.0.1847.11', 1399294395, 'a:15:{s:9:"user_data";s:0:"";s:9:"offerInfo";i:1;s:14:"offerAlertSave";i:0;s:10:"countOffer";i:1;s:6:"origin";s:16:"Edirne, Türkiye";s:3:"lat";s:7:"41.6818";s:3:"lng";s:7:"26.5623";s:12:"originStatus";s:1:"1";s:11:"destination";s:0:"";s:4:"dLat";i:-1;s:4:"dLng";i:-1;s:17:"destinationStatus";i:0;s:6:"place1";s:6:"Edirne";s:6:"place2";s:0:"";s:5:"range";s:3:"0-2";}');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `complain`
--

CREATE TABLE IF NOT EXISTS `complain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `complain_user_id` int(11) DEFAULT NULL,
  `complain` varchar(350) COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` varchar(70) COLLATE utf8_turkish_ci DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `complain_user_id` (`complain_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '-1',
  `user_type` varchar(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `issue` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `url` varchar(60) COLLATE utf8_turkish_ci DEFAULT 'diger',
  `subject` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `message` varchar(350) COLLATE utf8_turkish_ci DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `email` varchar(70) COLLATE utf8_turkish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `delete_acount`
--

CREATE TABLE IF NOT EXISTS `delete_acount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `description` varchar(300) COLLATE utf8_turkish_ci DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `email_alerts`
--

CREATE TABLE IF NOT EXISTS `email_alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `place1` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `place2` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `origin` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `destination` varchar(100) COLLATE utf8_turkish_ci DEFAULT '-1',
  `dLat` float DEFAULT '-1',
  `dLng` float DEFAULT '-1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `email_alerts`
--

INSERT INTO `email_alerts` (`id`, `user_id`, `place1`, `place2`, `date`, `origin`, `lat`, `lng`, `destination`, `dLat`, `dLng`, `created_at`) VALUES
(1, 8, 'Konya', '', '2014-05-07', 'Konya, Türkiye', 37.8667, 32.4833, '-1', -1, -1, '2014-05-05 11:48:55'),
(2, 8, 'Konya', 'Ankara', '2014-05-07', 'Konya, Türkiye', 37.8667, 32.4833, 'Ankara, Türkiye', 39.9208, 32.8541, '2014-05-05 11:49:13');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `email_alerts_result`
--

CREATE TABLE IF NOT EXISTS `email_alerts_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_alert_id` int(11) DEFAULT NULL,
  `ride_offer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email_alert_id` (`email_alert_id`),
  KEY `ride_offer_id` (`ride_offer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `email_alerts_result`
--

INSERT INTO `email_alerts_result` (`id`, `email_alert_id`, `ride_offer_id`) VALUES
(1, 2, 6),
(2, 1, 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `leave_times`
--

CREATE TABLE IF NOT EXISTS `leave_times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` varchar(50) DEFAULT NULL,
  `timeen` varchar(60) DEFAULT NULL,
  `explain` varchar(100) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Tablo döküm verisi `leave_times`
--

INSERT INTO `leave_times` (`id`, `time`, `timeen`, `explain`) VALUES
(1, 'Değişmeyecek', 'No', ''),
(2, '30 Dakika değişebilir', '30 Minute', ''),
(3, '1 Saat değişebilir', '1 Hour', ''),
(4, '1,30 Saat değişebilir', '1,30 hour', ''),
(5, '2 Saat değişebilir', '2 Hour', ''),
(6, '2,30 Saat değişebilir', '2,30', ''),
(7, '3 Saat değişebilir', '3 Hour', ''),
(8, '3 Saatten fazla değişebilir', 'Over +3 Hour', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `look_at`
--

CREATE TABLE IF NOT EXISTS `look_at` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ride_offer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `path` varchar(60) COLLATE utf8_turkish_ci DEFAULT NULL,
  `origin` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `destination` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ride_offer_id` (`ride_offer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=313 ;

--
-- Tablo döküm verisi `look_at`
--

INSERT INTO `look_at` (`id`, `ride_offer_id`, `user_id`, `path`, `origin`, `destination`, `created_at`) VALUES
(310, 3, 8, 'seyahat-adana-denizli-3-0-1-5', 'Adana, Türkiye', 'Denizli, Türkiye', '2014-05-04 14:36:40'),
(311, 3, 8, 'seyahat-adana-denizli-3-0-1-5', 'Adana, Türkiye', 'Denizli, Türkiye', '2014-05-04 14:38:11'),
(312, 3, 8, 'detay-adana-denizli-3', 'Adana, Türkiye', 'Denizli, Türkiye', '2014-05-04 14:39:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `luggages`
--

CREATE TABLE IF NOT EXISTS `luggages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(50) DEFAULT NULL,
  `sizeen` varchar(50) DEFAULT NULL,
  `explain` varchar(100) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Tablo döküm verisi `luggages`
--

INSERT INTO `luggages` (`id`, `size`, `sizeen`, `explain`) VALUES
(1, 'Küçük', 'Small', ''),
(2, 'Orta boy (sırt çantası)', 'Medium ( travel bag )', ''),
(3, 'Büyük (valiz)', 'Big ( suitcase )', ''),
(4, 'Çok Büyük', 'Very Big', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `received_user_id` int(11) DEFAULT NULL,
  `ride_offer_id` int(11) DEFAULT NULL,
  `send_visible` tinyint(4) DEFAULT '1',
  `sender_archived` tinyint(1) DEFAULT '0',
  `receive_visible` tinyint(4) DEFAULT '1',
  `receive_archived` tinyint(1) DEFAULT '0',
  `message` varchar(500) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `readed_receive` tinyint(1) DEFAULT '0',
  `readed_sender` tinyint(1) DEFAULT '0',
  `is_answer` tinyint(1) DEFAULT '0',
  `complain` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_messages_on_user_id_and_received_user_id` (`user_id`,`received_user_id`),
  KEY `sender_archived` (`sender_archived`),
  KEY `ride_offer_id` (`ride_offer_id`),
  KEY `user_id` (`user_id`),
  KEY `received_user_id` (`received_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- Tablo döküm verisi `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `received_user_id`, `ride_offer_id`, `send_visible`, `sender_archived`, `receive_visible`, `receive_archived`, `message`, `readed_receive`, `readed_sender`, `is_answer`, `complain`, `created_at`, `updated_at`) VALUES
(86, 8, 9, 3, 1, 0, 1, 0, 'Adasdsadsadasasdasdsad', 1, 1, 0, 0, '2014-05-04 14:36:50', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `new_message` tinyint(1) DEFAULT '1',
  `after_ride` tinyint(1) DEFAULT '1',
  `receive_rate` tinyint(1) DEFAULT '1',
  `updates` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_settings_on_user_id` (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Tablo döküm verisi `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `new_message`, `after_ride`, `receive_rate`, `updates`, `created_at`, `updated_at`) VALUES
(18, 2, 1, 1, 1, 1, '2014-04-27 20:39:12', NULL),
(19, 3, 1, 1, 1, 1, '2014-04-27 20:43:44', NULL),
(20, 5, 1, 1, 1, 1, '2014-04-27 23:29:55', NULL),
(21, 6, 1, 1, 1, 1, '2014-04-28 09:21:23', NULL),
(22, 7, 1, 1, 1, 1, '2014-04-28 14:32:32', NULL),
(23, 8, 1, 1, 1, 1, '2014-04-28 17:54:18', NULL),
(24, 1, 1, 1, 1, 1, '2014-04-27 20:39:12', NULL),
(25, 9, 1, 1, 1, 1, '2014-05-04 11:48:20', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `offer_created`
--

CREATE TABLE IF NOT EXISTS `offer_created` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ride_offer_id` int(11) DEFAULT NULL,
  `departure_place` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `arrivial_place` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `dLat` float DEFAULT NULL,
  `dLng` float DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_class` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `distance` double DEFAULT NULL,
  `time` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=11 ;

--
-- Tablo döküm verisi `offer_created`
--

INSERT INTO `offer_created` (`id`, `ride_offer_id`, `departure_place`, `lat`, `lng`, `arrivial_place`, `dLat`, `dLng`, `price`, `price_class`, `distance`, `time`) VALUES
(1, 1, 'Denizli, Türkiye', 37.7765, 29.0864, 'Adana, Türkiye', 37, 35.3213, 62, 'orange', 734.276, ' 11 saat 7 dk '),
(2, 2, 'Antalya, Türkiye', 36.8841, 30.7056, 'Korkuteli, Türkiye', 37.0766, 30.21, 6, 'orange', 63.245, '  1 saat 14 dakika'),
(3, 2, 'Korkuteli, Türkiye', 37.0766, 30.21, 'Denizli, Türkiye', 37.7765, 29.0864, 4, 'green', 163.844, '  2 saat 42 dakika'),
(4, 2, 'Antalya, Türkiye', 36.8841, 30.7056, 'Denizli, Türkiye', 37.7765, 29.0864, 10, 'green', 227.089, ' 3 saat 57 dk '),
(5, 3, 'Adana, Türkiye', 37, 35.3213, 'Denizli, Türkiye', 37.7765, 29.0864, 67, 'orange', 746.33, ' 10 saat 59 dk '),
(6, 4, 'Adana, Türkiye', 37, 35.3213, 'Edirne, Türkiye', 41.6818, 26.5623, 112, 'orange', 1173.51, ' 13 saat 34 dk '),
(7, 5, 'Edirne, Türkiye', 41.6818, 26.5623, 'Ankara, Türkiye', 39.9208, 32.8541, 69, 'orange', 687.699, '   6 saat 46 dakika'),
(8, 5, 'Ankara, Türkiye', 39.9208, 32.8541, 'Denizli, Türkiye', 37.7765, 29.0864, 47, 'orange', 466.452, '   7 saat 2 dakika'),
(9, 5, 'Edirne, Türkiye', 41.6818, 26.5623, 'Denizli, Türkiye', 37.7765, 29.0864, 116, 'red', 1154.151, ' 13 saat 48 dk '),
(10, 6, 'Konya, Türkiye', 37.8667, 32.4833, 'Ankara, Türkiye', 39.9208, 32.8541, 26, 'orange', 260.9, ' 4 saat 4 dk ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `preferences`
--

CREATE TABLE IF NOT EXISTS `preferences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `like_chat` tinyint(1) DEFAULT '1',
  `like_pet` tinyint(1) DEFAULT '1',
  `like_smoke` tinyint(1) DEFAULT '1',
  `like_music` tinyint(1) DEFAULT '1',
  `explain` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_car_preferences_on_car_id` (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Tablo döküm verisi `preferences`
--

INSERT INTO `preferences` (`id`, `user_id`, `like_chat`, `like_pet`, `like_smoke`, `like_music`, `explain`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 2, 2, 'Lol', '2014-04-26 12:23:35', NULL),
(2, 2, 2, 2, 0, 1, '', '2014-04-27 20:39:12', NULL),
(3, 3, 1, 1, 1, 1, NULL, '2014-04-27 20:43:44', NULL),
(4, 5, 2, 0, 2, 2, '', '2014-04-27 23:29:55', NULL),
(5, 6, 1, 1, 1, 1, NULL, '2014-04-28 09:21:23', NULL),
(6, 7, 2, 0, 0, 2, '', '2014-04-28 14:32:32', NULL),
(7, 8, 2, 2, 0, 2, '', '2014-04-28 17:54:18', NULL),
(8, 9, 1, 1, 1, 1, NULL, '2014-05-04 11:48:20', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `problems`
--

CREATE TABLE IF NOT EXISTS `problems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `problem` varchar(500) COLLATE utf8_turkish_ci DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `email` varchar(70) COLLATE utf8_turkish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=14 ;

--
-- Tablo döküm verisi `problems`
--

INSERT INTO `problems` (`id`, `problem`, `is_read`, `email`, `created_at`) VALUES
(1, 'Test Test Test Test Test Test', 1, '', '2014-04-26 20:25:19'),
(2, 'Default olarak 6-kişilik arabam olması çok garip. Default araba olmasını anlarım ama neden 6 kişilik olduğunu anlayamadım. Çoğu araba şöför hariç 3-4 kişiliktir üstelik.', 1, '', '2014-04-28 04:41:48'),
(3, 'Facebook ile login olan kullanıcılar için email adresi doğrulaması devredışı bırakılmalı.', 1, '', '2014-04-28 05:00:51'),
(4, 'Kullanıcı panelindeki "Uyarılarım" sekmesinin isminin "Bildirimler" olarak değiştirilmesi daha münasip olur.', 1, '', '2014-04-28 05:01:47'),
(5, '"Şuan ki leveliniz" cümlesinde yazım yanlışı. -ki eki birleşik yazılmalı. Ayrıca Türkçe''ye daha uygun olmak amaçlı, "Sitedeki durumunuz" ya da "Sitedeki seviyeniz" ya da sadece "Seviyeniz" olarak değiştirilebilir.', 1, '', '2014-04-28 05:04:47'),
(6, '"Özel mesajlarınız" mesajlarınız sekmesi "Mesajlarınız" şeklinde değiştirilmeli. Sitede özel olmayan mesaj diye bir kavram yok.', 1, '', '2014-04-28 05:05:44'),
(7, '"Sorun-Görüş" sekmesinin ismi "Geribildirim" olarak değiştirilebilir. Butonun amacını daha iyi yansıtacaktır.', 1, '', '2014-04-28 05:06:55'),
(8, 'Profilde "Hiç özel mesajınız yok", "Hiçbir şeye göz atmamışsınız." tarzındaki bildirimlerin rengi kırmızıdan farklı olmalı. Kullanıcının bilinçaltında kötü bir izlenim bırakıyor.', 1, '', '2014-04-28 05:09:32'),
(9, 'Yararlı linkler kısmındaki "Genel profilini görüntüle" cümlesi "Profilini görüntüle" olarak değiştirilebilir. "Genel profil" tamlamasının kullanılmasını gerektirecek bir durum yok.', 1, '', '2014-04-28 05:10:53'),
(10, 'Bildiğim kadarıyla Facebook kullanıcıların telefon numaralarını onaylama işini hallediyor, senin tekrar onay istemeni gerektiren bir durum yok. Facebook ile giriş yapan kullanıcılardan email-tel no onaylaması istenmemeli.', 1, '', '2014-04-28 05:12:25'),
(11, 'Email doğrulama maillerinde otomatik doğrulama için dorğulama linki de gönderilmeli, sadece kod göndermek birçok kullanıcıyı şaşırtacaktır.', 0, '', '2014-04-28 05:14:12'),
(12, 'Profildeki "Email doğrulanmadı" "Telefon numarası doğrulanmadı" cümleleri, kontrol panelindeki doğrulama bölümüne link vermeli. Kullanıcı kontrol panelinde doğrulama kısmını aramak zorunda kalmamalı.', 1, '', '2014-04-28 05:15:17'),
(13, 'Anasayfadaki site tanımı şu şekilde yeniden yazılabilir:\n"Hepgezelim.com boş koltuklarınızı ve masraflarınızı paylaştıran ücretsiz bir servistir."', 1, '', '2014-04-28 05:21:57');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `given_userid` int(11) DEFAULT NULL,
  `received_userid` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT '0',
  `comment` varchar(300) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `is_driver` tinyint(1) DEFAULT '0',
  `skill` varchar(20) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT 'no-skill',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_ratings_on_user_id_and_received_user_id` (`given_userid`,`received_userid`),
  KEY `given_userid` (`given_userid`),
  KEY `received_userid` (`received_userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ride_offers`
--

CREATE TABLE IF NOT EXISTS `ride_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `car_id` int(11) DEFAULT '0',
  `luggage_id` int(11) DEFAULT NULL,
  `leave_time_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `trip_type` tinyint(1) DEFAULT '0',
  `is_way` tinyint(1) DEFAULT '0',
  `origin` varchar(150) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `destination` varchar(150) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `return_time` time DEFAULT NULL,
  `round_trip` tinyint(1) DEFAULT NULL,
  `price_per_passenger` int(11) DEFAULT '0',
  `real_distance` varchar(70) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `real_time` varchar(70) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `total_distance` varchar(70) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `total_time` varchar(70) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `price_class` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `number_of_seats` int(11) DEFAULT '0',
  `explain_departure` varchar(300) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `explain_return` varchar(300) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `explain_approval` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_ride_offers_on_user_id_and_luggage_id_and_leave_time_id` (`user_id`,`luggage_id`,`leave_time_id`),
  KEY `car_id` (`car_id`),
  KEY `luggage_id` (`luggage_id`),
  KEY `leave_time_id` (`leave_time_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Tablo döküm verisi `ride_offers`
--

INSERT INTO `ride_offers` (`id`, `user_id`, `car_id`, `luggage_id`, `leave_time_id`, `is_active`, `trip_type`, `is_way`, `origin`, `destination`, `departure_date`, `departure_time`, `return_date`, `return_time`, `round_trip`, `price_per_passenger`, `real_distance`, `real_time`, `total_distance`, `total_time`, `price_class`, `number_of_seats`, `explain_departure`, `explain_return`, `explain_approval`, `created_at`, `updated_at`) VALUES
(3, 9, 8, 1, 1, 0, 0, 0, 'Adana, Türkiye', 'Denizli, Türkiye', '2014-05-08', '12:30:00', '2014-05-15', '12:30:00', 1, 67, '746.33', '  10 saat 59 dakika', ' 746.33 km ', ' 10 saat 59 dk ', 'orange', 3, '', '', 0, '2014-05-04 14:12:26', '2014-05-04 17:49:21'),
(4, 9, 8, 1, 1, 1, 0, 0, 'Adana, Türkiye', 'Edirne, Türkiye', '2014-05-07', '07:30:00', '2014-05-31', '18:00:00', 1, 112, '1173.51', '   13 saat 33 dakika', ' 1173.51 km ', ' 13 saat 34 dk ', 'orange', 4, '', '', 0, '2014-05-05 10:25:34', '2014-05-05 12:27:51'),
(5, 8, 9, 1, 1, 1, 1, 1, 'Edirne, Türkiye', 'Denizli, Türkiye', '2014-05-06', '16:30:00', '2014-05-17', '12:30:00', 0, 116, '885.474', '   11 saat 18 dakika', ' 1154.151 km ', ' 13 saat 48 dk ', 'red', 3, '', '', 0, '2014-05-05 10:45:50', NULL),
(6, 9, 8, 1, 1, 1, 1, 0, 'Konya, Türkiye', 'Ankara, Türkiye', '2014-05-11', '10:00:00', '2014-06-19', '23:50:00', 1, 26, '260.9', '   4 saat 3 dakika', ' 260.9 km ', ' 4 saat 4 dk ', 'orange', 3, '', '', 0, '2014-05-05 11:50:09', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ride_offer_update`
--

CREATE TABLE IF NOT EXISTS `ride_offer_update` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(45) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ride_offer_id` int(11) DEFAULT NULL,
  `is_update` tinyint(1) DEFAULT '1',
  `round_trip` varchar(7) DEFAULT NULL,
  `origin` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `destination` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `way_points` text CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `departure_date` varchar(10) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `departure_time` varchar(10) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `return_date` varchar(10) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `return_time` varchar(10) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `departure_days` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `return_days` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `trip_type` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rutin_trip`
--

CREATE TABLE IF NOT EXISTS `rutin_trip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ride_offer_id` int(11) DEFAULT NULL,
  `is_return` tinyint(1) DEFAULT '0',
  `day` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ride_offer_id` (`ride_offer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=11 ;

--
-- Tablo döküm verisi `rutin_trip`
--

INSERT INTO `rutin_trip` (`id`, `ride_offer_id`, `is_return`, `day`) VALUES
(1, 5, 0, 'Salı'),
(2, 5, 0, 'Çarşamba'),
(3, 5, 0, 'Perşembe'),
(4, 6, 0, 'Pazartesi'),
(5, 6, 0, 'Salı'),
(6, 6, 0, 'Çarşamba'),
(7, 6, 0, 'Perşembe'),
(8, 6, 0, 'Cuma'),
(9, 6, 1, 'Cumartesi'),
(10, 6, 1, 'Pazar');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rutin_trip_dates`
--

CREATE TABLE IF NOT EXISTS `rutin_trip_dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ride_offer_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `is_return` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ride_offer_id` (`ride_offer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=47 ;

--
-- Tablo döküm verisi `rutin_trip_dates`
--

INSERT INTO `rutin_trip_dates` (`id`, `ride_offer_id`, `date`, `is_return`) VALUES
(1, 5, '2014-05-06', 0),
(2, 5, '2014-05-07', 0),
(3, 5, '2014-05-08', 0),
(4, 5, '2014-05-13', 0),
(5, 5, '2014-05-14', 0),
(6, 5, '2014-05-15', 0),
(7, 6, '2014-05-12', 0),
(8, 6, '2014-05-13', 0),
(9, 6, '2014-05-14', 0),
(10, 6, '2014-05-15', 0),
(11, 6, '2014-05-16', 0),
(12, 6, '2014-05-19', 0),
(13, 6, '2014-05-20', 0),
(14, 6, '2014-05-21', 0),
(15, 6, '2014-05-22', 0),
(16, 6, '2014-05-23', 0),
(17, 6, '2014-05-26', 0),
(18, 6, '2014-05-27', 0),
(19, 6, '2014-05-28', 0),
(20, 6, '2014-05-29', 0),
(21, 6, '2014-05-30', 0),
(22, 6, '2014-06-02', 0),
(23, 6, '2014-06-03', 0),
(24, 6, '2014-06-04', 0),
(25, 6, '2014-06-05', 0),
(26, 6, '2014-06-06', 0),
(27, 6, '2014-06-09', 0),
(28, 6, '2014-06-10', 0),
(29, 6, '2014-06-11', 0),
(30, 6, '2014-06-12', 0),
(31, 6, '2014-06-13', 0),
(32, 6, '2014-06-16', 0),
(33, 6, '2014-06-17', 0),
(34, 6, '2014-06-18', 0),
(35, 6, '2014-06-19', 0),
(36, 6, '2014-05-11', 1),
(37, 6, '2014-05-17', 1),
(38, 6, '2014-05-18', 1),
(39, 6, '2014-05-24', 1),
(40, 6, '2014-05-25', 1),
(41, 6, '2014-05-31', 1),
(42, 6, '2014-06-01', 1),
(43, 6, '2014-06-07', 1),
(44, 6, '2014-06-08', 1),
(45, 6, '2014-06-14', 1),
(46, 6, '2014-06-15', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `searched`
--

CREATE TABLE IF NOT EXISTS `searched` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `origin` varchar(100) COLLATE utf8_turkish_ci DEFAULT 'Türkiye',
  `lat` float DEFAULT '30',
  `lng` float DEFAULT '24',
  `originStatus` tinyint(1) DEFAULT '1',
  `destination` varchar(100) COLLATE utf8_turkish_ci DEFAULT '',
  `dLat` float DEFAULT '-1',
  `dLng` float DEFAULT '-1',
  `destinationStatus` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=275 ;

--
-- Tablo döküm verisi `searched`
--

INSERT INTO `searched` (`id`, `user_id`, `origin`, `lat`, `lng`, `originStatus`, `destination`, `dLat`, `dLng`, `destinationStatus`, `is_active`) VALUES
(32, 3, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Diyarbakır, Türkiye', 37.9144, 40.2306, 1, 1),
(55, 1, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, -1, 1),
(57, 1, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, -1, 1),
(59, 1, 'Adana, Türkiye', 37, 35.3213, 1, '', -1, -1, 0, 1),
(63, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Ankara, Türkiye', 39.9208, 32.8541, 1, 1),
(64, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Adana, Türkiye', 37, 35.3213, 1, 1),
(65, 0, 'Gliwice, Polska', 50.2945, 18.6714, 1, 'Prague, Czech Republic', 50.0755, 14.4378, 1, 1),
(66, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Adana, Türkiye', 37, 35.3213, 1, 1),
(67, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, -1, 1),
(68, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Antalya, Türkiye', 36.8841, 30.7056, 1, 1),
(69, 0, 'Karabağlar, İzmir, Türkiye', 38.3774, 27.1322, 1, 'Buca, İzmir, Türkiye', 38.3881, 27.1753, 1, 1),
(70, 0, 'İzmir, Türkiye', 38.4188, 27.1287, 1, 'İstanbul, Türkiye', 41.0053, 28.977, 1, 1),
(71, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(72, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Adana, Türkiye', 37, 35.3213, 1, 1),
(73, 0, 'İstanbul, Türkiye', 41.0053, 28.977, 1, 'Adıyaman, Türkiye', 37.7648, 38.2786, 1, 1),
(74, 0, 'Antalya, Türkiye', 36.8841, 30.7056, 1, '', -1, -1, 0, 1),
(75, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(76, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(77, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, -1, 1),
(78, 1, 'Antalya, Türkiye', 36.8841, 30.7056, 1, '', -1, -1, 0, 1),
(80, 1, 'Adana, Türkiye', 37, 35.3213, 1, '', -1, -1, 0, 1),
(83, 1, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(93, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'France', 46.2276, 2.21375, 1, 1),
(94, 0, 'Bahçeköy Merkez Mh., İstanbul, Türkiye', 41.1766, 28.9931, 1, 'Beykoz, Kavacık Kavşağı, İstanbul, Türkiye', 41.0884, 29.0908, 1, 1),
(95, 0, 'Bahçeköy Merkez Mh., İstanbul, Türkiye', 41.1766, 28.9931, 1, 'Levent, İstanbul, Türkiye', 41.0778, 29.0132, 1, 1),
(96, 0, 'Bahçeköy Merkez Mh., İstanbul, Türkiye', 41.1766, 28.9931, 1, '', -1, -1, 0, 1),
(97, 0, 'Çamlık Caddesi, Denizli, Türkiye', 37.7317, 29.1624, 1, 'Antalya, Türkiye', 36.8841, 30.7056, 1, 1),
(98, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Antalya, Türkiye', 36.8841, 30.7056, 1, 1),
(99, 0, 'Antalya, Türkiye', 36.8841, 30.7056, 1, 'Bolu, Türkiye', 40.7395, 31.6116, 1, 1),
(100, 0, 'Bolu, Türkiye', 40.7395, 31.6116, 1, 'Antalya, Türkiye', 36.8841, 30.7056, 1, 1),
(101, 0, 'Denizli, Turkey', 37.7765, 29.0864, 1, 'Kayseri, Turkey', 38.7312, 35.4787, 1, 1),
(102, 0, 'Denizli, Turkey', 37.7765, 29.0864, 1, 'Istanbul, Turkey', 41.0053, 28.977, 1, 1),
(103, 0, 'Istanbul, Turkey', 41.0053, 28.977, 1, 'Ankara, Turkey', 39.9208, 32.8541, 1, 1),
(104, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(105, 0, 'Adana, Türkiye', 37, 35.3213, 1, '', -1, -1, 0, 1),
(106, 0, 'Karabağlar, İzmir, Türkiye', 38.3774, 27.1322, 1, '', -1, -1, 0, 1),
(107, 0, 'Warsaw, Poland', 52.2297, 21.0122, 1, 'Berlin, Deutschland', 52.52, 13.405, 1, 1),
(108, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Adana, Türkiye', 37, 35.3213, 1, 1),
(109, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Ankara, Türkiye', 39.9208, 32.8541, 1, 1),
(110, 0, 'Ankara, Turkey', 39.9208, 32.8541, 1, 'Ankara, Turkey', 39.9208, 32.8541, 1, 1),
(111, 0, 'Eskişehir, Türkiye', 39.7767, 30.5206, 1, 'İstanbul, Türkiye', 41.0053, 28.977, 1, 1),
(112, 0, 'İstanbul, Türkiye', 41.0053, 28.977, 1, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 1),
(113, 0, 'Denizli Devlet Hastanesi, Denizli, Türkiye', 37.7835, 29.0787, 1, 'Denizli Çardak Havaalanı, Çardak, Türkiye', 37.8155, 29.6574, 1, 1),
(114, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Ankara, Türkiye', 39.9208, 32.8541, 1, 1),
(115, 0, 'Kayseri, Türkiye', 38.7312, 35.4787, 1, 'Ankara, Türkiye', 39.9208, 32.8541, 1, 1),
(116, 0, 'Bornova, İzmir, Türkiye', 38.4664, 27.2192, 1, 'Konak, İzmir, Türkiye', 38.4287, 27.1349, 1, 1),
(117, 0, 'Adana, Türkiye', 37, 35.3213, 1, '', -1, -1, 0, 1),
(118, 0, 'Eskişehir, Türkiye', 39.7767, 30.5206, 1, 'İstanbul, Türkiye', 41.0053, 28.977, 1, 1),
(119, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(120, 0, 'Denizli, Turkey', 37.7765, 29.0864, 1, 'Izmir, Turkey', 38.4188, 27.1287, 1, 1),
(121, 0, 'Afyonkarahisar, Türkiye', 38.7507, 30.5567, 1, '', -1, -1, 0, 1),
(122, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Eskişehir, Türkiye', 39.7767, 30.5206, 1, 1),
(125, 0, 'Kepez, Ahatlı Mh., Antalya, Türkiye', 36.931, 30.6477, 1, 'Kepez, Yeşilyurt Mh., Antalya, Türkiye', 36.9076, 30.6434, 1, 1),
(126, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'İzmir, Türkiye', 38.4188, 27.1287, 1, 1),
(127, 0, 'Edremit, Türkiye', 38.42, 43.25, 1, '', -1, -1, 0, 1),
(128, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Uşak, Türkiye', 38.6823, 29.4082, 1, 1),
(129, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Şanlıurfa, Türkiye', 37.1591, 38.7969, 1, 1),
(130, 1, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(131, 7, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(132, 0, 'Kağıthane, Istanbul, Turkey', 41.0814, 28.982, 1, 'Taksim Meydani, Istanbul, Turkey', 41.0366, 28.9869, 1, 1),
(133, 0, 'Istanbul, Turkey', 41.0053, 28.977, 1, 'Ankara, Turkey', 39.9208, 32.8541, 1, 1),
(134, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(135, 0, 'Bursa, Türkiye', 40.1828, 29.0671, 1, '', -1, -1, 0, 1),
(136, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(137, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Antalya, Türkiye', 36.8841, 30.7056, 1, 1),
(138, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(139, 0, 'Hungary', 47.1625, 19.5033, 1, 'Kroatien', 45.1, 15.2, 1, 1),
(140, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(141, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(142, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Ankara, Turkey', 39.9208, 32.8541, 1, 1),
(143, 5, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(144, 0, 'Antalya, Türkiye', 36.8841, 30.7056, 1, '', -1, -1, 0, 1),
(145, 8, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(146, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'İstanbul, Türkiye', 41.0053, 28.977, 1, 1),
(147, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Konak, İzmir, Türkiye', 38.4287, 27.1349, 1, 1),
(148, 0, 'Tokat, Türkiye', 40.3167, 36.55, 1, 'Ankara, Türkiye', 39.9208, 32.8541, 1, 1),
(149, 0, 'İstanbul, Türkiye', 41.0053, 28.977, 1, 'Ankara, Türkiye', 39.9208, 32.8541, 1, 1),
(150, 0, 'Kumluca, Türkiye', 36.3628, 30.2864, 1, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 1),
(151, 0, 'Kumluca, Türkiye', 36.3628, 30.2864, 1, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 1),
(152, 0, 'Kumluca, Türkiye', 36.3628, 30.2864, 1, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 1),
(153, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Manisa, Türkiye', 38.6191, 27.4289, 1, 1),
(154, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'İzmir, Türkiye', 38.4188, 27.1287, 1, 1),
(155, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Manisa, Türkiye', 38.6191, 27.4289, 1, 1),
(156, 0, 'Adana, Türkiye', 37, 35.3213, 1, '', -1, -1, 0, 1),
(157, 0, 'Warsaw, Poland', 52.2297, 21.0122, 1, '', -1, -1, 0, 1),
(158, 0, 'Korkuteli, Türkiye', 37.0766, 30.21, 1, '', -1, -1, 0, 1),
(159, 0, 'Istanbul, Turkey', 41.0053, 28.977, 1, '', -1, -1, 0, 1),
(160, 0, 'Kağıthane, Istanbul, Turkey', 41.0814, 28.982, 1, '', -1, -1, 0, 1),
(161, 0, 'Ankara, Turkey', 39.9208, 32.8541, 1, '', -1, -1, 0, 1),
(162, 0, 'Hungary', 47.1625, 19.5033, 1, '', -1, -1, 0, 1),
(163, 0, 'Karabağlar, İzmir, Türkiye', 38.3774, 27.1322, 1, '', -1, -1, 0, 1),
(164, 0, 'Kayseri, Türkiye', 38.7312, 35.4787, 1, '', -1, -1, 0, 1),
(165, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(166, 0, 'Bahçeköy Merkez Mh., İstanbul, Türkiye', 41.1766, 28.9931, 1, '', -1, -1, 0, 1),
(167, 0, 'Bahçeköy Merkez Mh., İstanbul, Türkiye', 41.1766, 28.9931, 1, '', -1, -1, 0, 1),
(168, 0, 'Edremit, Türkiye', 38.42, 43.25, 1, '', -1, -1, 0, 1),
(169, 0, 'Denizli, Turkey', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(170, 0, 'Antalya, Türkiye', 36.8841, 30.7056, 1, '', -1, -1, 0, 1),
(171, 0, 'Gliwice, Polska', 50.2945, 18.6714, 1, '', -1, -1, 0, 1),
(172, 0, 'İstanbul, Türkiye', 41.0053, 28.977, 1, '', -1, -1, 0, 1),
(173, 0, 'Korkuteli, Türkiye', 37.0766, 30.21, 1, '', -1, -1, 0, 1),
(174, 0, 'Korkuteli, Türkiye', 37.0766, 30.21, 1, '', -1, -1, 0, 1),
(175, 0, 'Warsaw, Poland', 52.2297, 21.0122, 1, '', -1, -1, 0, 1),
(176, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'İzmir, Türkiye', 38.4188, 27.1287, 1, 1),
(177, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Antalya, Türkiye', 36.8841, 30.7056, 1, 1),
(178, 0, 'İstanbul, Türkiye', 41.0053, 28.977, 1, 'Ankara, Türkiye', 39.9208, 32.8541, 1, 1),
(179, 0, 'Bahçeköy Merkez Mh., İstanbul, Türkiye', 41.1766, 28.9931, 1, '', -1, -1, 0, 1),
(180, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 1),
(181, 0, 'Antalya, Türkiye', 36.8841, 30.7056, 1, '', -1, -1, 0, 1),
(182, 0, 'Antalya, Türkiye', 36.8841, 30.7056, 1, '', -1, -1, 0, 1),
(183, 0, 'Gliwice, Polska', 50.2945, 18.6714, 1, '', -1, -1, 0, 1),
(184, 0, 'Antalya, Türkiye', 36.8841, 30.7056, 1, '', -1, -1, 0, 1),
(185, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(186, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(187, 0, 'Antalya, Türkiye', 36.8841, 30.7056, 1, '', -1, -1, 0, 1),
(188, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'İzmir, Türkiye', 38.4188, 27.1287, 1, 1),
(189, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'İzmir, Türkiye', 38.4188, 27.1287, 1, 1),
(190, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Ankara, Türkiye', 39.9208, 32.8541, 1, 1),
(191, 0, 'Bahçeköy Merkez Mh., İstanbul, Türkiye', 41.1766, 28.9931, 1, '', -1, -1, 0, 1),
(192, 0, 'Bolu, Türkiye', 40.7395, 31.6116, 1, '', -1, -1, 0, 1),
(193, 0, 'Warsaw, Poland', 52.2297, 21.0122, 1, '', -1, -1, 0, 1),
(194, 0, 'Kumluca, Türkiye', 36.3628, 30.2864, 1, '', -1, -1, 0, 1),
(195, 0, 'Gliwice, Polska', 50.2945, 18.6714, 1, '', -1, -1, 0, 1),
(196, 0, 'Çamlık Caddesi, Denizli, Türkiye', 37.7317, 29.1624, 1, '', -1, -1, 0, 1),
(197, 0, 'Kepez, Ahatlı Mh., Antalya, Türkiye', 36.931, 30.6477, 1, '', -1, -1, 0, 1),
(198, 0, 'Kayseri, Türkiye', 38.7312, 35.4787, 1, '', -1, -1, 0, 1),
(199, 0, 'Denizli Devlet Hastanesi, Denizli, Türkiye', 37.7835, 29.0787, 1, '', -1, -1, 0, 1),
(200, 0, 'Çankaya, Öveçler Mh., Ankara, Türkiye', 39.8896, 32.83, 1, 'Hacettepe Üniversitesi Beytepe Kampüsü, Ankara, Türkiye', 39.8967, 32.7335, 1, 1),
(201, 0, 'Bursa, Türkiye', 40.1828, 29.0671, 1, '', -1, -1, 0, 1),
(202, 0, 'Radom, Polska', 51.4027, 21.1471, 1, 'Venedik, İtalya', 45.4408, 12.3155, 1, 1),
(203, 0, 'Antalya, Türkiye', 36.8841, 30.7056, 1, '', -1, -1, 0, 1),
(204, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(205, 0, 'Korkuteli, Türkiye', 37.0766, 30.21, 1, '', -1, -1, 0, 1),
(206, 0, 'İstanbul, Türkiye', 41.0053, 28.977, 1, '', -1, -1, 0, 1),
(207, 0, 'Adana, Türkiye', 37, 35.3213, 1, '', -1, -1, 0, 1),
(208, 0, 'Ankara, Turkey', 39.9208, 32.8541, 1, '', -1, -1, 0, 1),
(209, 0, 'Bahçeköy Merkez Mh., İstanbul, Türkiye', 41.1766, 28.9931, 1, '', -1, -1, 0, 1),
(210, 0, 'Denizli, Turkey', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(211, 0, 'Edremit, Türkiye', 38.42, 43.25, 1, '', -1, -1, 0, 1),
(212, 0, 'Eskişehir, Türkiye', 39.7767, 30.5206, 1, '', -1, -1, 0, 1),
(213, 0, 'Gliwice, Polska', 50.2945, 18.6714, 1, '', -1, -1, 0, 1),
(214, 0, 'Hungary', 47.1625, 19.5033, 1, '', -1, -1, 0, 1),
(215, 0, 'Istanbul, Turkey', 41.0053, 28.977, 1, '', -1, -1, 0, 1),
(216, 0, 'Kağıthane, Istanbul, Turkey', 41.0814, 28.982, 1, '', -1, -1, 0, 1),
(217, 0, 'Karabağlar, İzmir, Türkiye', 38.3774, 27.1322, 1, '', -1, -1, 0, 1),
(218, 0, 'Kayseri, Türkiye', 38.7312, 35.4787, 1, '', -1, -1, 0, 1),
(219, 0, 'Kumluca, Türkiye', 36.3628, 30.2864, 1, '', -1, -1, 0, 1),
(220, 0, 'Warsaw, Poland', 52.2297, 21.0122, 1, '', -1, -1, 0, 1),
(221, 0, 'Denizli, Turkey', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(222, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, 'Antalya, Türkiye', 36.8841, 30.7056, 1, 1),
(223, 0, 'Adana, Türkiye', 37, 35.3213, 1, '', -1, -1, 0, 1),
(224, 0, 'İzmir, Türkiye', 38.4188, 27.1287, 1, '', -1, -1, 0, 1),
(225, 0, 'Antalya, Türkiye', 36.8841, 30.7056, 1, '', -1, -1, 0, 1),
(226, 0, 'İstanbul, Türkiye', 41.0053, 28.977, 1, '', -1, -1, 0, 1),
(227, 0, 'Kağıthane, Istanbul, Turkey', 41.0814, 28.982, 1, '', -1, -1, 0, 1),
(228, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(229, 0, 'Bursa, Türkiye', 40.1828, 29.0671, 1, '', -1, -1, 0, 1),
(230, 0, 'Denizli Devlet Hastanesi, Denizli, Türkiye', 37.7835, 29.0787, 1, '', -1, -1, 0, 1),
(231, 0, 'Bolu, Türkiye', 40.7395, 31.6116, 1, '', -1, -1, 0, 1),
(232, 0, 'Gliwice, Polska', 50.2945, 18.6714, 1, '', -1, -1, 0, 1),
(233, 0, 'İstanbul, Türkiye', 41.0053, 28.977, 1, '', -1, -1, 0, 1),
(234, 0, 'İstanbul, Türkiye', 41.0053, 28.977, 1, '', -1, -1, 0, 1),
(235, 0, 'Kağıthane, Istanbul, Turkey', 41.0814, 28.982, 1, '', -1, -1, 0, 1),
(236, 0, 'Istanbul, Turkey', 41.0053, 28.977, 1, '', -1, -1, 0, 1),
(237, 0, 'Kayseri, Türkiye', 38.7312, 35.4787, 1, '', -1, -1, 0, 1),
(238, 0, 'Bahçeköy Merkez Mh., İstanbul, Türkiye', 41.1766, 28.9931, 1, '', -1, -1, 0, 1),
(239, 0, 'Kumluca, Türkiye', 36.3628, 30.2864, 1, '', -1, -1, 0, 1),
(240, 0, 'Denizli, Turkey', 37.7765, 29.0864, 1, '', -1, -1, 0, 1),
(241, 0, 'Karabağlar, İzmir, Türkiye', 38.3774, 27.1322, 1, '', -1, -1, 0, 1),
(242, 0, 'Ankara, Turkey', 39.9208, 32.8541, 1, '', -1, -1, 0, 1),
(243, 0, 'Hungary', 47.1625, 19.5033, 1, '', -1, -1, 0, 1),
(244, 0, 'Korkuteli, Türkiye', 37.0766, 30.21, 1, '', -1, -1, 0, 1),
(245, 0, 'Warsaw, Poland', 52.2297, 21.0122, 1, '', -1, -1, 0, 1),
(246, 0, 'Ankara, Turkey', 39.9208, 32.8541, 1, '', -1, -1, 0, 1),
(247, 0, 'Karabağlar, İzmir, Türkiye', 38.3774, 27.1322, 1, '', -1, -1, 0, 1),
(248, 0, 'İzmir, Türkiye', 38.4188, 27.1287, 1, '', -1, -1, 0, 1),
(249, 0, 'Istanbul, Turkey', 41.0053, 28.977, 1, '', -1, -1, 0, 1),
(250, 0, 'Antalya, Türkiye', 36.8841, 30.7056, 1, '', -1, -1, 0, 1),
(251, 0, 'Kağıthane, Istanbul, Turkey', 41.0814, 28.982, 1, '', -1, -1, 0, 1),
(252, 0, 'Ankara, Turkey', 39.9208, 32.8541, 1, '', -1, -1, 0, 0),
(253, 0, 'Hungary', 47.1625, 19.5033, 1, '', -1, -1, 0, 0),
(254, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 0),
(255, 0, 'Istanbul, Turkey', 41.0053, 28.977, 1, '', -1, -1, 0, 0),
(256, 0, 'Kayseri, Türkiye', 38.7312, 35.4787, 1, '', -1, -1, 0, 0),
(257, 0, 'Istanbul, Turkey', 41.0053, 28.977, 1, '', -1, -1, 0, 0),
(258, 9, 'Adana, Türkiye', 37, 35.3213, 1, '', -1, -1, 0, 0),
(259, 8, 'Antalya, Türkiye', 36.8841, 30.7056, 1, '', -1, -1, 0, 0),
(260, 8, 'Adana, Türkiye', 37, 35.3213, 1, '', -1, -1, 0, 0),
(261, 0, 'Bahçeköy Merkez Mh., İstanbul, Türkiye', 41.1766, 28.9931, 1, '', -1, -1, 0, 0),
(262, 0, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 0),
(263, 9, 'Korkuteli, Türkiye', 37.0766, 30.21, 1, '', -1, -1, 0, 0),
(264, 9, 'Denizli, Türkiye', 37.7765, 29.0864, 1, '', -1, -1, 0, 0),
(265, 9, 'Antalya, Türkiye', 36.8841, 30.7056, 1, '', -1, -1, 0, 0),
(266, 9, 'Adana, Türkiye', 37, 35.3213, 1, '', -1, -1, 0, 0),
(267, 9, 'Adana, Türkiye', 37, 35.3213, 1, '', -1, -1, 0, 0),
(268, 8, 'Konya, Türkiye', 37.8667, 32.4833, 1, '', -1, -1, 0, 0),
(269, 8, 'Konya, Türkiye', 37.8667, 32.4833, 1, 'Ankara, Türkiye', 39.9208, 32.8541, 1, 0),
(270, 9, 'Edirne, Türkiye', 41.6818, 26.5623, 1, '', -1, -1, 0, 0),
(271, 0, 'Adana, Türkiye', 37, 35.3213, 1, '', -1, -1, 0, 0),
(272, 0, 'Bahçeköy Merkez Mh., İstanbul, Türkiye', 41.1766, 28.9931, 1, '', -1, -1, 0, 0),
(273, 9, 'Adana, Türkiye', 37, 35.3213, 1, '', -1, -1, 0, 0),
(274, 0, 'Edirne, Türkiye', 41.6818, 26.5623, 1, '', -1, -1, 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `send_email_alert`
--

CREATE TABLE IF NOT EXISTS `send_email_alert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_alert_id` int(11) DEFAULT NULL,
  `is_success` tinyint(1) DEFAULT '0',
  `is_fail` tinyint(1) DEFAULT '0',
  `count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `email_alert_id` (`email_alert_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `send_email_alert`
--

INSERT INTO `send_email_alert` (`id`, `email_alert_id`, `is_success`, `is_fail`, `count`) VALUES
(1, 2, 0, 0, 0),
(2, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `send_email_review`
--

CREATE TABLE IF NOT EXISTS `send_email_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver_user_id` int(11) DEFAULT '0',
  `sender_user_id` int(11) DEFAULT '0',
  `is_success` tinyint(1) DEFAULT '0',
  `is_fail` tinyint(1) DEFAULT '0',
  `count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `receiver_user_id` (`receiver_user_id`),
  KEY `sender_user_id` (`sender_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `send_email_users`
--

CREATE TABLE IF NOT EXISTS `send_email_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(30) COLLATE utf8_turkish_ci DEFAULT 'update',
  `ride_offer_id` int(11) DEFAULT '0',
  `last_date` date DEFAULT NULL,
  `is_success` tinyint(1) DEFAULT '0',
  `is_fail` tinyint(1) DEFAULT '0',
  `count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `send_email_users`
--

INSERT INTO `send_email_users` (`id`, `user_id`, `type`, `ride_offer_id`, `last_date`, `is_success`, `is_fail`, `count`) VALUES
(1, 9, 'offer', 6, '2014-06-19', 0, 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_id` int(11) DEFAULT '1',
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `tel_no` varchar(14) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `tel_visible` tinyint(1) DEFAULT '1',
  `level_percent` int(11) DEFAULT '15',
  `response_rate` int(11) DEFAULT '100',
  `seen_last` datetime DEFAULT NULL,
  `seen_times` int(11) DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `surname` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `email_kod` int(6) DEFAULT NULL,
  `email_check` tinyint(4) DEFAULT '0',
  `tel_kod` int(11) DEFAULT NULL,
  `tel_check` tinyint(4) DEFAULT '0',
  `friends` int(11) DEFAULT '0',
  `face_check` tinyint(1) DEFAULT '0',
  `is_face_acount` tinyint(1) DEFAULT '0',
  `foto` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `foto_onay` tinyint(1) DEFAULT '1',
  `foto_exist` tinyint(1) DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  `ban` tinyint(1) DEFAULT '0',
  `country` varchar(80) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `birthyear` int(11) DEFAULT '0',
  `description` varchar(300) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `level_id` (`level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `level_id`, `password`, `email`, `tel_no`, `tel_visible`, `level_percent`, `response_rate`, `seen_last`, `seen_times`, `name`, `surname`, `sex`, `email_kod`, `email_check`, `tel_kod`, `tel_check`, `friends`, `face_check`, `is_face_acount`, `foto`, `foto_onay`, `foto_exist`, `active`, `ban`, `country`, `birthyear`, `description`, `created_at`, `updated_at`) VALUES
(0, 1, NULL, NULL, NULL, 1, 15, 100, NULL, 0, 'Ahmet', 'Korkmaz', 1, NULL, 0, NULL, 0, 0, 0, 0, 'http://www.hepgezelim.com/seyahat/assets/male.png', 1, 0, 1, 0, NULL, 1991, NULL, '2014-04-27 21:48:12', NULL),
(1, 1, '7c60aa462aa215f27e2d68be5e6de097', 'iso_akbudak_007@hotmaill.com', '', 0, 29, 100, '2014-04-28 18:06:12', 18, 'İsmail', 'Akbudak', 1, 22546, 1, NULL, 0, 334, 1, 1, 'http://graph.facebook.com/100002058515201/picture?width=160&height=200', 1, 1, 1, 0, NULL, 1991, 'Lol', '2014-04-26 20:23:35', '2014-04-28 23:06:12'),
(2, 1, 'ede5673f6b8b8dd18e4662071a83c1df', 'mehmet.ahsen@hotmail.com.tr', NULL, 1, 15, 100, NULL, 0, 'Mehmet', 'Ahsen', 1, 64774, 1, NULL, 0, 405, 1, 1, 'http://graph.facebook.com/697866648/picture?width=160&height=200', 1, 1, 1, 0, NULL, 1992, NULL, '2014-04-28 04:39:12', '2014-04-28 05:18:58'),
(3, 1, 'd686356c4d1a4edacee6c8dc6ed7631f', 'osm.gunes@hotmail.com', NULL, 1, 15, 100, NULL, 0, 'Osman', 'Güneş', 1, 71095, 0, NULL, 0, 225, 1, 1, 'http://graph.facebook.com/1344934034/picture?width=160&height=200', 1, 1, 1, 0, NULL, 1990, NULL, '2014-04-28 04:43:44', '2014-04-28 05:19:13'),
(5, 1, '06b63b1f1ab729a6983fc702b475505f', 'ogzldmrc@gmail.com', NULL, 1, 18, 100, '2014-04-29 00:48:02', 1, 'Onur', 'Güzeldemirci', 1, 29714, 1, NULL, 0, 385, 1, 1, 'http://graph.facebook.com/100002639006614/picture?width=160&height=200', 1, 1, 1, 0, NULL, 1989, NULL, '2014-04-28 07:29:55', '2014-04-29 05:48:55'),
(6, 1, 'c6bd6ab99942c09cea85e3150c6b7f09', 'ayse-hudos@hotmail.com', NULL, 1, 18, 100, '2014-04-28 12:22:59', 1, 'Ayşe', 'Isık', 2, 28687, 0, NULL, 0, 225, 1, 1, 'http://graph.facebook.com/531257229/picture?width=160&height=200', 0, 0, 1, 0, NULL, 1988, NULL, '2014-04-28 17:21:23', '2014-04-28 17:22:59'),
(7, 1, '2a4b83478dc5b05b99fb36922c718774', 'sezercetin64@hotmail.com', '0539 385 74 94', 0, 23, 100, '2014-05-02 13:27:48', 1, 'Ahmet Sezer', 'ÇETİN', 1, 23670, 0, NULL, 0, 0, 0, 0, 'http://www.hepgezelim.com/seyahat/assets/male.png', 1, 0, 1, 0, NULL, 1994, '', '2014-04-28 22:32:32', '2014-05-02 18:27:48'),
(8, 1, 'e10adc3949ba59abbe56e057f20f883e', 'iso_akbudak_007@hotmail.com', '0531 574 47 89', 1, 29, 100, '2014-05-05 12:43:42', 13, 'İsmail', 'Akbudak', 1, 63974, 1, NULL, 0, 335, 1, 1, 'http://graph.facebook.com/100002058515201/picture?width=160&height=200', 0, 0, 1, 0, NULL, 1991, 'Pamukkale Üniversitesinde öğrenciyim', '2014-04-29 01:54:18', '2014-05-05 10:43:42'),
(9, 1, 'e10adc3949ba59abbe56e057f20f883e', 'isoakbudak@gmail.com', NULL, 1, 28, 0, '2014-05-05 15:44:08', 14, 'Ahmet', 'KOCA', 1, 852, 1, NULL, 0, 0, 0, 0, 'http://www.hepgezelim.com/seyahat/assets/male.png', 1, 0, 1, 0, NULL, 1990, NULL, '2014-05-04 19:48:20', '2014-05-05 13:44:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_level`
--

CREATE TABLE IF NOT EXISTS `user_level` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) DEFAULT NULL,
  `tr_level` varchar(40) COLLATE utf8_turkish_ci DEFAULT NULL,
  `en_level` varchar(40) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=6 ;

--
-- Tablo döküm verisi `user_level`
--

INSERT INTO `user_level` (`level_id`, `level`, `tr_level`, `en_level`) VALUES
(1, 1, 'Yeni Üye', 'Beginner'),
(2, 2, 'Orta', 'Intermediate'),
(3, 3, 'Tecrübeli', 'Experienced'),
(4, 4, 'Uzman', 'Expert'),
(5, 5, 'Saygı Duyulan', 'Ambassador');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `warnings`
--

CREATE TABLE IF NOT EXISTS `warnings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(20) COLLATE utf8_turkish_ci DEFAULT 'warning',
  `warning` varchar(300) COLLATE utf8_turkish_ci DEFAULT NULL,
  `warning_en` varchar(300) COLLATE utf8_turkish_ci DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=11 ;

--
-- Tablo döküm verisi `warnings`
--

INSERT INTO `warnings` (`id`, `admin_id`, `user_id`, `type`, `warning`, `warning_en`, `is_read`, `created_at`) VALUES
(1, 1, 1, 'warning', 'Hoş foto', 'Hoş foto', 1, '2014-04-26 20:24:07'),
(2, 1, 1, 'warning', 'Adas', 'Asdsadasd', 1, '2014-04-26 22:21:12'),
(3, 1, 1, 'warning', 'Sdsdfd', 'Sdfsdfsfsdf', 1, '2014-04-26 23:02:44'),
(4, 1, 1, 'warning', 'Asdsda', 'D asdad a', 1, '2014-04-26 23:14:03'),
(5, 1, 2, 'info', 'Bu güzel foto için teşekkürler :)\n ', 'Thank you for this nice picture :)', 0, '2014-04-28 05:20:35'),
(6, 1, 3, 'info', 'Bu güzel foto için teşekkürler :)\n', 'Thank you for this nice picture :)', 0, '2014-04-28 05:20:45'),
(7, 1, 1, 'info', 'Bu güzel foto için teşekkürler :)', 'Thank you for this nice picture :)', 1, '2014-04-28 05:21:52'),
(8, 1, 5, 'info', 'Bu güzel fotoğraf için teşekkürler :)', 'Thank you for this nice picture :)', 0, '2014-04-28 08:01:34'),
(9, 1, 1, 'warning', 'Hoş değil', 'Hoş değil', 1, '2014-04-28 19:15:10'),
(10, 1, 1, 'info', 'Asdasd', 'Asdas', 1, '2014-04-28 19:16:43');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ways_offer`
--

CREATE TABLE IF NOT EXISTS `ways_offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ride_offer_id` int(11) DEFAULT NULL,
  `departure_place` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `arrivial_place` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `dLat` float DEFAULT NULL,
  `dLng` float DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_class` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `distance` double DEFAULT NULL,
  `time` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ride_offer_id` (`ride_offer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=11 ;

--
-- Tablo döküm verisi `ways_offer`
--

INSERT INTO `ways_offer` (`id`, `ride_offer_id`, `departure_place`, `lat`, `lng`, `arrivial_place`, `dLat`, `dLng`, `price`, `price_class`, `distance`, `time`) VALUES
(5, 3, 'Adana, Türkiye', 37, 35.3213, 'Denizli, Türkiye', 37.7765, 29.0864, 67, 'orange', 746.33, ' 10 saat 59 dk '),
(6, 4, 'Adana, Türkiye', 37, 35.3213, 'Edirne, Türkiye', 41.6818, 26.5623, 112, 'orange', 1173.51, ' 13 saat 34 dk '),
(7, 5, 'Edirne, Türkiye', 41.6818, 26.5623, 'Ankara, Türkiye', 39.9208, 32.8541, 69, 'orange', 687.699, '   6 saat 46 dakika'),
(8, 5, 'Ankara, Türkiye', 39.9208, 32.8541, 'Denizli, Türkiye', 37.7765, 29.0864, 47, 'orange', 466.452, '   7 saat 2 dakika'),
(9, 5, 'Edirne, Türkiye', 41.6818, 26.5623, 'Denizli, Türkiye', 37.7765, 29.0864, 116, 'red', 1154.151, ' 13 saat 48 dk '),
(10, 6, 'Konya, Türkiye', 37.8667, 32.4833, 'Ankara, Türkiye', 39.9208, 32.8541, 26, 'orange', 260.9, ' 4 saat 4 dk ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `way_points`
--

CREATE TABLE IF NOT EXISTS `way_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ride_offer_id` int(11) DEFAULT NULL,
  `departure_place` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `arrivial_place` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `distance` varchar(70) COLLATE utf8_turkish_ci DEFAULT NULL,
  `time` varchar(70) COLLATE utf8_turkish_ci DEFAULT NULL,
  `price_class` varchar(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `explain` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ride_offer_id` (`ride_offer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `way_points`
--

INSERT INTO `way_points` (`id`, `ride_offer_id`, `departure_place`, `arrivial_place`, `price`, `distance`, `time`, `price_class`, `explain`) VALUES
(1, 5, 'Edirne, Türkiye', 'Ankara, Türkiye', 69, '687.699', '   6 saat 46 dakika', 'orange', NULL),
(2, 5, 'Ankara, Türkiye', 'Denizli, Türkiye', 47, '466.452', '   7 saat 2 dakika', 'orange', NULL);

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `alerts`
--
ALTER TABLE `alerts`
  ADD CONSTRAINT `alerts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `alert_user`
--
ALTER TABLE `alert_user`
  ADD CONSTRAINT `alert_user_ibfk_1` FOREIGN KEY (`sender_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `alert_user_ibfk_2` FOREIGN KEY (`received_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `alert_user_ibfk_3` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `block_user`
--
ALTER TABLE `block_user`
  ADD CONSTRAINT `block_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `block_user_ibfk_2` FOREIGN KEY (`blocked_user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `complain`
--
ALTER TABLE `complain`
  ADD CONSTRAINT `complain_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `complain_ibfk_2` FOREIGN KEY (`complain_user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `delete_acount`
--
ALTER TABLE `delete_acount`
  ADD CONSTRAINT `delete_acount_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `email_alerts`
--
ALTER TABLE `email_alerts`
  ADD CONSTRAINT `email_alerts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `email_alerts_result`
--
ALTER TABLE `email_alerts_result`
  ADD CONSTRAINT `email_alerts_result_ibfk_1` FOREIGN KEY (`email_alert_id`) REFERENCES `email_alerts` (`id`),
  ADD CONSTRAINT `email_alerts_result_ibfk_2` FOREIGN KEY (`ride_offer_id`) REFERENCES `ride_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `look_at`
--
ALTER TABLE `look_at`
  ADD CONSTRAINT `look_at_ibfk_1` FOREIGN KEY (`ride_offer_id`) REFERENCES `ride_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `look_at_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`ride_offer_id`) REFERENCES `ride_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`received_user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `preferences_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`given_userid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`received_userid`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `ride_offers`
--
ALTER TABLE `ride_offers`
  ADD CONSTRAINT `ride_offers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ride_offers_ibfk_2` FOREIGN KEY (`luggage_id`) REFERENCES `luggages` (`id`),
  ADD CONSTRAINT `ride_offers_ibfk_3` FOREIGN KEY (`leave_time_id`) REFERENCES `leave_times` (`id`),
  ADD CONSTRAINT `ride_offers_ibfk_4` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);

--
-- Tablo kısıtlamaları `rutin_trip`
--
ALTER TABLE `rutin_trip`
  ADD CONSTRAINT `rutin_trip_ibfk_1` FOREIGN KEY (`ride_offer_id`) REFERENCES `ride_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `rutin_trip_dates`
--
ALTER TABLE `rutin_trip_dates`
  ADD CONSTRAINT `rutin_trip_dates_ibfk_1` FOREIGN KEY (`ride_offer_id`) REFERENCES `ride_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `searched`
--
ALTER TABLE `searched`
  ADD CONSTRAINT `searched_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `send_email_alert`
--
ALTER TABLE `send_email_alert`
  ADD CONSTRAINT `send_email_alert_ibfk_1` FOREIGN KEY (`email_alert_id`) REFERENCES `email_alerts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `send_email_review`
--
ALTER TABLE `send_email_review`
  ADD CONSTRAINT `send_email_review_ibfk_1` FOREIGN KEY (`receiver_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `send_email_review_ibfk_2` FOREIGN KEY (`sender_user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `send_email_users`
--
ALTER TABLE `send_email_users`
  ADD CONSTRAINT `send_email_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `user_level` (`level_id`);

--
-- Tablo kısıtlamaları `warnings`
--
ALTER TABLE `warnings`
  ADD CONSTRAINT `warnings_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_users` (`id`),
  ADD CONSTRAINT `warnings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `ways_offer`
--
ALTER TABLE `ways_offer`
  ADD CONSTRAINT `ways_offer_ibfk_1` FOREIGN KEY (`ride_offer_id`) REFERENCES `ride_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `way_points`
--
ALTER TABLE `way_points`
  ADD CONSTRAINT `way_points_ibfk_1` FOREIGN KEY (`ride_offer_id`) REFERENCES `ride_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
