<?php
/* WeeklyUserTotal Fixture generated on: 2011-08-05 13:08:57 : 1312552077 */
class WeeklyUserTotalFixture extends CakeTestFixture {
	var $name = 'WeeklyUserTotal';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'week_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'points' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'week_id' => 1,
			'user_id' => 1,
			'points' => 1
		),
	);
}
?>