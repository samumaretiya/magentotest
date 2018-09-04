<?php

class Dcs_Homebanner_Block_Adminhtml_Homebanner_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('homebanner_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('homebanner')->__('Banner Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('homebanner')->__('Banner Information'),
          'title'     => Mage::helper('homebanner')->__('Banner Information'),
          'content'   => $this->getLayout()->createBlock('homebanner/adminhtml_homebanner_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}