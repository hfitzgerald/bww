<?php

App::import('Model', 'Challenge');
class ChallengeTestCase extends CakeTestCase {
	var $fixtures = array('app.challenge');
	
	function startTest(){
		$this->Challenge =& ClassRegistry::init('Challenge');
	}
	
	function testSave(){}
	
	function endTest(){}
}
