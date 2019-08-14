<?php

class Grazitti_Promotions_Model_Mysql4_Promotions_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('promotions/promotions');
    }
}