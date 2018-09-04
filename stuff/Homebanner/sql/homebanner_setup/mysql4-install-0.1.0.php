<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('homebanner')};
CREATE TABLE {$this->getTable('homebanner')} (
  `homebanner_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `filename` varchar(255) NOT NULL default '',
  `visibility` varchar(255) NOT NULL default '',
  `bannerlink` varchar(255) NOT NULL default '',
  `slogan_desktop` varchar(255) NOT NULL default '',
  `slogan_mobile` varchar(255) NOT NULL default '',
  `rank` smallint(6) NOT NULL default '0',
  `status` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`homebanner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- DROP TABLE IF EXISTS {$this->getTable('homebanner_store')};
CREATE TABLE {$this->getTable('homebanner_store')} (                                
 `homebanner_id` int(11) NOT NULL,                               
 `store_id` smallint(5) unsigned NOT NULL,                    
 PRIMARY KEY  (`homebanner_id`,`store_id`),                      
 KEY `FK_HOMEBANNER_STORE_STORE` (`store_id`)                    
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Home Banners Stores';



    ");

$installer->endSetup(); 