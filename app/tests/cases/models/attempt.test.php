<?php
    App::import('Model', 'Challenge');
	App::import('Model', 'User');
    App::import('Model', 'Attempt');

	class AttemptTestCase extends CakeTestCase {
		var $fixtures = array('app.attempt', 'app.promotion', 'app.user', 'app.challenge', 'app.promotional_challenge', 'app.location');
		
		function startTest(){
			$this->Attempt =& ClassRegistry::init('Attempt');
			$this->User =& ClassRegistry::init('User');
		}
		
		function testAssociationsExist(){
			$this->assertNotNull($this->User, 'User model was not loaded for test');
			$this->assertNotNull($this->User->Attempt, 'user->attempt association does not exist');
		}
		
		function testCanSaveAndUpdateCounts(){
			$this->User->read(null, 214384);
			$this->assertNotNull($this->User->data, 'User id chosen for this test does not exist in table');
			$initial_points = $this->User->field('total_points');
			
			// test that $this->User->Attempt->save() works
			$this->Attempt->data = array(
				'Attempt' => array(
					'id' => 2041503,
					'challenge_id' => 567187,
					'location_id' => 152913,
					'promotional_challenge_id' => 3,
					'user_id' => 635242,
					'points' => 5
				)
			);
			
			$result_from_save = $this->Attempt->save();
			$attempt_was_saved = !(is_null($result_from_save) || ($result_from_save == false));
			
			$this->assertTrue($attempt_was_saved, 'SCVNGR data was not correctly handled by the attempt->save function');

			//check for updated count
			$points_after_update = $this->User->field('total_points');
			$this->assertEqual(($initial_points + 5), $points_after_update, 'User Points did not update after an attempt was inserted');
			

		}
	}
