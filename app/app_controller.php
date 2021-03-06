<?php
/**
 * Base app controller, all your controllers inherit this class
 * 
 * @author		  rynop and the paypal IPN pieces are thanks to webtechnick's example
 * @link          http://rynop.com, http://github.com/webtechnick/CakePHP-Paypal-IPN-Plugin
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class AppController extends Controller {

	var $helpers = array('Html', 'Form', 'Session', 'Asset.asset');
	var $components = array(
		'Session',
	   	'DebugKit.Toolbar' => array('panels' => array('history' => 10))
	);	

	/**
	 * Want to use 
	 * This is called by the paypal plugin after payment has been received
	 *
	 * @param string paypal transaction id
	 */
	function afterPaypalNotification($txnId){
		$paypal =& ClassRegistry::init('PaypalIpn.InstantPaymentNotification');
				
		$transaction = $paypal->findById($txnId);
		$paypal->id = $txnId;
		$paypal->saveField('site_id', $this->getSiteId());
		
		$this->log('IPN for txn: '.$txnId, 'paypal');

		//Tip: be sure to check the payment_status is complete because failure
		//     are also saved to your database for review.
		switch ($transaction['InstantPaymentNotification']['payment_status']) {
			case 'Completed': case 'Pending':
				$this->log($transaction['InstantPaymentNotification']['id'].' was SUCCESSFUL', 'paypal');	
				//Do work son
			break;
			
			default:
				$this->log($transaction['InstantPaymentNotification']['id'].' FAILURE!! Payment status: '.$transaction['InstantPaymentNotification']['payment_status'], 'paypal');
				//There was a problem
				$this->paypalTransactionError($transaction);
			break;
		}
	}
	
	function paypalTransactionError($transaction){
		debug('Transaction details: '.$transaction);
	}	
	
	function getTotalAttempts(){
		$this->loadModel('Promotion');
		$attempts = $this->Promotion->find('first', array('fields'=>'total_attempts'));
		$total = $attempts['Promotion']['total_attempts'];
		if($total < 10000)
			return number_format($total,0,null,",");
		else
			return floor($total / 1000) . "K";
	}

}
?>