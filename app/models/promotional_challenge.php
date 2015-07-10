<?php
class PromotionalChallenge extends AppModel {
	var $name = 'PromotionalChallenge';
	var $displayField = 'title';
	var $cacheQueries = true;
	 
	var $hasMany = array(
		'Challenge' => array(
			'className' => 'Challenge',
			'foreignKey' => 'promotional_challenge_id',
			'dependent' => false
		)
	);

	function addPoints($week_id, $points_to_add){
		$total_points = $this->data['PromotionalChallenge']['total_points'];
		$total_points += $points_to_add;
		$total_attempts = $this->data['PromotionalChallenge']['total_attempts'];
		$total_attempts += 1;
		
		$this->set(array(
			'last_attempted' => date('Y-m-d H:i:s'),
			'total_points' => $total_points, 
			'total_attempts' => $total_attempts
		));

		$this->save();
	}

	function recountPoints($id = null){
		if($id != null){
			$this->id = $id;
		}
		
		$this->recursive = -1; // limit associated data to read
		$this->read(null);
		$points = 0;
			
		$attempts = $this->Challenge->Attempt->find('all', array('recursive' => -1, 'conditions' => array('Attempt.promotional_challenge_id' => $this->id)));
		$attempt_count = $this->Challenge->Attempt->find('count', array('recursive' => -1, 'conditions' => array('Attempt.promotional_challenge_id' => $this->id)));
		
		foreach($attempts as $attempt){
			$points += $attempt['Attempt']['points'];
		}
		
		$this->set(array(
			'last_attempted' => date('Y-m-d H:i:s'),
			'total_points' => $points, 
			'total_attempts' => $attempt_count
		));
		
		$this->save();
		$this->recursive = 1; // reset associated data limit 
	}

    function getAssociatedChallengesAndAttemptsById($id) {
        return $this->find('first', 
            array(
                'contain' => array(
                    'Challenge' => array(
                        'conditions' => array('promotional_challenge_id' => $id),
                        'Attempt'
                    )
                ),
                'conditions' => array('PromotionalChallenge.id' => $id)
            )
        );
    }
	
	public function topXAmount($limit){
		$order_conditions = "PromotionalChallenge.total_points DESC";
		
		// nationwide search
		$findParams = array(
			'order' => array($order_conditions),
			'limit' => $limit,
			'recursive' => -1,
			'conditions' => array("PromotionalChallenge.total_points != 0", "PromotionalChallenge.id != 15")
		);
		
		return $this->find('all', $findParams);
	}
}
?>
