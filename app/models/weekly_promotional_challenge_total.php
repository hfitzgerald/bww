<?php
class WeeklyPromotionalChallengeTotal extends AppModel {
	var $name = 'WeeklyPromotionalChallengeTotal';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Week' => array(
			'className' => 'Week',
			'foreignKey' => 'week_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PromotionalChallenge' => array(
			'className' => 'PromotionalChallenge',
			'foreignKey' => 'promotional_challenge_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
			
	function createRecordOrUpdatePoints($data){
		echo var_export($data);
		/* see if weekly totals already have an entry */
		if(is_null($data['WeeklyPromotionalChallengeTotal']['id'])){
			$this->newFromStream($data['PromotionalChallenge']['id'], $data['Week']['id'], $data['Attempt']['points']);
		} else {
			$this->set($data['WeeklyPromotionalChallengeTotal']);
			$this->updatePoints($data['Attempt']['points']);			
		}
	}
		
	function newFromStream($id, $week_id, $points_to_add){
		/**
		 * Make doubly sure that this isn't a duplicate
		 **/
		$exists = $this->find('first', array(
			'conditions' => array(
				'WeeklyPromotionalChallengeTotal.promotional_challenge_id' => $id,
				'WeeklyPromotionalChallengeTotal.week_id' => $week_id
			)
		));

		if($exists == false){
			$data = array(
				'promotional_challenge_id'  => $id,
				'week_id'	  				=> $week_id,
				'points'	  				=> $points_to_add
			);
			
			$this->create();
			$this->set($data);
			$this->save();
		} else {

			$this->set($exists);
			$this->updatePoints($points_to_add);
		}
	}
	
	function updatePoints($points){
		if(is_null($this->id)) return false;
		
		$new_point_total = $this->data['WeeklyPromotionalChallengeTotal']['points'] + $points;
		$this->set('points', $new_point_total);
		$this->save();
	}
}
?>