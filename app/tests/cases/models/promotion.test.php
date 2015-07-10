<?php
/* Promotion Test cases generated on: 2011-04-25 13:04:51 : 1303739691*/
App::import('Model', 'Promotion');

class PromotionTestCase extends CakeTestCase {
	var $fixtures = array('app.promotion', 'app.location', 'app.promotional_challenge', 'app.challenge', 'app.attempt');

	function startTest() {
		$this->Promotion =& ClassRegistry::init('Promotion');
		$this->Location =& ClassRegistry::init('Location');
	}

	function testActive() {
		$this->assertTrue($this->Promotion->hasStarted(), 'hasStarted returned false');
		$this->assertTrue(!$this->Promotion->hasEnded(), 'hasEnded returned true');
		$this->assertTrue($this->Promotion->isActive(), 'promotion did not return active => true');
	}
	
	function testIncrementalUpdate(){
		$this->Location->updateFromNewStreamItems();
	}

	function endTest() {
		unset($this->Promotion);
		ClassRegistry::flush();
	}

    function testTotalAttempts() {
        $result = $this->Promotion->updateAttemptCount();
        
    }
	

}
?>