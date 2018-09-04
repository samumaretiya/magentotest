<?php

class Dcs_Homebanner_Block_Adminhtml_Homebanner_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'homebanner';
        $this->_controller = 'adminhtml_homebanner';
        
        $this->_updateButton('save', 'label', Mage::helper('homebanner')->__('Save Banner'));
        $this->_updateButton('delete', 'label', Mage::helper('homebanner')->__('Delete Banner'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('homebanner_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'homebanner_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'homebanner_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('homebanner_data') && Mage::registry('homebanner_data')->getId() ) {
            return Mage::helper('homebanner')->__("Edit Banner '%s'", $this->htmlEscape(Mage::registry('homebanner_data')->getTitle()));
        } else {
            return Mage::helper('homebanner')->__('Add Banner');
        }
    }
}