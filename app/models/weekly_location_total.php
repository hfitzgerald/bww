<?php
class WeeklyLocationTotal extends AppModel {
	var $name = 'WeeklyLocationTotal';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Week' => array(
			'className' => 'Week',
			'foreignKey' => 'week_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function createRecordOrUpdatePoints($data){
		/* see if weekly totals already have an entry */
		if(is_null($data['WeeklyLocationTotal']['id'])){
			$this->newFromStream($data['Location']['id'], $data['Week']['id'], $data['Attempt']['points']);
		} else {
			$this->set($data['WeeklyLocationTotal']);
			$this->updatePoints($data['Attempt']['points']);			
		}
	}
	
	function newFromStream($id, $week_id, $points_to_add){
		$data = array(
			'location_id' => $id,
			'week_id'	  => $week_id,
			'points'	  => $points_to_add
		);
		
		echo("creating new location total");
		$this->create();
		$this->set($data);
		$this->save();
	}
	
	function updatePoints($points){
		if(is_null($this->id)) return false;
		
		$new_point_total = $this->data['WeeklyLocationTotal']['points'] + $points;
		$this->set('points', $new_point_total);
		$this->save();
	}
}
?>