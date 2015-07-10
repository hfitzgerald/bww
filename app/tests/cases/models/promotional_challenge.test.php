<?php
	/**
	* 
	*/
    App::import('Model', 'ScvngrModel');
	App::import('Model', 'PromotionalChallenge');
    App::import('Model', 'Challenge');
	App::import('Model', 'Attempt');

	class PromotionalChallengeTestCase extends CakeTestCase {
		var $fixtures = array('app.promotional_challenge', 'app.challenge', 'app.attempt');
		
        /**
         * Count tests --
         * the following tests ensure that this model is correctly keeping/reporting the 
         * number of attempts and points associated with it.
         * */

        function testChallengesAreAssociated() {
            $this->PromotionalChallenge =& ClassRegistry::init('PromotionalChallenge');
            $result = $this->PromotionalChallenge->find('first', array('conditions' => array('PromotionalChallenge.id' => 1)));
 
            $this->assertTrue(
                is_array($result['Challenge']),
                'Test failed: Challenges are not correctly associated with PromotionalChallenges'
            );
        }

        function testAttemptsAreAssociated() {
            $this->PromotionalChallenge =& ClassRegistry::init('PromotionalChallenge');
            $result = $this->PromotionalChallenge->getAssociatedChallengesAndAttemptsById(1);
            
            $this->assertTrue(
            	is_array($result['Challenge'][0]['Attempt']),
				'Test failed: function getAssociatedChallengesAndAttemptsById() did not return any associated attempts'
			);
        }

        /**
         * Count tests 
         *
         * the following tests ensure that this model is correctly keeping/reporting the 
         * number of attempts and points associated with it.
         * */
                

	}
?>
