<?php
class Promotion extends AppModel {
	var $name = 'Promotion';
	var $displayField = 'name';

	/**
	* function nationalLeaderboard  
	*/
	function nationalLeaderboard() {
		if(is_null($this->PromotionalChallenge)) $this->PromotionalChallenge =& ClassRegistry::init('PromotionalChallenge');
		$data = array(
			'users' => $this->topUsersAndLocations(30),
			'challenges' => $this->PromotionalChallenge->topXAmount(30)
		);
		
		return($data);
	} 
	
	function facebookLeaderboard() {
		$data = array(
			'users' => $this->topUsersAndLocations(3)
		);
		
		return($data);
	} 

	function getStartDate(){
		$this->id = Configure::read('Promotion.id');;	
		$unformatted_date = $this->field('start_date');

		return date("Y-m-d H:i:s",  strtotime($unformatted_date));
	}
	
	function hasStarted(){
		$this->id = Configure::read('Promotion.id');;
		
		$start_date = $this->field('start_date'); 
		$current_date = strtotime('now');
		
		return ($start_date <= $current_date);
	}
	
	function hasEnded(){
		$this->id = Configure::read('Promotion.id');;
		
		$expiration_date = $this->field('end_date'); 
		$current_date = strtotime('now');
		
		return ($expiration_date >= $current_date);
	}
	
	function isActive(){
		return ($this->hasStarted() && !$this->hasEnded());
	}
	
	/**
	 * Updates footer / total challenges completed
	 */
	function updateAttemptCount(){
		if(is_null($this->Challenge)) $this->Challenge =& ClassRegistry::init('Challenge');
		$this->id = Configure::read('active_promotion_id');
		$total_attempts = $this->Challenge->Attempt->find('count', array('conditions'=>array('Attempt.promotional_challenge_id != 15')));
		$this->set(array('total_attempts'=>$total_attempts));
		$this->save();
	}
}
?>