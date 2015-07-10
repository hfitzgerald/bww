<?php
class LocationsController extends AppController {

	var $name = 'Locations';
	
	function admin_index($week_number = null) {
		/*
		 * Properties for rendering
		 */
		$this->layout = 'admin';
		
		/*
		 * Load the necessary models
		 */
		$this->loadModel('Week');
		$number_of_weeks = Configure::read('Promotion.number_of_weeks');
		
		if(is_null($week_number)){
			$active_week = $this->Week->getActive();
			$week_number = $active_week['Week']['week_number'];
		} else {
			$active_week = $this->Week->getByNumber($week_number);
		}

		$this->set('week', $active_week);
		$this->set('number_of_weeks', $number_of_weeks);
		$this->set('users', $this->Week->getTopUsers($week_number, 10));
		$this->set('challenges', $this->Week->getTopChallenges($week_number, 10));
		$this->set('locations', $this->Week->getTopLocations($week_number, 10));
	}
}
?>