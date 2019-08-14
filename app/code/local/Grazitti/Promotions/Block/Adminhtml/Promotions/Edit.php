<?php

class Grazitti_Promotions_Block_Adminhtml_Promotions_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'promotions';
        $this->_controller = 'adminhtml_promotions';
        
        $this->_updateButton('save', 'label', Mage::helper('promotions')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('promotions')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('promotions_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'promotions_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'promotions_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('promotions_data') && Mage::registry('promotions_data')->getId() ) {
            return Mage::helper('promotions')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('promotions_data')->getTitle()));
        } else {
            return Mage::helper('promotions')->__('Add Item');
        }
    }
}