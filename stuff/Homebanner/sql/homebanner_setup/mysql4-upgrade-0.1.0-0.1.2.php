<?php
$installer = new Mage_Core_Model_Resource_Setup();

$installer->getConnection()->addColumn($installer->getTable('newsletter_subscriber'),
    'subscriber_firstname', 'varchar(255) AFTER subscriber_email');

