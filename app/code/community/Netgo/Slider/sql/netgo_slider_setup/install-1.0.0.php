<?php
/***************************************
 *** Home Background Slider Extension ***
 ***************************************
 *
 * @copyright   Copyright (c) 2015
 * @company     NetAttingo Technologies
 * @package     Netgo_Slider
 * @author 		Vipin
 * @dev			77vips@gmail.com
 *
 */
 $installer = $this;

$installer->startSetup();

$installer->run("
CREATE TABLE IF NOT EXISTS `{$this->getTable('netgo_slider_homeslider')}` (
  `entity_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Homeslider ID',
  `caption` varchar(255) NOT NULL COMMENT 'Caption',
  `image` varchar(255) DEFAULT NULL COMMENT 'Image',
  `mobileimage` varchar(255) DEFAULT NULL COMMENT 'Mobile Image',
  `url_key` varchar(255) DEFAULT NULL COMMENT 'URL key',
  `status` int(11) DEFAULT NULL COMMENT 'Homeslider Status',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Homeslider Modification Time',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Homeslider Creation Time',
  PRIMARY KEY (`entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Homeslider Table' AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `{$this->getTable('netgo_slider_homeslider_store')}` (
 `homeslider_id` int(11) NOT NULL COMMENT 'Homeslider ID',
  `store_id` smallint(5) unsigned NOT NULL COMMENT 'Store ID',
  PRIMARY KEY (`homeslider_id`,`store_id`),
  KEY `IDX_NETGO_SLIDER_HOMESLIDER_STORE_STORE_ID` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Homeslider To Store Linkage Table';

 
ALTER TABLE `{$this->getTable('netgo_slider_homeslider_store')}`
ADD FOREIGN KEY (`homeslider_id`) REFERENCES `{$this->getTable('netgo_slider_homeslider')}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD FOREIGN KEY (`store_id`) REFERENCES `{$this->getTable('core_store')}` (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `{$this->getTable('netgo_slider_homeslider')}`  (`entity_id`, `caption`, `image`, `mobileimage`, `url_key`, `status`, `updated_at`, `created_at`) VALUES
(1, 'this is test caption', '/h/y/hydrangeas.jpg', NULL, 'this-is-test-caption', 1, '', ''),
(2, 'Test caption two', '/t/u/tulips.jpg', NULL, 'test-caption-two', 1, '', '');

 INSERT INTO `{$this->getTable('netgo_slider_homeslider_store')}`  (`homeslider_id`, `store_id`) VALUES
(1, 1),
(2, 1); 
");

$installer->endSetup();
  