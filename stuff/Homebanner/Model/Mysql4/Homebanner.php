<?php

class Dcs_Homebanner_Model_Mysql4_Homebanner extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the homebanner_id refers to the key field in your database table.
        $this->_init('homebanner/homebanner', 'homebanner_id');
    }
	
	
	protected function _afterSave(Mage_Core_Model_Abstract $object) {
		$oldStores = $this->lookupStoreIds($object->getId());
		$newStores = (array)$object->getStores();
		if (empty($newStores)) {
			$newStores = (array)$object->getStoreId();
		}
		$table  = $this->getTable('homebanner/homebanner_store');
		$insert = array_diff($newStores, $oldStores);
		$delete = array_diff($oldStores, $newStores);

		if ($delete) {
			$where = array(
				'homebanner_id = ?'     => (int) $object->getId(),
				'store_id IN (?)' => $delete
			);
			
			$this->_getWriteAdapter()->delete($table, $where);
		}

		if ($insert) {
			$data = array();

			foreach ($insert as $storeId) {
				$data[] = array(
					'homebanner_id'  => (int) $object->getId(),
					'store_id' => (int) $storeId
				);
			}

			$this->_getWriteAdapter()->insertMultiple($table, $data);
		}

		return parent::_afterSave($object);				
	}
	
	protected function _afterLoad(Mage_Core_Model_Abstract $object) {
		if ($object->getId()) {
			$stores = $this->lookupStoreIds($object->getId());
			$object->setData('store_id', $stores);
		}
		return parent::_afterLoad($object);
	}
	
	public function lookupStoreIds($dealer_id) {
		$adapter = $this->_getReadAdapter();
		
		$select  = $adapter->select()
				->from($this->getTable('homebanner/homebanner_store'), 'store_id')
				->where('homebanner_id = ?',(int)$dealer_id);

		return $adapter->fetchCol($select);
	}
	
}