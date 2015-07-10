<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'name';

	var $hasMany = array(
		'Attempt' => array(
			'className' => 'Attempt',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'WeeklyUserTotal' => array(
			'className' => 'WeeklyUserTotal',
			'foreignKey' => 'user_id',
			'dependent' => false
		)
	);
	
    /**
     * function: getData
     * params: $id (int)
     * remarks: executes an http get request to api.scvngr.com and returns the 
     * parsed json object that is returned
     **/
    function apiLookup($id){
        $json = $this->httpGet("http://api.scvngr.com/v6/users/{$id}.json", true);
        return $json['user'];
    }

	function addPoints($week_id, $points_to_add){
		$total_points = $this->data['User']['total_points'];
		$total_points += $points_to_add;
		
		$this->set('total_points', $total_points);
		$this->save();
	}

	function recountPoints($week_id){
		$this->recursive = -1; // limit associated data to read
		$this->read(null);
				
		$attempt_count = $this->Attempt->find('all', 
			array(
				'recursive' => -1, 
				'fields' => array(
					'SUM(Attempt.points) as total_points'
				), 
				'conditions' => array(
					'Attempt.user_id' => $this->id, 
					'Attempt.week_id' => $week_id,
					'Attempt.promotional_challenge_id <>' => 15
				)	
			)
		);
		
		$points = intVal($attempt_count[0][0]['total_points']);
		$this->WeeklyUserTotal->updatePoints($points);
		
		$this->save();
		$this->recursive = 1;
	}
	
	/**
	 * Callbacks
	 **/
	function beforeSave(){
		/* check for keys that shouldnt be in array to determine if data originated from scvngr and needs to be reformatted */
		$is_json_data = (array_key_exists('badges_count', $this->data['User']) || array_key_exists('privacy_protected', $this->data['User']));

		if($is_json_data){
			$user = $this->data['User'];
			
			/* see if user came back with image_updated_at = null, if so, set it to current date */
			if(is_null($user['image_updated_at'])){
				$user['image_updated_at'] = date('Y-m-d H:i:s');	
			}
			
			$this->create(); // clears data array
			$this->data['User'] = array(
            	'id' 			   => $user['id'],
            	'name' 			   => $user['name'],
            	'image_url' 	   => $user['image_url_small'], 
            	'image_updated_at' => $user['image_updated_at']
			);
			
			unset($user);
		}
		//must return true for save operation to continue
		return true;
	}
}
