<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS `{$this->getTable('singup/singup')}`;
CREATE TABLE `{$this->getTable('singup/singup')}` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `login` varchar(255) NOT NULL,
 `pass` varchar(255) NOT NULL,
 `e_mail` varchar(255) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
    ");

$installer->endSetup();