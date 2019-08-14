<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2015 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Shopping Cart Price Rule General Information Tab
 *
 * @category Mage
 * @package Mage_Adminhtml
 * @author Magento Core Team <core@magentocommerce.com>
 */
class Grazitti_Promotion_Block_Adminhtml_Promo_Quote_Edit_Tab_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Prepare content for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('salesrule')->__('Individual Discount');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('salesrule')->__('Rule Information');
    }

    /**
     * Returns status flag about this tab can be showed or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }

    public function __construct()
    {
        parent::__construct();
        $this->setId('customer_Grid');
        $this->setUseAjax(true);
        $this->setDefaultSort('entity_id');
        $this->setSaveParametersInSession(false);
    }

    protected function _prepareCollection()
{
    $collection = Mage::getResourceModel('customer/customer_collection')
        ->addNameToSelect()
        ->addAttributeToSelect('email')
        ->addAttributeToSelect('created_at')
        ->addAttributeToSelect('group_id')
        ->addAttributeToSelect('customer_id')
        ->joinAttribute('billing_postcode', 'customer_address/postcode', 'default_billing', null, 'left')
        ->joinAttribute('billing_city', 'customer_address/city', 'default_billing', null, 'left')
        ->joinAttribute('billing_telephone', 'customer_address/telephone', 'default_billing', null, 'left')
        ->joinAttribute('billing_region', 'customer_address/region', 'default_billing', null, 'left')
        ->joinAttribute('billing_country_id', 'customer_address/country_id', 'default_billing', null, 'left');

    $this->setCollection($collection);
//echo '<pre>';print_r($collection);
    return Mage_Adminhtml_Block_Widget_Grid::_prepareCollection();
}
  protected function _prepareColumns()
    {
		$this->addColumn('in_products', array(
                'header_css_class'  => 'a-center',
                'type'              => 'checkbox',
                'name'              => 'customer',
                'values'            => $this->_getSelectedCustomers(),
                'align'             => 'center',
                'index'             => 'entity_id'               
));
		$this->addColumn('entity_id', array(
            'header'    => Mage::helper('customer')->__('ID'),
            'width'     => '50px',
            'index'     => 'entity_id',
            'type'  => 'number',
        ));
        
        $this->addColumn('name', array(
            'header'    => Mage::helper('customer')->__('Name'),
            'index'     => 'name'
        ));
        $this->addColumn('email', array(
            'header'    => Mage::helper('customer')->__('Email'),
            'width'     => '150',
            'index'     => 'email'
        ));

        $groups = Mage::getResourceModel('customer/group_collection')
            ->addFieldToFilter('customer_group_id', array('gt'=> 0))
            ->load()
            ->toOptionHash();

        $this->addColumn('group', array(
            'header'    =>  Mage::helper('customer')->__('Group'),
            'width'     =>  '100',
            'index'     =>  'group_id',
            'type'      =>  'options',
            'options'   =>  $groups,
        ));

        $this->addColumn('Telephone', array(
            'header'    => Mage::helper('customer')->__('Telephone'),
            'width'     => '100',
            'index'     => 'billing_telephone'
        ));

        $this->addColumn('billing_postcode', array(
            'header'    => Mage::helper('customer')->__('ZIP'),
            'width'     => '90',
            'index'     => 'billing_postcode',
        ));

        $this->addColumn('billing_country_id', array(
            'header'    => Mage::helper('customer')->__('Country'),
            'width'     => '100',
            'type'      => 'country',
            'index'     => 'billing_country_id',
        ));

        $this->addColumn('billing_region', array(
            'header'    => Mage::helper('customer')->__('State/Province'),
            'width'     => '100',
            'index'     => 'billing_region',
        ));

        $this->addColumn('customer_since', array(
            'header'    => Mage::helper('customer')->__('Customer Since'),
            'type'      => 'datetime',
            'align'     => 'center',
            'index'     => 'created_at',
            'gmtoffset' => true
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('website_id', array(
                'header'    => Mage::helper('customer')->__('Website'),
                'align'     => 'center',
                'width'     => '80px',
                'type'      => 'options',
                'options'   => Mage::getSingleton('adminhtml/system_store')->getWebsiteOptionHash(true),
                'index'     => 'website_id',
            ));
        }
        return parent::_prepareColumns();
    }
	  // protected function _prepareMassaction()
    // {
        // $this->setMassactionIdField('entity_id');
        // $this->getMassactionBlock()->setFormFieldName('customer');

        // $this->getMassactionBlock()->addItem('delete', array(
             // 'label'    => Mage::helper('customer')->__('Delete'),
             // 'url'      => $this->getUrl('*/*/massDelete'),
             // 'confirm'  => Mage::helper('customer')->__('Are you sure?')
        // ));

        
      

        // return $this;
    //}
	protected function _addColumnFilterToCollection($column)
    {
        // Set custom filter for in product flag
        if ($column->getId() == 'in_products') {
            $productIds = $this->_getSelectedCustomers();
            if (empty($productIds)) {
                $productIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('entity_id', array('in'=>$productIds));
            } else {
                if($productIds) {
                    $this->getCollection()->addFieldToFilter('entity_id', array('nin'=>$productIds));
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }

	protected function _getSelectedCustomers()   // Used in grid to return selected customers values.
    {
        $customers = array_keys($this->getSelectedCustomers());
        return $customers;
    }
	
    public function getSelectedCustomers()
    {
        // Customer Data
        $tm_id = $this->getRequest()->getParam('id');
        if(!isset($tm_id)) {
            $tm_id = 0;
        }
        $customers = array(1,2); // This is hard-coded right now, but should actually get values from database.
        $custIds = array();
 
        foreach($customers as $customer) {
            foreach($customer as $cust) {
                $custIds[$cust] = array('position'=>$cust);
            }
        }
        return $custIds;
    }

    public function getGridUrl()
    {
	 
	return $this->getUrl('adminhtml/indpromotions/grid', array('_current'=> true));
    
	}

     
}
