<?php

class Dcs_Homebanner_Model_Observer {

    public function paymentMethodIsActive(Varien_Event_Observer $observer) {
        $event           = $observer->getEvent();
        $method          = $event->getMethodInstance();
        $result          = $event->getResult();

        if(!Mage::getSingleton('customer/session')->isLoggedIn()){
            if($method->getCode() == 'checkmo')
                $result->isAvailable = false; 
        }else{
	    $customer = Mage::getSingleton('customer/session')->getCustomer();
	    $orders = Mage::getResourceModel('sales/order_collection')->addFieldToSelect('*')->addFieldToFilter('customer_id', $customer->getId());
	    $firstOrder = $orders->getSize();
	    if(!$firstOrder){
		if($method->getCode() == 'checkmo')
                $result->isAvailable = false; 
	    }
	}
    }
	
	
	
	public function hookToControllerActionPostDispatch($observer)
    {
        switch ($observer->getEvent()->getControllerAction()->getFullActionName())
		{            
            case 'cms_index_noRoute':
                header("HTTP/1.1 301 Moved Permanently");
                header("Location:" . Mage::getBaseUrl());
                exit;
                break;
        }
    }
	
	
}

