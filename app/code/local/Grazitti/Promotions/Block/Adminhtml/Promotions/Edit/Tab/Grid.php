<?php 
class Grazitti_Promotions_Block_Adminhtml_Promotions_Edit_Tab_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
public function __construct()
    {
        parent::__construct();
     $this->setId('indpromotionsGrid');
        $this->setUseAjax(true);
        //$this->setDefaultSort('entity_id');
        $this->setSaveParametersInSession(true);
    }
    protected function _prepareCollection()
    {
        /*Prepare collection that you want to show on the grid. I have commented it because I don't have
         any table or collection. You will be uncommenting it to set collection on your grid.
       */
        $collection = Mage::getResourceModel('customer/customer_collection');
 
        $this->setCollection($collection);
 
        return parent::_prepareCollection();
    }
 
    /**
    * This method will create columns
    */
    protected function _prepareColumns()
    {
       // Code for your grid here.
        $this->addColumn('created_at', array(
            'header' => Mage::helper('salesrule')->__('Created On'),
            'index'  => 'created_at',
            'type'   => 'datetime',
            'align'  => 'center',
            'width'  => '160'
        )); 
 
        return parent::_prepareColumns();
    }

	}
?>