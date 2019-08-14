<?php

class Grazitti_Promotions_Model_Mysql4_Promotions extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the promotions_id refers to the key field in your database table.
        $this->_init('promotions/promotions', 'promotions_id');
    }
}