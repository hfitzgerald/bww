 <?php 
/**
 * UpdateTask
 * run by a cron task on a set interval, in order to update the data for each location
 */
class UpdateTask extends Shell {
	var $uses = array('Location', 'Promotion');
	
	/**
	* function execute
 	* $amount the number of places to update for each execution
	*/	
	function execute() {
		/** 
		 * Exit the update function if this promotion is not currently active 
		 */
		if(!$this->Promotion->isActive()){
			$this->out('Promotion is not active, exiting update function.');
			$this->hr();
			
			return false;
		}
		
		$amount = $this->args[0];				
		$this->out('updating locations.');
		$this->hr();
		
		for ($update_index = 0; $update_index < $amount; $update_index++) {
			$disp_index = $update_index + 1;
			$this->out("updating location $disp_index"); 
			$this->Location->updateLastModified();
		}
	}
}

?>