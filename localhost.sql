-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018 年 1 月 27 日 15:06
-- サーバのバージョン： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `post_data`
--

CREATE TABLE IF NOT EXISTS `post_data` (
`id` int(12) NOT NULL,
  `uid` int(12) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `post_data`
--

INSERT INTO `post_data` (`id`, `uid`, `title`, `author`, `image`) VALUES
(2, 1, 'あゝ、荒野 (角川文庫)', '寺山 修司', 'https://images-fe.ssl-images-amazon.com/images/I/51VTbZUO-cL._SL160_.jpg'),
(3, 2, 'あのとき、僕らの歌声は。', 'AAA', 'https://images-fe.ssl-images-amazon.com/images/I/31QwEVKlB2L._SL160_.jpg'),
(4, 2, 'あのとき、僕らの歌声は。', 'AAA', 'https://images-fe.ssl-images-amazon.com/images/I/31QwEVKlB2L._SL160_.jpg'),
(5, 2, 'あのとき、僕らの歌声は。', 'AAA', 'https://images-fe.ssl-images-amazon.com/images/I/31QwEVKlB2L._SL160_.jpg'),
(6, 2, '金色夜叉 (新潮文庫)', '尾崎 紅葉', 'https://images-fe.ssl-images-amazon.com/images/I/51N2D340F1L._SL160_.jpg'),
(7, 1, '祈りの幕が下りる時 (講談社文庫)', '東野 圭吾', 'https://images-fe.ssl-images-amazon.com/images/I/51NGhtDe5eL._SL160_.jpg'),
(8, 1, 'ノルウェイの森 上 (講談社文庫)', '村上 春樹', 'https://images-fe.ssl-images-amazon.com/images/I/415nUi-kLYL._SL160_.jpg'),
(9, 1, 'からかい上手の高木さん（１）【期間限定　無料お試し版】 (ゲッサン少年サンデーコミックス)', '山本崇一朗', 'https://images-fe.ssl-images-amazon.com/images/I/51Ei46HcOrL._SL160_.jpg'),
(10, 1, 'オンブレ (新潮文庫 レ 11-1)', 'エルモア・レナード', 'https://images-fe.ssl-images-amazon.com/images/I/519xkfHzdAL._SL160_.jpg'),
(11, 1, 'シャーマンキング0 1 (ヤングジャンプコミックス)', '武井 宏之', 'https://images-fe.ssl-images-amazon.com/images/I/61a-vfvD%2BeL._SL160_.jpg');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
`id` int(12) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_data`
--

INSERT INTO `user_data` (`id`, `name`, `password`) VALUES
(1, 'あああ', '$2y$10$bqOzNxKFXp9xhnmF1NXLOuaHmC/UvSv2uUXHglhK5rEeG8ao.4I.C'),
(2, 'いいい', '$2y$10$GeLXXo/jWM7TMlCD93KcFOk5QDdE6gKL.72K53lSwFZIauDs49MEW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post_data`
--
ALTER TABLE `post_data`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post_data`
--
ALTER TABLE `post_data`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
