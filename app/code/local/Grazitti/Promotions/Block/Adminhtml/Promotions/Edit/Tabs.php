<?php

class Grazitti_Promotions_Block_Adminhtml_Promotions_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('promotions_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('promotions')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('promotions')->__('Item Information'),
          'title'     => Mage::helper('promotions')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('promotions/adminhtml_promotions_edit_tab_form')->toHtml(),
      ));
     $this->addTab('form_section1', array(
         'label'     => Mage::helper('promotions')->__('Customers'),
         'title'     => Mage::helper('promotions')->__('Customers'),
         'url'       => $this->getUrl('*/*/customer', array('_current' => true)),
         'class'     => 'ajax',
      ));

      return parent::_beforeToHtml();
  }
}