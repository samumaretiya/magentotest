<?php

class Dcs_Homebanner_Model_Mysql4_Homebanner_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('homebanner/homebanner');
    }
	
	public function addStoreFilter($store)
    {
        if ($store instanceof Mage_Core_Model_Store) {
            $store = array($store->getId());
        }
		
        $this->getSelect()->join(
            array('store_table' => $this->getTable('homebanner_store')),
            'main_table.homebanner_id = store_table.homebanner_id',
            array()
        )
            ->where('store_table.store_id in (?)', array(0, $store))
			->group('homebanner_id');
			//print_r($store);
		/*$this->getSelect()->join(
    'homebanner_store',
    'main_table.homebanner_id = homebanner_store.homebanner_id',
    array()
)
->where("homebanner_store.store_id = '".$store."' || homebanner_store.store_id = '0'")
->group('homebanner_id');	*/

        return $this;
    }
}