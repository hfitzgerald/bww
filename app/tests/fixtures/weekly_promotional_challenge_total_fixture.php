<?php
/* WeeklyPromotionalChallengeTotal Fixture generated on: 2011-08-05 13:08:43 : 1312551943 */
class WeeklyPromotionalChallengeTotalFixture extends CakeTestFixture {
	var $name = 'WeeklyPromotionalChallengeTotal';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'week_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'promotional_challenge_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'points' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'week_id' => 1,
			'promotional_challenge_id' => 1,
			'points' => 1
		),
	);
}
?>