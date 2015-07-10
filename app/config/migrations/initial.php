<?php
class M4ddc0f08d87441b2a48c0fe40a2d3257 extends CakeMigration {
/**
 * Models necessary for this migration
 */
	var $uses = array('Location', 'Promotion', 'Week');
	
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
        'attempts' => array(
          'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
          'challenge_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
          'location_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index'),
          'promotional_challenge_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
          'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index'),
          'points' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 2),
          'week_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
          'created' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
          'indexes' => array(
              'PRIMARY' => array('column' => 'id', 'unique' => 1),
              'user_id' => array('column' => 'user_id', 'unique' => 0),
              'location_id' => array('column' => 'location_id', 'unique' => 0),
          ),
          'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
        ),
        'challenges' => array(
          'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
          'location_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
          'promotional_challenge_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
          'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
          ),
          'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
        ),
        'locations' => array(
          'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
          'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
          'city' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
          'state' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
          'zip_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
          'street_address' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 256, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
          'phone_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
          'latitude' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
          'longitude' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
          'total_points' => array('type' => 'integer', 'null' => false, 'default' => NULL),
          'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
          ),
          'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM'),
        ),
        'promotional_challenges' => array(
          'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 3, 'key' => 'primary'),
          'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 512, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
          'description' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
          'points' => array('type' => 'integer', 'null' => false, 'default' => '0'),
          'total_attempts' => array('type' => 'integer', 'null' => false, 'default' => NULL),
          'last_attempted' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
          'total_points' => array('type' => 'integer', 'null' => false, 'default' => NULL),
          'is_featured' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
          'image_url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
          'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
            'title' => array('column' => 'title', 'unique' => 0),
          ),
          'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
        ),
        'promotions' => array(
          'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
          'start_date' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
          'end_date' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
          'company_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
          'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
          'total_attempts' => array('type' => 'integer', 'null' => false, 'default' => '0'),
          'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
          ),
          'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM'),
        ),
        'users' => array(
          'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
          'image_updated_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
          'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
          'image_url' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
          'total_points' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
          'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
          'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
            'users_total_points' => array('column' => 'total_points', 'unique' => 0),
          ),
          'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
        ),
        'weeks' => array(
          'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
          'week_number' => array('type' => 'integer', 'null' => false),
          'start_date' => array('type' => 'datetime', 'null' => false),
          'end_date' => array('type' => 'datetime', 'null' => false),
        ),				
        'weekly_user_totals' => array(
          'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
          'week_id' => array('type' => 'integer', 'null' => false),
          'user_id' => array('type' => 'integer', 'null' => false),
          'points' => array('type' => 'integer', 'null' => false, 'default' => 0),
        ),		
        'weekly_location_totals' => array(
          'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
          'week_id' => array('type' => 'integer', 'null' => false),
          'location_id' => array('type' => 'integer', 'null' => false),
          'points' => array('type' => 'integer', 'null' => false, 'default' => 0),
        ),
        'weekly_promotional_challenge_totals' => array(
          'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
          'week_id' => array('type' => 'integer', 'null' => false),
          'promotional_challenge_id' => array('type' => 'integer', 'null' => false),
          'points' => array('type' => 'integer', 'null' => false, 'default' => 0),
        ),
      ),
    ),
    'down' => array(
      'drop_table' => array(
        'attempts',
        'challenges',
        'locations',
        'promotional_challenges',
        'promotions',
        'users',
        'weeks',
        'weekly_user_totals',
        'weekly_location_totals',
        'weekly_promotional_challenge_totals'
      ),
    ),
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
		/**
		 * $active_promotion 
		 * array of data defining the promotion for this app. defined in config/promotion.php
		 */
		$active_promotion = Configure::read('Promotion');

		/**
		 * $challenges
		 * array of promotion-wide challenges
		 */
		$challenges = Configure::read('Challenges');
		
		/**
		 * Save the promotion
		 */
		$this->Promotion =& ClassRegistry::init('Promotion');
		$save_result = $this->Promotion->save($active_promotion);
		
		/**
		 * Show if the promotion was successfully saved
		 */		
		if($save_result != false){
			echo "-- saved promotion " . var_export($save_result) . "\n";	
		} else {
			echo "promotion was not successfully inserted into the database! \n";
		}
		
		/**
		 * Save challenges
		 */	
		$this->PromotionalChallenge =& ClassRegistry::init('PromotionalChallenge');
		$save_result = $this->PromotionalChallenge->saveAll($challenges['PromotionalChallenge']);

		/**
		 * Show if the challenges were successfully saved
		 */		
		if($save_result != false){
			echo "--saved challenges " . var_export($save_result) . "\n";	
		} else {
			echo "challenges were not successfully inserted in the database! \n";
		}
		
        /**
         * Save weeks to the database
         **/
        $this->Week =& ClassRegistry::init('Week');
        $weeks = Configure::read('Weeks');
        $this->Week->saveAll($weeks['Week']);
        
		/**
		 * Import Locations from ids in csv file
		 */
		$this->_importLocations();
		
		return true;
	}

	function _importLocations() {
		$this->Location =& ClassRegistry::init('Location');				
		$ids = $this->_getIdsFromFile();
		
		foreach($ids as $id){
			echo "adding location $id \n";
			$this->Location->apiLookup(true, $id);			
		}		
	}

	function _getIdsFromFile(){		
		$path = APP_PATH . 'vendors' . DS . 'new_location_file' . DS . 'new_locations.csv';	
		$location_file = @fopen($path, "r") or $this->error("No location file found in $path");				
		$contents = fread($location_file, filesize($path));    
		fclose($location_file);
		
		return explode(",", $contents);
	}
}
?>