<?php
class Grazitti_Promotions_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/promotions?id=15 
    	 *  or
    	 * http://site.com/promotions/id/15 	
    	 */
    	/* 
		$promotions_id = $this->getRequest()->getParam('id');

  		if($promotions_id != null && $promotions_id != '')	{
			$promotions = Mage::getModel('promotions/promotions')->load($promotions_id)->getData();
		} else {
			$promotions = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($promotions == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$promotionsTable = $resource->getTableName('promotions');
			
			$select = $read->select()
			   ->from($promotionsTable,array('promotions_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$promotions = $read->fetchRow($select);
		}
		Mage::register('promotions', $promotions);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}