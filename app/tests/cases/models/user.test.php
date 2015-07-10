<?php
App::import('Model', 'PromotionalChallenge');
App::import('Model', 'Challenge');
App::import('Model', 'User');
App::import('Model', 'Attempt');

class UserTestCase extends CakeTestCase {
	var $fixtures = array(
		'app.attempt', 
		'app.user',
		'app.challenge',
		'app.location',
		'app.promotional_challenge' 
	);

	// called before each test is run
	function startTest() {
		$this->User = &ClassRegistry::init('User');
	}

	function testSave() {
		/* check if user is in db and delete if so */
		$user_already_exists = $this->User->hasAny(array('User.id' => '635242'));
		
		if($user_already_exists) {
			$this->User->delete(635242, false);
		}
		
		$user = $this->User->apiLookup(635242);
		$result_from_save = $this->User->save($user);
		$attempt_was_saved = !(is_null($result_from_save) || ($result_from_save == false));	
		
		$this->assertTrue(
			$attempt_was_saved,
			'User model was unable to save scvngr data, check that beforeSave is handling data correctly'
		);
	}
	
	function testAttemptsAreAssociated() {
		$results = $this->User->findById(241213);
		$this->assertNotNull($results['Attempt'], 'Attempts are not correctly associated with users');
	}

	function testSaveAssociatedAttempt() {
		$this->User->read(null, 241213);
		$attempt = $this->User->data['Attempt'][0];
		$this->User->Attempt->delete($attempt['id'], false);
		
		$this->User->read(null, 241213);
		$after_delete_count = count($this->User->data['Attempt']);
		$this->User->Attempt->save($attempt);
		
		$this->User->read(null, 241213);
		$after_add_count = count($this->User->data['Attempt']);
		
		$this->assertEqual($after_delete_count + 1, $after_add_count, 'Was not able to save associated attempt from user');
	}

	function testTopTen() {
		$result = $this->User->topTen();
		
		debug($result);		
	}
	
	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}
}
