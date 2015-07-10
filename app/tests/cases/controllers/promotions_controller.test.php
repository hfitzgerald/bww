<?php
/* Promotions Test cases generated on: 2011-04-27 14:04:06 : 1303915266*/
App::import('Controller', 'Promotions');

class TestPromotionsController extends PromotionsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PromotionsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.promotion');

	function startTest() {
		$this->Promotions =& new TestPromotionsController();
		$this->Promotions->constructClasses();
	}

	function endTest() {
		unset($this->Promotions);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>