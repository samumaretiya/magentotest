<?php
class Dcs_Homebanner_Block_Adminhtml_Homebanner extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_homebanner';
    $this->_blockGroup = 'homebanner';
    $this->_headerText = Mage::helper('homebanner')->__('Banner Manager');
    $this->_addButtonLabel = Mage::helper('homebanner')->__('Add Banner');
    parent::__construct();
  }
}