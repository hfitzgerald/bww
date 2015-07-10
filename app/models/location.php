<?php

/**
 * Location
 *
 * Model class that wraps all funtionality surrounding a Scvngr location
 *
 * @package       app
 * @subpackage    cake.app.models.location
 * 
 */
class Location extends AppModel {
	var $name = 'Location';
	var $hasMany = array(
		'Challenge' => array(
			'className' => 'Challenge',
			'foreignKey' => 'location_id',
			'dependent' => false
		),
		
	);
	
	/**
	 * Retrieves location information from the scvngr api 
	 *
	 * @param bool $save_results Attempts to save the results retrieved from SCVNGR api
	 * @param int $id The ID of the location to read from api
	 * @return mixed Returns json object if $save_results is set to false, bool if save is set to true, false if no results were returned from scvngr
	 * @access public
	 **/
	function apiLookup($save_results = false, $id = null){
		if ($id != null) {
			$this->id = $id;
		}

		$json_results = $this->httpGet("http://api.scvngr.com/v6/places/{$this->id}.json", true);
		
		if($json_results == false){
			return false; // return false if no results are returned from api request
		}

		if($save_results) {
			$json_results['place']['modified'] = Configure::read('Promotion.start_date');		 			
			return $this->save($json_results['place']);
		} else {
			return $json_results['place'];
		}		
	}
	
	/**
	 * Returns an array that contains the latitude and longitude values produced by converting a zip code
	 * 
	 * @param zip_code - the zip code to find lat lng of
	 * @return void
 	 * @access public
	 */	
 	function getLatLngByZipCode($zip_code){
 		$api_key = Configure::read('google_maps_api_key');
 		$url = 'http://maps.googleapis.com/maps/api/geocode/json';
		
		if(!isSet($this->httpConnection)){
			$this->httpConnection = new HttpSocket();
		}

 		$json = $this->httpConnection->get($url, array('key' => $api_key, 'sensor' => 'false', 'address' => $zip_code));
		$google_data = json_decode($json, true);

		if($google_data['status'] != 'ZERO_RESULTS'){
			return $google_data['results'][0]['geometry']['location'];
		} else{
			return false;
		}
		
 	}

	/**
	 * Updates associated models from the api's stream items call
	 *  
	 * @param id if id is set, forces the update to run on a location rather than using the oldest available
	 * @return mixed Returns json object if $save_results is set to false, bool if save is set to true, false if no results were returned from scvngr
	 * @access public
	 */
	function updateLastModified(){
		$this->lastUpdated(); 
  
		/** 
		 * Retrieve the newest stream items from scvngr's api 
		 */
		$json_items = $this->_retrieveStreamItems($this->id, $this->data['Location']['modified']);
		
		/** 
		 * Process the new stream items that were retrieved via http 
		 */	
		if($json_items != false) {
			
			foreach($json_items as $json_item){
				$user = $json_item['stream_item']['source']['visit']['user'];
				$attempts = $json_item['stream_item']['source']['visit']['attempts'];
				$timestamp = $json_item['stream_item']['timestamp'];
				
				$this->_updateFromJsonItem($user, $attempts, $timestamp);			
			}
		}		
		
		$this->recountPoints(false);
		$this->updateTimestamp(false);		
		return $this->save();
	}
	
	private function _updateFromJsonItem($user, $attempts, $timestamp){
		foreach($attempts as $attempt){
			$attempt = Set::remove($attempt, "attempt.challenge.place");			
			return $this->Challenge->Attempt->insertFromApi($user, $attempt['attempt']['challenge'], $attempt['attempt'], $timestamp);
		}
	}
	
	/**
	* Retrieves the location that is has been was updated the longest time ago
 	* 
 	* @param DateTime start_date If the modified timestamp is older than this one, location will have its timestamp set to this param. This will ensure
 	* 						attempts that existed before the beginning of the promotion are not inserted into the database
 	* @return mixed Returns the record that was retrieved from the database.
 	* @access public 
	*/
	function lastUpdated(){
		$last_updated = $this->find('first', array('order' => array('Location.modified ASC')));		
		return $this->set($last_updated);	
	}

	function addPoints($week_id, $points_to_add){
		$total_points = $this->data['Location']['total_points'];
		$total_points += $points_to_add;
		
		$this->set('total_points', $total_points);
		$this->save();
	}

	/**
	* Recounts the amount of total points associated with the record that is currently being accessed ($this->id must be set)
 	* 
 	* @param bool save If set to true, the record will be updated with newly calculated points
 	* @return void 
 	* @access public 
	*/
	function recountPoints($save = true){
		$attempt_count = $this->Challenge->Attempt->find('all', array(
			'recursive' => -1, 
			'fields' => array(
				'SUM(Attempt.points) as total_points'
			), 
			'conditions' => array(
				'Attempt.location_id' => $this->id, 
				'Attempt.promotional_challenge_id <>' => 15)
			)
		);
		
		$points = intVal($attempt_count[0][0]['total_points']);
		$this->data['Location']['total_points'] = $points;
		
		if($save) $this->save();
	}
	
	/**
	* Updates the timestamp of a record to reflect its time of last update
 	* 
 	* @param bool save If set to true, the record will be updated with the current datetime
 	* @return void 
 	* @access public 
	*/
	function updateTimestamp($save = true){
		$this->data['Location']['modified'] = date('Y-m-d H:i:s');
		if($save) $this->save();
	}
	
	/** 
	 * Model Callbacks 
	 */

	/**
	* Before any location is saved, determine if the data that was passed in originated from scvngr. 
	* If so, the data array needs to be reformatted for a database transaction.
	* 
	* @return bool If true, the save operation should continue. Otherwise it halts
	* @access public 
	*/
	function beforeSave(){		
		/** 
		 * Determine if $this->data originated from scvngr and parse $this->data if so 
		 */
		$is_scvngr_data = (array_key_exists('radius', $this->data['Location']) || array_key_exists('rewards_count', $this->data['Location']));

		if(!$is_scvngr_data){
			/**
			 * Data does not need to be formatted, exit function and continue the 
			 * save operation.
			 */
			return true;
		}
		
		if(is_null($this->Promotion)) {
			$this->Promotion =& ClassRegistry::init('Promotion');
		}
			
		$start_date = $this->Promotion->getStartDate();
		$location = $this->data['Location'];
		
		/**
		 * Clear the data array to prepare for it's reformat. All of the data that was 
		 * passed in is now stored in $location
		 */
		$this->create();
		$this->id = $location['id'];
		$this->data['Location'] = array(
			'id'				=> $location['id'],
			'modified'  		=> $location['modified'],
			'city' 				=> $location['city'],
			'state' 			=> $location['state'],
			'zip_code' 			=> $location['postal_code'],
			'street_address' 	=> $location['street_address'],
			'phone_number' 		=> $location['phone'],
			'latitude' 			=> $location['lat'],
			'longitude' 		=> $location['lng'],
			'total_points'		=> 0
		);
	
		return true;
	}
	
		
 	private function _retrieveStreamItems($id, $after_date){
 		$url = "http://api.scvngr.com/v6/places/$id/stream_items.json?after=$after_date";		
 		return $this->httpGET($url, true);
 	}
 	
}
?>