<?php
class Dcs_Homebanner_Block_Homebanner extends Mage_Core_Block_Template
{
	
	public function __construct() {
			parent::__construct();
			$collection = Mage::getModel('homebanner/homebanner')->getCollection();
			$collection->addFieldToFilter('status',1)->addFieldToFilter('filename', array('neq' => ''));			
			$collection->addStoreFilter(Mage::app()->getStore(true)->getId());
					
			$collection->setOrder('rank', 'ASC');						
			$this->setHomebanner($collection);			
			return $this;
			
			
	}
	
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getHomebanner()     
     { 
        if (!$this->hasData('homebanner')) {
            $this->setData('homebanner', Mage::registry('homebanner'));
        }		
        return $this->getData('homebanner');		
        
    }
	
	 
	
}