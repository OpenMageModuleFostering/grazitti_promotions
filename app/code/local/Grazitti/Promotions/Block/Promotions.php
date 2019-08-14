<?php
class Grazitti_Promotions_Block_Promotions extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getPromotions()     
     { 
        if (!$this->hasData('promotions')) {
            $this->setData('promotions', Mage::registry('promotions'));
        }
        return $this->getData('promotions');
        
    }
}