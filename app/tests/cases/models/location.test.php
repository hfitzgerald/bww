<?php
/* Location Test cases generated on: 2011-03-25 20:03:52 : 1301086312*/
App::import('Model', 'Location');
class LocationTestCase extends CakeTestCase {
	var $fixtures = array('app.location', 'app.promotion', 'app.challenge', 'app.promotional_challenge', 'app.attempt', 'app.user');

	function startTest() {
		$this->Location =& ClassRegistry::init('Location');
	}
	
	function testSave(){
		$this->Location->id = 4333155;
		
		if($this->Location->exists()){
			$this->Location->delete(4333155, false);
		}
		
		$this->assertTrue($this->Location->apiLookup(4333155, true), "Location model was unable to save the json object returned from scvngr");
	}
	
	function testUpdateFromNewStreamItems(){
		$this->Location->updateFromNewStreamItems(4333155);
		$this->Location->id = 4333155;
		$this->Location->read(null, 4333155);
	}
	
	function endTest() {
		unset($this->Location);
		ClassRegistry::flush();
	}

}
?>