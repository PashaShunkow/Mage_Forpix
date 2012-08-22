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
  `opisanie_mini` text,
  `opisanie` text,
  `tegs` text,
  `kategoriya` text NOT NULL,
  `imgorfoto` text NOT NULL,
  `nazvanie` text NOT NULL,
  `data_add` date NOT NULL,
  `user_login` varchar(50) DEFAULT NULL,
  `download` int(11) DEFAULT '0',
  `up` int(11) DEFAULT '0',
  `top` tinyint(1) DEFAULT '0',
  `moderation` int(11) NOT NULL DEFAULT '1',
  `colors` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8");

$installer->endSetup();

