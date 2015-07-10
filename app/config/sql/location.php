<?php 

class LocationSchema extends CakeSchema {	
	public $locations = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'key'  => 'primary',
			'length' => '11'
		),
		'last_updated'	=> array(
			'type' => 'datetime',
			'null' => true,
		),
		'name' => array(
			'type' => 'string',
			'null' => true
		),
		'city' => array(
			'type' => 'string',
			'null' => false
		),
		'state' => array(
			'type' => 'string',
			'null' => true
		),
		'lat' => array(
			'type' => 'float',
			'null' => true
		),
		'lng' => array(
			'type' => 'float',
			'null' => true
		)
	);
}

?>