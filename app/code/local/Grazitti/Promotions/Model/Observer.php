<?php
 
class Grazitti_Promotions_Model_Observer {
    
	public function customerRegisterSuccess(Varien_Event_Observer $observer) 
	{
		$enable = Mage::getStoreConfig('grazitti/general/enable');
		$confirmation = Mage::getStoreConfig('customer/create_account/confirm');	
		/* check module is enable and confirmation is not required */
		if($enable && !$confirmation)
		{		
			$customer    = $observer->getEvent()->getCustomer();
			$customerName =  $customer->getname();
			$customerEmail = $customer->getEmail();
			$PromotionCode= $this->generateCode(); 
			$this->sendTransactionalEmail($customerEmail,$customerName,$PromotionCode);		
			
		}
	}
	 public function customerSaveAfter(Varien_Event_Observer $observer)
	{
		 $enable = Mage::getStoreConfig('grazitti/general/enable');
		$confirmation = Mage::getStoreConfig('customer/create_account/confirm');
		
		if($enable && $confirmation)
		{
	        $customerData    = $observer->getEvent()->getCustomer();
			$customerName =  $customerData->getname();
			$customerEmail = $customerData->getEmail();
			$PromotionCode= $this->generateCode();  
	        $this->sendTransactionalEmail($customerEmail,$customerName,$PromotionCode);
		    
		} 
	}
    Public function generateCode()
    {
			/* Coupon Generate Code */
			$generator   = new Grazitti_Promotions_Model_Massgenerator();
			$days = Mage::getStoreConfig('grazitti/general/days');
			$currentdate = new Zend_Date(Mage::getModel('core/date')->timestamp());
			$currentdate->addDay($days);
			$currentdate->toString('Y-m-d H:i:s'); //Returns representation of date 
			$ruleId = Mage::getStoreConfig('grazitti/general/rules');
			
			$data = array(
			'max_probability'   => .25,
			'max_attempts'      => 10,
			'uses_per_customer' => 1,
			'uses_per_coupon'   => 1,
			'qty'               => 1, //number of coupons to generate
			'length'            => 14, //length of coupon string
			'to_date'           => $currentdate, //ending date of generated promo
			'format'            => Mage_SalesRule_Helper_Coupon::COUPON_FORMAT_ALPHANUMERIC,
			'rule_id'           => $ruleId //the id of the rule you will use as a template
		);
			$generator->validateData($data);
			$generator->setData($data);
			$couponCode = $generator->generatePool(); 
			return $couponCode;
	}
    public function sendTransactionalEmail($customerEmail,$customerName,$PromotionCode)
    {
            // set the Transactional Email Template's ID that you've created...
            $emailtemplate = Mage::getStoreConfig('grazitti/general/template');
			/*check test and live mode */
			$modevalue = Mage::getStoreConfig('grazitti/general/mode');
			$testemail = Mage::getStoreConfig('grazitti/general/email');
			
			if($modevalue)
			{
				$recepientEmail = $testemail; 
			}else{
				$recepientEmail = $customerEmail; 
			}
			
			$templateId = $emailtemplate;
            // Set sender information
            $senderName = Mage::getStoreConfig('trans_email/ident_support/name');
            $senderEmail = Mage::getStoreConfig('trans_email/ident_support/email');
            $sender = array('name' => $senderName,
                           'email' => $senderEmail); 
			// Set recepient information         
		     $recepientName = $customerName;       
		 
            // Set variables that can be used in email template. To get this variable write like {{var customerEmail}} in transactional Email.
            $vars = array('coupon code' => $PromotionCode);
            $translate  = Mage::getSingleton('core/translate');
            // Send Transactional Email
            Mage::getModel('core/email_template')->sendTransactional($templateId, $sender, $recepientEmail, $recepientName, $vars);
       
            $translate->setTranslateInline(true);
				
			
    } 
}
        
