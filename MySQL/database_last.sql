-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 09 2013 г., 16:51
-- Версия сервера: 5.5.32-0ubuntu0.13.04.1
-- Версия PHP: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `database_ib`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `name_translit` varchar(200) DEFAULT NULL,
  `description` text,
  `keywords` varchar(200) NOT NULL,
  `descr` text NOT NULL,
  `title` varchar(200) NOT NULL,
  `seo_text` text NOT NULL,
  `status` int(11) DEFAULT '0',
  `sort` tinyint(4) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `date`, `name`, `name_translit`, `description`, `keywords`, `descr`, `title`, `seo_text`, `status`, `sort`, `parent_id`) VALUES
(1, 1384001297, 'Тестовая статья', 'testovaya-stat-ya', '<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 15px; font-style: normal; font-variant: normal; line-height: 22.984375px; background-color: rgb(255, 255, 255);"><strong style="font-size: 15px;">Житель штата Мичиган, США, Джозеф Палмарчук, два года назад выигравший в лотерею 1 миллион долларов, в среду выиграл джек-пот региональной лотереи Classic Lotto 47 в размере 1,35 миллиона долларов, сообщает агентство Associated Press.</strong><br>&nbsp;</div><div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 15px; font-style: normal; font-variant: normal; line-height: 22.984375px; background-color: rgb(255, 255, 255);">На полученные средства семья планирует приобрести квартиру в одном из южных штатов, чтобы проводить там зимние месяцы. Журналистам победитель заявил, что любит покупать лотерейные билеты и всегда чувствовал, что еще раз победит. По словам Палмарчука, теперь он рассчитывает выиграть приз покрупнее — джекпот лотереи Mega Millions или Powerball, сумма которого, как правило, доходит до нескольких сотен миллионов долларов, передает CBS.<br>&nbsp;<span id="bufferBlock" style="height: 1px; overflow: hidden; position: absolute; width: 1px; margin-top: 5px; margin-left: -1px; line-height: 0; opacity: 0;"><br>Читать полностью:&nbsp;<a href="http://finance.tut.by/news374094.html?utm_source=news-right-block&amp;utm_medium=other-news&amp;utm_campaign=other-news" style="border: 0px; font-family: inherit; color: rgb(25, 44, 143); text-decoration: underline; line-height: inherit;">http://finance.tut.by/news374094.html?utm_source=news-right-block&amp;utm_medium=other-news&amp;utm_campaign=other-news</a></span></div>', '', '', '', '', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `article_images`
--

CREATE TABLE IF NOT EXISTS `article_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `img_url` varchar(200) DEFAULT NULL,
  `img_alt` varchar(85) DEFAULT ' ',
  `img_title` varchar(85) DEFAULT ' ',
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `article_images`
--

INSERT INTO `article_images` (`id`, `parent_id`, `img_url`, `img_alt`, `img_title`, `sort`, `status`) VALUES
(1, 1, '/content/images/article_images/last_breath-_by_francisco_javier_epinoza_p-rez-jpg-.jpg', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `translit` varchar(65) DEFAULT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `img_alt` varchar(80) DEFAULT NULL,
  `img_title` varchar(80) DEFAULT NULL,
  `keywords` varchar(250) NOT NULL,
  `descript` text NOT NULL,
  `seo_text` text NOT NULL,
  `title` varchar(200) NOT NULL,
  `descr` text,
  `status` tinyint(4) DEFAULT '0',
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `name`, `translit`, `img_url`, `img_alt`, `img_title`, `keywords`, `descript`, `seo_text`, `title`, `descr`, `status`, `sort`) VALUES
(1, 'Тестовый производитель', 'testovyy-proizvoditel', '/content/images/category_images/la_gomera_by_alfonso_aguirre_arbex-jpg-.jpg', '', '', '', '', '', '', '', 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(60) DEFAULT NULL,
  `translit_name` varchar(60) DEFAULT NULL,
  `keywords` varchar(250) NOT NULL,
  `seo_text` text NOT NULL,
  `descr` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `rus_url` varchar(300) NOT NULL,
  `img_url` varchar(200) DEFAULT NULL,
  `img_title` varchar(100) DEFAULT NULL,
  `img_alt` varchar(100) DEFAULT NULL,
  `date` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `sort` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `translit_name`, `keywords`, `seo_text`, `descr`, `title`, `rus_url`, `img_url`, `img_title`, `img_alt`, `date`, `status`, `sort`) VALUES
(34, 'Тестовая категория', 'testovaya-kategoriya', 'Ключевые слова (keywords)', '', 'Описание (description)', 'Название (title)', '', '/content/images/category_images/leftover_by_sagar_jain-jpg-.jpg', NULL, NULL, 1384001018, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `velcom` varchar(100) NOT NULL,
  `mts` varchar(100) NOT NULL,
  `life` varchar(100) NOT NULL,
  `dialog` varchar(100) NOT NULL,
  `gorod` varchar(100) NOT NULL,
  `name` varchar(250) NOT NULL,
  `img_url` varchar(250) NOT NULL,
  `other` text NOT NULL,
  `adr` varchar(200) NOT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `val` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `name`, `val`, `status`) VALUES
(1, 'USD', 1, 0),
(2, 'BYR', 9250, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `details`
--

CREATE TABLE IF NOT EXISTS `details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT '0',
  `name` varchar(65) DEFAULT NULL,
  `name_translit` varchar(65) DEFAULT NULL,
  `sort` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL DEFAULT 'text',
  `tag` varchar(100) NOT NULL,
  `placeholder` varchar(200) NOT NULL,
  `ident` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `main_pages`
--

CREATE TABLE IF NOT EXISTS `main_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `translit_name` varchar(45) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `msg_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `msg_id`
--

CREATE TABLE IF NOT EXISTS `msg_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(60) NOT NULL,
  `date` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `translit` varchar(100) NOT NULL,
  `keywords` text NOT NULL,
  `descr` text NOT NULL,
  `title` varchar(150) NOT NULL,
  `seo_text` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `name`, `translit`, `keywords`, `descr`, `title`, `seo_text`, `status`, `sort`) VALUES
(1, 'Каталог', 'catalog', 'keys2456456', 'descr5', 'CATALOG', 'seotext7456', 0, 0),
(2, 'Производители', 'brands', 'wegweg45456456', 'gweg', 'BRANDS', 'weg', 0, 0),
(3, 'Контакты', 'contacts', 'ywords)', 'ywords)', 'CONTACTS', 'wegywords)', 0, 0),
(4, 'Статьи', 'articles', 'FEEDBACK', 'rsthrth', 'NEWS', 'hrsth', 0, 0),
(5, 'Главная', '/', 'srthsrth', 'rsth', 'MAIN', 'weh', 0, 0),
(6, 'Обратная связь', 'feedback', '', '', 'FEEDBACK', '', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `product_name` varchar(60) DEFAULT NULL,
  `name_translit` varchar(60) DEFAULT NULL,
  `keywords` varchar(250) NOT NULL,
  `seo_text` text NOT NULL,
  `descr` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `cost` varchar(50) NOT NULL DEFAULT '0',
  `currency` varchar(10) NOT NULL DEFAULT 'Бел. руб.',
  `date` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `sub_category_id`, `category_id`, `brand_id`, `product_name`, `name_translit`, `keywords`, `seo_text`, `descr`, `title`, `cost`, `currency`, `date`, `status`, `sort`) VALUES
(1, 1, 34, 1, 'Тестовый товар', 'testovyy-tovar', '', '', '', '', '5000', '1', 1384001071, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `img_url` varchar(200) DEFAULT NULL,
  `img_url_small` varchar(250) NOT NULL,
  `img_alt` varchar(80) DEFAULT NULL,
  `img_title` varchar(80) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `img_url`, `img_url_small`, `img_alt`, `img_title`, `status`, `sort`) VALUES
(1, 1, '/content/images/product_images/1/cacomixtle_ubunte-o_by_carlos_and_paula_morales-jpg-1384001071.jpg', '/content/images/product_images/1/s/cacomixtle_ubunte-o_by_carlos_and_paula_morales-jpg-1384001071.jpg', '', '', 3, NULL),
(2, 1, '/content/images/product_images/1/fleurs_de_prunus_2-4_by_j-r-me_boivin-jpg-1384001071.jpg', '/content/images/product_images/1/s/fleurs_de_prunus_2-4_by_j-r-me_boivin-jpg-1384001071.jpg', '', '', 3, NULL),
(3, 1, '/content/images/product_images/1/la_gomera_by_alfonso_aguirre_arbex-jpg-1384001072.jpg', '/content/images/product_images/1/s/la_gomera_by_alfonso_aguirre_arbex-jpg-1384001072.jpg', '', '', 3, NULL),
(4, 1, '/content/images/product_images/1/last_breath-_by_francisco_javier_epinoza_p-rez-jpg-1384001072.jpg', '/content/images/product_images/1/s/last_breath-_by_francisco_javier_epinoza_p-rez-jpg-1384001072.jpg', '', '', 3, NULL),
(5, 1, '/content/images/product_images/1/landing_by_nic_dahlquist-jpg-1384001073.jpg', '/content/images/product_images/1/s/landing_by_nic_dahlquist-jpg-1384001073.jpg', '', '', 3, NULL),
(6, 1, '/content/images/product_images/1/la_gomera_by_alfonso_aguirre_arbex-jpg-1384001210.jpg', '/content/images/product_images/1/s/la_gomera_by_alfonso_aguirre_arbex-jpg-1384001210.jpg', '', '', 3, NULL),
(7, 1, '/content/images/product_images/1/landing_by_nic_dahlquist-jpg-1384001211.jpg', '/content/images/product_images/1/s/landing_by_nic_dahlquist-jpg-1384001211.jpg', '', '', 3, NULL),
(8, 1, '/content/images/product_images/1/morning_sun_on_frost-covered_leaves_by_gary_a_stafford-jpg-1384001211.jpg', '/content/images/product_images/1/s/morning_sun_on_frost-covered_leaves_by_gary_a_stafford-jpg-1384001211.jpg', '', '', 3, NULL),
(9, 1, '/content/images/product_images/1/leftover_by_sagar_jain-jpg-1384001212.jpg', '/content/images/product_images/1/s/leftover_by_sagar_jain-jpg-1384001212.jpg', '', '', 3, NULL),
(10, 1, '/content/images/product_images/1/last_breath-_by_francisco_javier_epinoza_p-rez-jpg-1384001212.jpg', '/content/images/product_images/1/s/last_breath-_by_francisco_javier_epinoza_p-rez-jpg-1384001212.jpg', '', '', 3, NULL),
(11, 1, '/content/images/product_images/1/morning_sun_on_frost-covered_leaves_by_gary_a_stafford-jpg-1384001451.jpg', '/content/images/product_images/1/s/morning_sun_on_frost-covered_leaves_by_gary_a_stafford-jpg-1384001451.jpg', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `ip` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `val` float NOT NULL,
  `date` int(11) NOT NULL,
  `text` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `name`, `ip`, `email`, `val`, `date`, `text`, `status`) VALUES
(1, 1, 'Ilya', '127.0.0.1', 'ilya.baranovskiy@mail.ru', 4.8, 1384001355, 'тестовый текст сообщениятестовый текст сообщения', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'login', 'Login privileges, granted after account confirmation'),
(2, 'admin', 'Administrative user, has access to everything.');

-- --------------------------------------------------------

--
-- Структура таблицы `roles_users`
--

CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles_users`
--

INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(1, 2),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `slideshow`
--

CREATE TABLE IF NOT EXISTS `slideshow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_url` varchar(200) NOT NULL,
  `img_title` text NOT NULL,
  `img_alt` text NOT NULL,
  `img_link` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(250) NOT NULL,
  `to` varchar(250) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `browser` varchar(200) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Дамп данных таблицы `stats`
--

INSERT INTO `stats` (`id`, `from`, `to`, `ip`, `browser`, `date`) VALUES
(1, 'прямая ссылка', 'Главная', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384000767),
(2, 'прямая ссылка', 'Главная', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384000827),
(3, 'прямая ссылка', 'Главная', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384000836),
(4, 'прямая ссылка', 'Главная', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384000897),
(5, 'прямая ссылка', 'Главная', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384000919),
(6, 'http%3A%2F%2Fadmin.local%2F', '/feedback', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384000921),
(7, 'http%3A%2F%2Fadmin.local%2Ffeedback', '/feedback', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384000925),
(8, 'http%3A%2F%2Fadmin.local%2Ffeedback', '/brands', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384000927),
(9, 'http%3A%2F%2Fadmin.local%2Fbrands', 'Главная', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384000928),
(10, 'http%3A%2F%2Fadmin.local%2F', '/articles', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384000929),
(11, 'http%3A%2F%2Fadmin.local%2Farticles', '/contacts', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384000929),
(12, 'http%3A%2F%2Fadmin.local%2Fcontacts', '/catalog', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384000930),
(13, 'http%3A%2F%2Fadmin.local%2Fcontacts', '/catalog', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001023),
(14, 'http%3A%2F%2Fadmin.local%2Fcatalog', '/catalog/testovaya-kategoriya', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001024),
(15, 'http%3A%2F%2Fadmin.local%2Fcatalog', '/catalog/testovaya-kategoriya', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001074),
(16, 'http%3A%2F%2Fadmin.local%2Fcatalog%2Ftestovaya-kategoriya', '/catalog/testovaya-kategoriya/testovaya-podkategoriya', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001075),
(17, 'http%3A%2F%2Fadmin.local%2Fcatalog%2Ftestovaya-kategoriya%2Ftestovaya-podkategoriya', '/catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001077),
(18, 'http%3A%2F%2Fadmin.local%2Fcatalog%2Ftestovaya-kategoriya%2Ftestovaya-podkategoriya', '/catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001085),
(19, 'http%3A%2F%2Fadmin.local%2Fcatalog%2Ftestovaya-kategoriya%2Ftestovaya-podkategoriya', '/catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001126),
(20, 'http%3A%2F%2Fadmin.local%2Fcatalog%2Ftestovaya-kategoriya%2Ftestovaya-podkategoriya', '/catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001129),
(21, 'http%3A%2F%2Fadmin.local%2Fcatalog%2Ftestovaya-kategoriya%2Ftestovaya-podkategoriya', '/catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001205),
(22, 'http%3A%2F%2Fadmin.local%2Fcatalog%2Ftestovaya-kategoriya%2Ftestovaya-podkategoriya', '/catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001212),
(23, 'http%3A%2F%2Fadmin.local%2Fcatalog%2Ftestovaya-kategoriya%2Ftestovaya-podkategoriya', '/catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001224),
(24, 'http%3A%2F%2Fadmin.local%2Fcatalog%2Ftestovaya-kategoriya%2Ftestovaya-podkategoriya%2Ftestovyy-tovar', '/articles', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001232),
(25, 'http%3A%2F%2Fadmin.local%2Fcatalog%2Ftestovaya-kategoriya%2Ftestovaya-podkategoriya%2Ftestovyy-tovar', '/articles', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001278),
(26, 'http%3A%2F%2Fadmin.local%2Farticles', '/articles/testovaya-stat-ya', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001280),
(27, 'http%3A%2F%2Fadmin.local%2Farticles', '/articles/testovaya-stat-ya', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001292),
(28, 'http%3A%2F%2Fadmin.local%2Fcatalog%2Ftestovaya-kategoriya%2Ftestovaya-podkategoriya%2Ftestovyy-tovar', '/articles', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001293),
(29, 'http%3A%2F%2Fadmin.local%2Fcatalog%2Ftestovaya-kategoriya%2Ftestovaya-podkategoriya%2Ftestovyy-tovar', '/articles', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001298),
(30, 'http%3A%2F%2Fadmin.local%2Farticles', '/brands', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001315),
(31, 'http%3A%2F%2Fadmin.local%2Fbrands', '/brands/testovyy-proizvoditel', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001315),
(32, 'http%3A%2F%2Fadmin.local%2Fbrands', '/brands/testovyy-proizvoditel', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001325),
(33, 'http%3A%2F%2Fadmin.local%2Fbrands%2Ftestovyy-proizvoditel', '/catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001326),
(34, 'http%3A%2F%2Fadmin.local%2Fbrands', '/brands/testovyy-proizvoditel', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001326),
(35, 'http%3A%2F%2Fadmin.local%2Fbrands%2Ftestovyy-proizvoditel', '/catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001328),
(36, 'http%3A%2F%2Fadmin.local%2Fcatalog%2Ftestovaya-kategoriya%2Ftestovaya-podkategoriya%2Ftestovyy-tovar', '/catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001354),
(37, 'http%3A%2F%2Fadmin.local%2Fcatalog%2Ftestovaya-kategoriya%2Ftestovaya-podkategoriya%2Ftestovyy-tovar', '/feedback', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001362),
(38, 'http%3A%2F%2Fadmin.local%2Fbrands%2Ftestovyy-proizvoditel', '/catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001379),
(39, 'http%3A%2F%2Fadmin.local%2Fbrands%2Ftestovyy-proizvoditel', '/catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001380),
(40, 'http%3A%2F%2Fadmin.local%2Fbrands%2Ftestovyy-proizvoditel', '/catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001386),
(41, 'http%3A%2F%2Fadmin.local%2Fbrands%2Ftestovyy-proizvoditel', '/catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001435),
(42, 'прямая ссылка', '//catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001454),
(43, 'прямая ссылка', '//catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001455),
(44, 'прямая ссылка', '//catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001456),
(45, 'прямая ссылка', '//catalog/testovaya-kategoriya/testovaya-podkategoriya/testovyy-tovar', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384001456);

-- --------------------------------------------------------

--
-- Структура таблицы `stats_uniq`
--

CREATE TABLE IF NOT EXISTS `stats_uniq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to` varchar(250) NOT NULL,
  `from` varchar(250) NOT NULL,
  `browser` varchar(250) NOT NULL,
  `date` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `stats_uniq`
--

INSERT INTO `stats_uniq` (`id`, `to`, `from`, `browser`, `date`, `ip`) VALUES
(1, 'Главная', 'прямая ссылка', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.66 Safari/537.36', 1384000767, '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `sub_categories`
--

CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `sub_name` varchar(60) DEFAULT NULL,
  `sub_translit` varchar(60) DEFAULT NULL,
  `keywords` varchar(250) NOT NULL,
  `seo_text` text NOT NULL,
  `descr` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `img_url` varchar(200) DEFAULT NULL,
  `img_title` varchar(100) NOT NULL,
  `img_alt` varchar(100) NOT NULL,
  `date` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `sort` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `parent_id`, `sub_name`, `sub_translit`, `keywords`, `seo_text`, `descr`, `title`, `img_url`, `img_title`, `img_alt`, `date`, `status`, `sort`) VALUES
(1, 34, 'Тестовая подкатегория', 'testovaya-podkategoriya', 'Название (title)Тестовая подкатегория', 'Название (title)Тестовая подкатегория', 'Название (title)Тестовая подкатегория', 'Название (title)Тестовая подкатегория', '/content/images/category_images/landing_by_nic_dahlquist-jpg-.jpg', '', '', 1384001049, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `sub_details`
--

CREATE TABLE IF NOT EXISTS `sub_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_id` int(11) DEFAULT NULL,
  `key` varchar(65) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `sub_details_val`
--

CREATE TABLE IF NOT EXISTS `sub_details_val` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `sub_detail_id` int(11) NOT NULL,
  `value` varchar(150) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `logins`, `last_login`) VALUES
(2, 'ilya.baranovskiy@mail.ru', 'baranovskiy', '46dfbfc841ce192dfb485e9faae067ebe36c3ec11fb1a9c08462129732dd5d11', 117, 1383986362),
(3, 'stylish@ceramics.by', 'stylish', '7a940f41a3d173962e56251eeec24f95c25531d44d10728409dd5d0a73d8d58a', 6, 1383728500);

-- --------------------------------------------------------

--
-- Структура таблицы `user_tokens`
--

CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`),
  KEY `expires` (`expires`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `votes_id`
--

CREATE TABLE IF NOT EXISTS `votes_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `votes_users`
--

CREATE TABLE IF NOT EXISTS `votes_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `for` int(11) NOT NULL,
  `ip` varchar(60) NOT NULL,
  `date` int(11) NOT NULL,
  `data` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `vote_item`
--

CREATE TABLE IF NOT EXISTS `vote_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `parent_id` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
