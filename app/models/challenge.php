<?php
class Challenge extends AppModel {
	var $name = 'Challenge';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id'
		),
		'PromotionalChallenge' => array(
			'className' => 'PromotionalChallenge',
			'foreignKey' => 'promotional_challenge_id'
		)
	);

	var $hasMany = array(
		'Attempt' => array(
			'className' => 'Attempt',
			'foreignKey' => 'challenge_id',
			'dependent' => false
		)
	);

	function findPromotionalChallengeId(){
		/* untracked promotional challenge id = 15 */
		$this->PromotionalChallenge->recursive = -1;
		$promotional_challenge = $this->PromotionalChallenge->find('first', 
			array(
				'conditions' => array(
					'PromotionalChallenge.title' => strtolower($this->data['Challenge']['title'])
				), 
				'fields' => array(
					'PromotionalChallenge.id'
				)
			)
		);
		
		$untracked_challenge = !($this->data['Challenge']['promotional_challenge_id'] = $promotional_challenge['PromotionalChallenge']['id']);
		
		if($untracked_challenge){
			return 15;
		} 
		
		return $promotional_challenge['PromotionalChallenge']['id'];
	}
	
	/* Callbacks */
	function beforeSave(){
		$this->data['Challenge']['location_id'] = $this->Location->id;
		
		/* set promotional challenge id */
		$unset_promo_id = (!array_key_exists('promotional_challenge_id', $this->data['Challenge']) || is_null($this->data['Challenge']['promotional_challenge_id']));
		
		if($unset_promo_id){
			$this->data['Challenge']['promotional_challenge_id'] = $this->findPromotionalChallengeId();
		}
		
		return true;
	}
}
?>