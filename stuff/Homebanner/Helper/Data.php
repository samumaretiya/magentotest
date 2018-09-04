<?php
class Dcs_Homebanner_Helper_Data extends Mage_Core_Helper_Abstract
{


		public function Checkdevice()
	{
		$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
		$mobile = strpos($_SERVER['HTTP_USER_AGENT'],"Mobile");
		$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
		$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
		$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
		if ($iphone || ($android && $mobile) || $palmpre || $ipod || $berry == true)
		{
			return 1;
		}
	}
	
	
	
	public function getSpecialProducts()
	{
		Mage::getSingleton('core/session', array('name' => 'frontend'));
		$_productCollection = Mage::getResourceModel('catalogsearch/advanced_collection')
		->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
		->addMinimalPrice()
		->addStoreFilter();
		
		Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($_productCollection);
		Mage::getSingleton('catalog/product_visibility')->addVisibleInSearchFilterToCollection($_productCollection);
		
		$todayDate = date('m/d/y');
		$tomorrow = mktime(0, 0, 0, date('m'), date('d'), date('y'));
		$tomorrowDate = date('m/d/y', $tomorrow);
		
		$_productCollection->addAttributeToFilter('special_from_date', array('date' => true, 'to' => $todayDate))
		->addAttributeToFilter('special_to_date', array('or'=> array(
		0 => array('date' => true, 'from' => $tomorrowDate),
		1 => array('is' => new Zend_Db_Expr('null')))
		), 'left');

		return $_productCollection;

	}
	
	
	/*public function getFeaturedProducts()
	{
		$collection = Mage::getModel('catalog/product')
		->getCollection()
		->addAttributeToFilter('visibility', array('neq' => 1))
		->addAttributeToFilter('status', array('eq' => 1))
		->addAttributeToFilter('elephant_featured', 1);
				return $collection;
	}*/
	
	public function getBestsellerProducts()
	{
		$collection = Mage::getModel('catalog/product')
		->getCollection()
		->addAttributeToFilter('visibility', array('neq' => 1))
		->addAttributeToFilter('status', array('eq' => 1))
		->addAttributeToFilter('elephant_bestseller', 1);
				return $collection;
	}
	
	public function isNewProductLogo($_product) {			
		$now = date("Y-m-d");
		$newsFrom= substr($_product->getData('news_from_date'),0,10);
		$newsTo=  substr($_product->getData('news_to_date'),0,10);		
		if(($now >= $newsFrom) && ($now <= $newsTo)){
			return true;
		}else{
			return false;
		}
    }

	
	public function isSaleProductLogo($_product) {			
		$now = date("Y-m-d");
		$specialFrom= substr($_product->getData('special_from_date'),0,10);
		$specialTo=  substr($_product->getData('special_to_date'),0,10);
		if((($now >= $specialFrom) && ($now <= $specialTo) || ($_product->special_price !== null) || ($_product->_rule_price !== null))){
			return true;
		}else{
			return false;
		}
    }
	
	public function isProductLabelLogo($_product) {
		
		$collectionimage = Mage::getModel('productlabel/productlabel')
						->getCollection()->addFieldToFilter('attribute_option_id', $_product->getProductLabelImage())
						->addFieldToFilter('filename', array('neq' => ''))
						->getFirstItem();
		$small_label = $collectionimage->getFilename();
		if($small_label)
		{
			$array = array();
			$array['logo'] = $collectionimage->getFilename();
			$array['title'] = $collectionimage->getTitle();
			return $array;
			
		}
		else
		{
			return false;
		}
		
	}
	
	/*public function getBestsellerProducts()
	{
		$storeId    = Mage::app()->getStore()->getId();
		$products = Mage::getResourceModel('reports/product_collection')
				->addOrderedQty()
				->addUrlRewrite()
				->addAttributeToSelect(array('name', 'price', 'thumbnail', 'short_description','image','small_image','url_key'), 'inner')
				->addAttributeToFilter('status','1')
				->setStoreId($storeId)
				->addStoreFilter($storeId)
				->setOrder('ordered_qty', 'desc');		

		Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
		Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);
		return $products; 
	}*/

	public function getNewarrivalProducts()
	{
		$todayDate = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
		$collection = Mage::getModel('catalog/product')
		->getCollection()
		->addAttributeToFilter('visibility', array('neq' => 1))
		->addAttributeToFilter('status', array('eq' => 1))
		->addAttributeToFilter('news_from_date', array('date' => true, 'to' => $todayDate))
		->addAttributeToFilter('news_to_date', array('or'=> array(
		0 => array('date' => true, 'from' => $todayDate),
		1 => array('is' => new Zend_Db_Expr('null')))
		), 'left')
		->addAttributeToSort('news_from_date', 'desc')
		->addAttributeToSort('created_at', 'desc'); 
		return $collection;
	  }
	
	

}