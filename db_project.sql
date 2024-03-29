-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 18 2019 г., 02:09
-- Версия сервера: 5.7.19
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `project`
--
CREATE DATABASE IF NOT EXISTS `project` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `project`;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `comment`, `date`, `user_id`, `status`) VALUES
(1, 'dddsfdsf fgfggfd', '2019-10-13 22:13:32', 2, 0),
(3, 'парпрр прпра', '2019-10-13 22:43:38', 3, 0),
(4, 'счсяч мсмчсм смсчм', '2019-10-13 23:14:25', 4, 0),
(5, 'fsfdsf dffdsf', '2019-10-14 16:24:37', 5, 0),
(6, 'фывро ыфовролрфволы', '2019-10-14 22:29:08', 6, 0),
(7, 'ывыфв ыфвфывывыф', '2019-10-14 22:33:40', 7, 0),
(9, 'asdsadsd asdad', '2019-10-19 19:58:57', 8, 0),
(10, 'dsfsdf dsf sdfdsfsdf', '2019-10-25 18:56:37', 7, 0),
(11, 'sffsdfdsfd dffsfsdfd', '2019-10-25 18:56:46', 6, 0),
(12, 'dsf dfdsff dfsdf', '2019-10-25 20:17:16', 5, 0),
(13, 'dasdsad asdasdasdda', '2019-10-27 13:16:03', 9, 1),
(14, 'Комментарий олвфды фывв', '2019-10-27 14:07:58', 11, 0),
(17, 'sdsad sadsds', '2019-11-17 22:38:57', 9, 0),
(18, 'sdsad sadsds', '2019-11-17 22:39:13', 9, 0),
(19, 'asdasd sadsghghjhjhjj', '2019-11-17 22:39:26', 9, 1),
(22, 'sdff dsfdsfdfdf', '2019-11-17 23:06:54', 13, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`) VALUES
(2, 'John Smit', 'john@mail.ru', '$2y$10$M7QwRUK50xDOGvfu4JDXN.BrOiwC/buYqltVEC8onYKxI68M.NFVO', ''),
(3, 'Petr', 'petrl@mail.ru', '$2y$10$Qntwl1VbsmRJqUgIXOQqVeprYvWQjkT0IE0fOQVmj0fSXXBGcg6Ru', ''),
(4, 'Gorg', 'gorg@mail.ru', '$2y$10$QpqvmG80sc28UNMp8pm39.YOf6.1CA9oGn0A0S2eLWPyasggJFbaa', ''),
(5, 'Vasil', 'vasil@mail.ru', '$2y$10$uGpiPX0brmseQ4Xh2Nra/.dvjjDks2PB.6aDQ/pjsPFSsx2E2r4yO', ''),
(6, 'Boris', 'boris@mail.ru', '$2y$10$VKxtDSGTX1MTpKXEnRLp9uH7AqAB9jsii2ZgSVkk/wEWBYwXZWw.6', ''),
(7, 'Fedor', 'fedor@mail.ru', '$2y$10$vdYTpauYf/BKNPbu2X3IZ.prXUc7kgsYu3wZfV.6PkIy5RP/9cLtq', ''),
(8, 'Kolya', 'kolya@mail.ru', '$2y$10$vBkEjjYLI5MsogI3SePF9OiAjWanFUp5o4CgCMb960C18mwh/uu8K', ''),
(10, 'name', 'name@name.ru', '$2y$10$6JruPcrx5wVbMzGblBFDRu6f4RqsN2cXMRMMuQS2jjLW3yprRCOHW', ''),
(11, 'Ivan Grozniy', 'grozniy@mail.ru', '$2y$10$sUGu6S2Mvuc66GwbWqvmzeWMmNNs3atV15.Qc.gJ9JjjN.DzZcYdS', ''),
(12, 'brod', 'brod@mail.ru', '$2y$10$fiOVSuAsHUnaBK00R6ZVT.wni8XF/EUWo3o/f4ZAO226t6UfqWcdG', '5dd1d21a063f0.jpg'),
(13, 'superman', 'superman@mail.ru', '$2y$10$NlkO0BKAtz1i19Aejb0RnO9APxTJHfpMqbl4.7Ox6jz1SyVaTjhye', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
