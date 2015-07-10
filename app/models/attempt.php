<?php
class Attempt extends AppModel {
	var $name = 'Attempt'; 
	/* The Associations below have been created with all possible keys, those that are not needed can be removed */

	var $belongsTo = array(
		'Challenge' => array(
			'className' => 'Challenge',
			'foreignKey' => 'challenge_id',
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
		),
		'Week' => array(
			'className' => 'Week',
			'foreignKey' => 'week_id'
		)
	);

	/* model functions */
	function updatePointsCount(){
		$this->bindModel(array(
			'belongsTo' => array(
				'User' => array(
					'foreignKey' => false,
					'conditions' => array('User.id = Attempt.user_id')
				),
				'Location' => array(
					'foreignKey' => false,
					'conditions' => array('Location.id = Attempt.location_id')
				),
				'Challenge' => array(
					'foreignKey' => false,
					'conditions' => array('Challenge.id = Attempt.challenge_id')
				),
				'PromotionalChallenge' => array(
					'foreignKey' => false,
					'conditions' => array('PromotionalChallenge.id = Challenge.promotional_challenge_id')
				),
				'Week' => array(
					'foreignKey' => false,
					'conditions' => array('Week.id = Attempt.week_id')
				),
				'WeeklyLocationTotal' => array(
					'foreignKey' => false,
					'conditions' => array('WeeklyLocationTotal.week_id = Attempt.week_id', 'WeeklyLocationTotal.location_id = Attempt.location_id')
				),
				'WeeklyUserTotal' => array(
					'foreignKey' => false,
					'conditions' => array('WeeklyUserTotal.week_id = Attempt.week_id', 'WeeklyUserTotal.user_id = Attempt.user_id')
				),
				'WeeklyPromotionalChallengeTotal' => array(
					'foreignKey' => false,
					'conditions' => array('WeeklyPromotionalChallengeTotal.week_id = Attempt.week_id', 'WeeklyPromotionalChallengeTotal.promotional_challenge_id = Attempt.promotional_challenge_id')
				))
			), true
		);
		
		$models = $this->find('first', array(
			'conditions' => array('Attempt.id' => $this->id),
			'contain' => array('User', 'Location', 'Challenge', 'PromotionalChallenge', 'Week', 'WeeklyLocationTotal', 'WeeklyUserTotal', 'WeeklyPromotionalChallengeTotal')
		));
		
		$week_id = $models['Attempt']['week_id'];
		$points_to_add = $models['Attempt']['points'];
		$models['User']['location_id'] = $models['Location']['id']; // associate the user with the location that they have last competed from
		
		$this->User->set($models['User']);
		$this->PromotionalChallenge->set($models['PromotionalChallenge']);
		$this->Location->set($models['Location']);
						
		/* update points count if this is not an untracked challenge */		
		if($this->PromotionalChallenge->id != 15){
			$this->User->addPoints($week_id, $points_to_add);
			$this->PromotionalChallenge->addPoints($week_id, $points_to_add);
			$this->Location->addPoints($week_id, $points_to_add);
			$this->WeeklyUserTotal->createRecordOrUpdatePoints($models);
			$this->WeeklyPromotionalChallengeTotal->createRecordOrUpdatePoints($models);
			$this->WeeklyLocationTotal->createRecordOrUpdatePoints($models);
		}
	}
	
	function insertFromApi($user, $challenge, $attempt, $timestamp){
		$this->Challenge->saveIfNonExistant($challenge['id'], $challenge);
		$this->User->saveIfNonExistant($user['id'], $user);
		
		$result = $this->_insertParsed(
			$attempt['id'], 
			$this->User->id, 
			$this->Challenge->id,
			$this->Location->id, 
			$this->Challenge->data['Challenge']['promotional_challenge_id'],
			$attempt['points'],
			$timestamp
		);
		
		/* don't update points if the attempt was not successfully saved */
		if($result != false){
			return $this->updatePointsCount();
		} else {
			return false;
		}
	}
	
	private function _insertParsed($id, $user_id, $challenge_id, $location_id, $promotional_challenge_id, $points, $timestamp){
		/* if promotional_challenge id is null, set it to 15 */
		$untracked_challenge = false;
		if(is_null($promotional_challenge_id)){
			$untracked_challenge = true;
			$promotional_challenge_id = 15;
		}
		
		$week = $this->Week->getByDate($timestamp);
		$this->Week->set($week['Week']);
			
		$this->set(
			array(
				'id' => $id,
				'user_id' => $user_id,
				'location_id' => $location_id,
				'challenge_id' => $challenge_id,
				'promotional_challenge_id' => $promotional_challenge_id,
				'week_id' => $week['Week']['id'],
				'points' => $points,
				'created' => $timestamp
			)
		);
		
		if(!$this->exists()) {
			return $this->save();
		} else {
			return false;
		}
	}
	
	function getTotalCount(){
		$total = $this->query("SELECT count(id) as total FROM attempts");
		$total = intval($total[0][0]['total']);
		if($total < 10000)
			return number_format($total,0,null,",") . ' Challenges';
		else
			return floor($total / 1000) . "K Challenges";
	}
	
	function afterSave($created){
		if($created && ($this->data['Attempt']['promotional_challenge_id'] != 15)){		
			$this->updatePointsCount();
		}
	}
}
?>
