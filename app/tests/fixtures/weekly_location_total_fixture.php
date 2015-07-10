<?php
/* WeeklyLocationTotal Fixture generated on: 2011-08-05 13:08:59 : 1312551899 */
class WeeklyLocationTotalFixture extends CakeTestFixture {
	var $name = 'WeeklyLocationTotal';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'week_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'points' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'week_id' => 1,
			'location_id' => 1,
			'points' => 1
		),
	);
}
?>