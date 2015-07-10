<?php
/* Week Fixture generated on: 2011-08-05 13:08:45 : 1312550805 */
class WeekFixture extends CakeTestFixture {
	var $name = 'Week';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'week_number' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'start_date' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'end_date' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'week_number' => 1,
			'start_date' => '2011-08-05 13:26:45',
			'end_date' => '2011-08-05 13:26:45'
		),
	);
}
?>