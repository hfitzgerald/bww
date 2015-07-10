<?php
class PromotionsController extends AppController {
  /**
   * The promotion's landing page
   *
   * function index
   **/
  function index() {
    $this->loadModel('Week');
    $week_number = $this->Week->getActiveNumber();

    $users = $this->Week->getTopUsers(null, 3);
    $this->set('users', $users);
    $this->set('body_id', 'bww');
  }

  function topFiveUsers(){
    $this->layout = "ajax";

    $this->loadModel('Week');
    $week_number = $this->Week->getActiveNumber();
    $users = $this->Week->getTopUsers(null, 5);
    $this->set('users', $users);
  }

  function getTotalAttempts() {
    $this->loadModel('Attempt');
    return $this->Attempt->getTotalCount();
  }

  function facebook() {
    $this->layout = null;
  }

  function rules() {
    $this->set('body_class', 'rules subpage');
    $this->set('body_id', 'bww');
  }

  function challenges() {
    $this->set('body_class', 'challenges subpage');
    $this->set('body_id', 'bww');
  }

  /**
   * The leaderboard for this promotion
   * 
   * @param $zip_code
   * 	if null, function sets data for national leaderboard, otherwise shows only results from this zip code    
   */
  function leaderboard($week_number = null) 
  {
    $this->loadModel('Week');

    if(is_null($week_number)){
      $active_week = $this->Week->getActiveNumber();
      $week_number = $active_week;
    } else {
      $active_week = $this->Week->getActiveNumber();
    }

    $users = $this->Week->getTopUsers($week_number, 25);
    $locations = $this->Week->getTopLocations($week_number, 25);
    $challenges = $this->Week->getTopChallenges($week_number, 7);

    $this->set('challenges', $challenges);
    $this->set('locations', $locations);
    $this->set('users', $users);			
    $this->set('week_number', $week_number);

    $this->set('active_week', $active_week);
    $this->set('body_class', 'leaderboard subpage');
    $this->set('body_id', 'bww');	}


    function getWinners($week_number = null) 
    {
      $this->loadModel('Week');

      if(is_null($week_number)){
        $active_week = $this->Week->getActive();

      } else {
        $active_week = $this->Week->getByNumber($week_number);
      }

      $users = $this->Week->getTopUsers($week_number, 25);
      $locations = $this->Week->getTopLocations($week_number, 25);

      $this->set('challenges', $challenges);
      $this->set('locations', $locations);
      $this->set('users', $users);			
      $this->set('week', $active_week);



      $this->layout = null;

    }


}



?>
