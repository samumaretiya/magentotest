<?php
class Dcs_Homebanner_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/homebanner?id=15 
    	 *  or
    	 * http://site.com/homebanner/id/15 	
    	 */
    	/* 
		$homebanner_id = $this->getRequest()->getParam('id');

  		if($homebanner_id != null && $homebanner_id != '')	{
			$homebanner = Mage::getModel('homebanner/homebanner')->load($homebanner_id)->getData();
		} else {
			$homebanner = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($homebanner == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$homebannerTable = $resource->getTableName('homebanner');
			
			$select = $read->select()
			   ->from($homebannerTable,array('homebanner_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$homebanner = $read->fetchRow($select);
		}
		Mage::register('homebanner', $homebanner);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }

}