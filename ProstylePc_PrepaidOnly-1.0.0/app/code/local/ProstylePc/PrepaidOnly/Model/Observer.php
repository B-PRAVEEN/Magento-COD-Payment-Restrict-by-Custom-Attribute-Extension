<?php
 
class ProstylePc_PrepaidOnly_Model_Observer
{
    public function prepaidonly(Varien_Event_Observer $observer)
    {
       $event           = $observer->getEvent();
       $method          = $event->getMethodInstance();
       $result          = $event->getResult();
       $prepaidonly     = false;
 
        foreach (Mage::getSingleton('checkout/cart')->getQuote()->getAllVisibleItems() as $item)
        {
            if($item->getProduct()->getPrepaidOnly()){
                 $prepaidonly = true;
            }
        }
 
        if($method->getCode() == "phoenix_cashondelivery" && $prepaidonly){
            $result->isAvailable = false;
        }
 
    }
}