<?php
class Week extends AppModel {
	var $name = 'Week';
	
	/**
	 * Retrieves the active week based on $date_str, if null it does so based on current time
	 *
	 * @return mixed 
	 * @access public
	 */
	function getActive() {
		$date = date('Y-m-d H:i:s');
		
		return $this->getByDate($date);
	}
	
	/*
	 * Convienience function to retrieve the active week number
	 * 
	 * function getActiveNumber
	 */	
	function getActiveNumber() {
		$week = $this->getActive();
		
		return $week['Week']['week_number'];
	}
	
	/*
	 * Parses Scvngr's timestamp string in order to remove fractional seconds (php doesn't like them)
	 * 
	 * function getByScvngrTimestamp
	 * @param $date_str
	 */
	function getByScvngrTimestamp($date_str) {
		$date_str = preg_replace('/\.[^.]+$/','', $date_str);		
		$date = date('Y-m-d H:i:s', strtotime($date_str));	// convert to date object for search
		
		return $this->getByDate($date);	
	}
	
	/*
	 * Retrieves a week based on the date parameter
	 * 
	 * function getByDate
	 * @param $date
	 */	
	function getByDate($date) {
		$result = $this->find('first', 
			array('conditions' => array(
  				"Week.start_date <" =>  $date,
  				"Week.end_date >" => $date
			)
		));
		
		$this->set($result);
		return $result;			
	}
	
	/*
	 * Retrieves a week based on its week_number value
	 * 
	 * function getByDate
	 * @param $week_number
	 */	
	function getByNumber($week_number){
		$result = $this->find('first', 
			array('conditions' => array(
  				"Week.week_number" =>  $week_number
			)
		));
		
		$this->set($result);
		return $result;	
	}
	
	/*
	 * Retrieves the specified number of users for the week passed in $week_number in order of decending points 
	 * 
	 * function getTopUsers
	 * @param $week_number
	 * @param $amount
	 */	
	function getTopUsers($week_number = null, $amount){
		if(is_null($week_number)){
			$week_number = $this->getActiveNumber();
		}
		
		$query = "SELECT 
					`Week`.`id`, 
					`Week`.`week_number`, 
					`Week`.`start_date`, 
					`Week`.`end_date`, 
					`WeeklyUserTotal`.`id`, 
					`WeeklyUserTotal`.`week_id`, 
					`WeeklyUserTotal`.`user_id`, 
					`WeeklyUserTotal`.`points`, 
					`User`.`id`, 
					`User`.`image_updated_at`, 
					`User`.`name`, 
					`User`.`image_url`, 
					`User`.`total_points`,
					`Location`.`id`, 
					`Location`.`state`, 
					`Location`.`city`, 
					`Location`.`modified`, 
					`Location`.`street_address`, 
					`Location`.`phone_number`,
					`Location`.`latitude`,
					`Location`.`longitude`,
					`Location`.`total_points`,
					`Location`.`zip_code`
				FROM `weeks` AS `Week` 
				LEFT JOIN `weekly_user_totals` AS `WeeklyUserTotal` ON (`WeeklyUserTotal`.`week_id` = `Week`.`id`) 
				LEFT JOIN `users` AS `User` ON (`User`.`id` = `WeeklyUserTotal`.`user_id`)
				LEFT JOIN `locations` AS `Location` ON (`Location`.`id` = `User`.`location_id`) 
				WHERE `Week`.`week_number` = $week_number
				AND WeeklyUserTotal.points > 0
				ORDER BY WeeklyUserTotal.points DESC
				LIMIT $amount";
				
		return $this->query($query);
	}
	
	/*
	 * Retrieves the specified number of Locations for the week passed in $week_number in order of decending points 
	 * 
	 * function getTopLocations
	 * @param $week_number
	 * @param $amount
	 */	
	function getTopLocations($week_number = null, $amount){
		if(is_null($week_number)){
			$week_number = $this->getActiveNumber();
		}
		
		$query = "SELECT 
			`Week`.`id`, 
			`Week`.`week_number`, 
			`Week`.`start_date`, 
			`Week`.`end_date`, 
			`WeeklyLocationTotal`.`id`, 
			`WeeklyLocationTotal`.`week_id`, 
			`WeeklyLocationTotal`.`location_id`, 
			`WeeklyLocationTotal`.`points`, 
			`Location`.`id`, 
			`Location`.`state`, 
			`Location`.`city`, 
			`Location`.`modified`, 
			`Location`.`street_address`, 
			`Location`.`phone_number`,
			`Location`.`latitude`,
			`Location`.`longitude`,
			`Location`.`total_points`,
			`Location`.`zip_code`
		FROM `weeks` AS `Week` 
		LEFT JOIN `weekly_location_totals` AS `WeeklyLocationTotal` ON (`WeeklyLocationTotal`.`week_id` = `Week`.`id`) 
		LEFT JOIN `locations` AS `Location` ON (`Location`.`id` = `WeeklyLocationTotal`.`location_id`) 
		WHERE `Week`.`week_number` = $week_number
		AND `WeeklyLocationTotal`.`points` > 0
		ORDER BY `WeeklyLocationTotal`.`points` DESC
		LIMIT $amount";
		
		return $this->query($query);
	}
	
	/*
	 * Retrieves the specified number of Challenges for the week passed in $week_number in order of decending points 
	 * 
	 * function getTopChallenges
	 * @param $week_number
	 * @param $amount
	 */		
	function getTopChallenges($week_number = null, $amount){
		if(is_null($week_number)){
			$week_number = $this->getActiveNumber();
		}
		
		$query = "SELECT 
			`Week`.`id`, 
			`Week`.`week_number`, 
			`Week`.`start_date`, 
			`Week`.`end_date`, 
			`WeeklyPromotionalChallengeTotal`.`id`, 
			`WeeklyPromotionalChallengeTotal`.`week_id`, 
			`WeeklyPromotionalChallengeTotal`.`promotional_challenge_id`, 
			sum(`WeeklyPromotionalChallengeTotal`.`points`) as totalPoints, 
			`PromotionalChallenge`.`id`, 
			`PromotionalChallenge`.`title`, 
			`PromotionalChallenge`.`description`, 
			`PromotionalChallenge`.`points`, 
			`PromotionalChallenge`.`total_attempts`, 
			`PromotionalChallenge`.`last_attempted`,
			`PromotionalChallenge`.`total_points`,
			`PromotionalChallenge`.`is_featured`,
			`PromotionalChallenge`.`image_url`
		FROM `weeks` AS `Week` 
		LEFT JOIN `weekly_promotional_challenge_totals` AS `WeeklyPromotionalChallengeTotal` ON (`WeeklyPromotionalChallengeTotal`.`week_id` = `Week`.`id`) 
		LEFT JOIN `promotional_challenges` AS `PromotionalChallenge` ON (`PromotionalChallenge`.`id` = `WeeklyPromotionalChallengeTotal`.`promotional_challenge_id`) 
		WHERE `Week`.`week_number` = $week_number
		AND PromotionalChallenge.id != 15
		AND `WeeklyPromotionalChallengeTotal`.`points` > 0
		GROUP BY `PromotionalChallenge`.`id`
		ORDER BY totalPoints DESC
		LIMIT $amount";
		
		return $this->query($query);
	}
}