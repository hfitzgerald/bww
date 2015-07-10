<?php
class M4e3aeeaeeb004a9c9a65238c0a2d3257 extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	var $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	var $migration = array(
		'up' => array(
			'create_table' => array(
				
			),
			'create_field' => array(
				'attempts' => array(
					
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				
			),
			'drop_field' => array(
				'attempts' => array(
					'week_id'
				),
			),
		)
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	function after($direction) {
		return true;
	}
}
?>