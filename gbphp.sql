-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 14 2020 г., 21:56
-- Версия сервера: 8.0.12
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gbphp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` varchar(10) NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `price`, `info`) VALUES
(1, 'ТОвар1', '100', 'ТОвар1 info'),
(2, 'ТОвар2', '2100', 'ТОвар2 info'),
(3, 'ТОвар3', '3100', 'ТОвар3 info'),
(4, 'ТОвар4', '4100', 'ТОвар4 info'),
(5, 'ТОвар5', '5100', 'ТОвар5 info');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `login` varchar(50) NOT NULL COMMENT 'Для авторизации',
  `password` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT 'n/o' COMMENT 'Имя пользователя',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица для пользователей';

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `is_admin`) VALUES
(16, 'admin', '$2y$10$.9nhFZISxZWikJVXHSmsdeZVsnWrMCSHugTeidkkPkTY6roTL0FA.', '123userAdd', 0),
(20, 'userAdd2', '123userAdd', '123userAdd', 1),
(21, '11', '22', 'n/o', 0),
(22, '222', '333', 'n/o', 0),
(23, '22', '33', 'n/o', 0),
(24, '12', '1222', 'n/o', 0),
(25, '12', '1222', 'n/o', 0),
(26, '12', '1222', 'n/o', 0),
(27, '11', '22', 'n/o', 0),
(28, '33', '33', 'n/o', 0),
(29, 'qwe', '1111111', 'n/o', 0),
(30, 'qwe', '1111111', 'n/o', 0),
(31, 'qwe', '1111111', 'n/o', 0),
(32, 'qwe', '1111111', 'n/o', 0),
(33, 'qwe', '1111111', 'n/o', 0),
(34, 'qwe', '1111111', 'n/o', 0),
(35, 'qwe', '1111111', 'n/o', 0),
(36, '11', '22', 'n/o', 0),
(37, 'log', 'pas', 'n/o', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
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
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
