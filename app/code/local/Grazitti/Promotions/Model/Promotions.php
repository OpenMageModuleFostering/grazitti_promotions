<?php

class Grazitti_Promotions_Model_Promotions extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('promotions/promotions');
    }
}