<?php

class Grazitti_Promotion_Model_Promotion extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('promotion/promotion');
    }
}