<?php
App::import('Lib', 'LazyModel.LazyModel');
App::import('Core', 'HttpSocket');

class AppModel extends LazyModel {
	var $actsAs = array('Containable');
	
	public function httpGET($url, $output_array = false) {
		if(!isset($this->httpConnection)) {
			$this->httpConnection = new HttpSocket();
		}
			
		$jsonResponse = $this->httpConnection->get($url); // returns false when no records are returned 
		
		if($jsonResponse != false) {
			return json_decode($jsonResponse, $output_array);
		} else {
			return false;
		}
	}

	/**
	* function updatePointsCount
 	* param @points
 	* adds points param to total_points field and saves it to the database 
	*/
	public function updatePointsCount($points){
		/* the beat of million drums*/
		$updated_points = $this->field('total_points') + $points;
		return $this->saveField('total_points', $updated_points);
	}
	
	/**
	* function topTen
 	* retrieves the top ten records by total points decending of a subclass 
	*/
	public function topTen() {
		$model = $this->name;
		$order_conditions = "$model.total_points DESC";
		
		// nationwide search
		$findParams = array(
			'order' => array($order_conditions),
			'limit' => 10,
			'recursive' => -1,
			'conditions' => array("$model.total_points != 0")
		);
		
		return $this->find('all', $findParams);
	}
	
	public function saveIfNonExistant($id, $data){
		$this->id = $id;
		
		if(!$this->exists()){
			$this->save($data);
		} else {
			$this->read();
		}
	}
}