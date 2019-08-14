<?php
class Grazitti_Promotions_Block_Adminhtml_Promotions extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_promotions';
    $this->_blockGroup = 'promotions';
    $this->_headerText = Mage::helper('promotions')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('promotions')->__('Add Item');
    parent::__construct();
  }
}