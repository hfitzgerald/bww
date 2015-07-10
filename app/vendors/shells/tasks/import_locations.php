<?php 
/**
 * ImportLocations
 * populates the locations table based upon the ids supplied in file (vendors/new_location_file/new_locations.csv)
 */

class ImportLocationsTask extends Shell {
	var $uses = array('Location');
	
	/**
	* function execute
 	* $amount the number of places to update for each execution
	*/	
	function execute() {
		$locations_added = 0; // tracks the number of locations that were successfully stored in the database;
					
		$this->hr();
		$this->out("POPULATING LOCATIONS", 1); 
		$this->hr(); 
		

		$ids = $this->__getIdsFromFile();
		foreach($ids as $id){
			$this->out("-- inserting location: $id", 1); 
			$this->Location->apiLookup(true, $id);			
			$this->hr();
			
			$locations_added++;
		}
		
		$this->out("finished populating locations -- added $locations_added locations");
		$this->hr();
	}

	private function __getIdsFromFile(){
		$this->out("reading csv file...", 1);
		
		$path = APP_PATH . 'vendors' . DS . 'new_location_file' . DS . 'new_locations.csv';	
		$location_file = @fopen($path, "r") or $this->error("No location file found in $path");
				
		$contents = fread($location_file, filesize($path));    
		fclose($location_file);
		
		$this->out("done", 2);
		
		return explode(",", $contents);
	}
}

?>