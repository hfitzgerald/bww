<?php
class WeeklyUserTotal extends AppModel {
	var $name = 'WeeklyUserTotal';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Week' => array(
			'className' => 'Week',
			'foreignKey' => 'week_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function createRecordOrUpdatePoints($data){
		/* see if weekly totals already have an entry */
		echo(var_export($data));
		if(is_null($data['WeeklyUserTotal']['id'])){
			$this->newFromStream($data['User']['id'], $data['Week']['id'], $data['Attempt']['points']);
		} else {
			$this->set($data['WeeklyUserTotal']);
			$this->updatePoints($data['Attempt']['points']);			
		}
	}
	
	function newFromStream($id, $week_id, $points_to_add)	{
		$data = array(
			'user_id' 	  => $id,
			'week_id'	  => $week_id,
			'points'	  => $points_to_add
		);
		
		$this->create();
		$this->set($data);
		$this->save();
	}
	
	function updatePoints($points){
		if(is_null($this->id)) return false;
		
		$new_point_total = $this->data['WeeklyUserTotal']['points'] + $points;
		$this->set('points', $new_point_total);
		$this->save();
	}
}
?>