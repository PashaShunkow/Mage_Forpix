<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mysql4-install-0.2.0
 *
 * @author shev
 */
$installer = $this;
$installer->startSetup();

$installer->run(
        "CREATE TABLE IF NOT EXISTS `{$this->getTable('forpix/images')}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_names` text NOT NULL,
  `width` int(10) NOT NULL,
  `hight` int(10) NOT NULL,
  `description` text,
  `tegs` text,
  `category` text NOT NULL,
  `imgorfoto` text NOT NULL,
  `name` text NOT NULL,
  `data_add` date NOT NULL,
  `user_login` varchar(50) DEFAULT NULL,
  `download` int(11) DEFAULT '0',
  `up` int(11) DEFAULT '0',
  `top` tinyint(1) DEFAULT '0',
  `moderation` int(11) NOT NULL DEFAULT '1',
  `colors` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8");





$installer->run("CREATE TABLE IF NOT EXISTS `fp_gallery_dir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dir_id` int(10) NOT NULL,
  `name_dir` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

$installer->run("INSERT INTO `fp_gallery_dir` (`id`, `dir_id`, `name_dir`) VALUES
(2, 2, 'Города'),
(3, 3, 'Кино'),
(4, 4, 'Девушки'),
(5, 5, 'Природа'),
(6, 6, 'Автомобили'),
(7, 7, 'Животные'),
(8, 8, 'Еда'),
(9, 9, 'Разное'),
(10, 10, 'Компьютеры'),
(11, 11, 'Под водой'),
(12, 12, 'Макро'),
(13, 13, 'Море'),
(14, 14, 'Фэнтези'),
(15, 15, 'Музыка'),
(16, 16, 'Спорт'),
(17, 17, 'Дети'),
(18, 18, 'Бренды'),
(19, 19, 'Мотоциклы'),
(20, 20, 'Архитектура'),
(21, 21, 'Игры'),
(22, 22, 'Абстрактные'),
(23, 23, 'Знаменитости'),
(24, 24, 'Части тела'),
(25, 25, 'Стиль'),
(26, 26, 'Насекомые'),
(27, 27, 'Космос'),
(28, 28, 'Оружие'),
(29, 29, 'Текстуры'),
(30, 30, 'Цветы'),
(31, 31, 'Любовь'),
(32, 32, 'Армия'),
(33, 33, 'Аниме'),
(34, 34, 'Авиация'),
(35, 35, 'Праздники'),
(36, 36, 'Мужчины')");


$installer->endSetup();

