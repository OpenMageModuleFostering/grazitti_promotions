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
 * Used in creating options for Yes|No config value selection
 *
 */
class Grazitti_Promotions_Model_System_Config_Source_salerules
{

    /**
     * Options getter
     *
     * @return array
     */
   /*  public function toOptionArray()
    {
        
		$rulesCollection = Mage::getModel('salesrule/rule')->getCollection();
		foreach($rulesCollection as $rule)
		{
		$name = $rule->getname();
		}
		
		return array(
            array('value' => 1, 'label'=>Mage::helper('adminhtml')->__('Yes23')),
            array('value' => 0, 'label'=>Mage::helper('adminhtml')->__('No')),
        );
    }
 */
public function toOptionArray()
{
   $rulesCollection = Mage::getModel('salesrule/rule')->getCollection()
   ->addFieldToSelect('name')
   ->addFieldToSelect('rule_id')
   ->addFieldToFilter('is_active',1)
   ->getData();
	//echo'<pre>'; print_r($rulesCollection); die;
	$salesrule = array();
	if(!$rulesCollection){
		$salesrule[] = array(
		'label' => 'Please create shopping cart price rule',
        'value' => '-1'		
            );
	}else{
		foreach($rulesCollection as $rule)
		{
			$salesrule[] = array(
			'label' => $rule['name'],
			'value' => $rule['rule_id']		
				);
		}
    }
    return $salesrule; 

	
	}
}
