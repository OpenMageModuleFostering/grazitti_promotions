<?php

class Grazitti_Promotions_Block_Adminhtml_Promotions_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('promotions_form', array('legend'=>Mage::helper('promotions')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('promotions')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('promotions')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('promotions')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('promotions')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('promotions')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('promotions')->__('Content'),
          'title'     => Mage::helper('promotions')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getPromotionsData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getPromotionsData());
          Mage::getSingleton('adminhtml/session')->setPromotionsData(null);
      } elseif ( Mage::registry('promotions_data') ) {
          $form->setValues(Mage::registry('promotions_data')->getData());
      }
      return parent::_prepareForm();
  }
}