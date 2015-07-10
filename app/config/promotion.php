<?php 
/*
 * config/Promotion.php
 * contains scvngr promotion specific values required by the app.
 */

/**
 *	Set the default timezone for this app. IMPORTANT
 **/  
date_default_timezone_set('America/Chicago');
 
$config = array();

/**
 * GLOBAL SETTINGS
 * 
 * Application wide settings for a scvngr promotion
 */
$config['Promotion'] = array(
  'id'                      => 1,
  'start_date'              => '2011-09-05 00:00:00', 
  'end_date'                => '2011-12-04 23:59:59',  
  'company_name'            => 'Buffalo Wild Wings',
  'name'                    => 'Fall Football Campaign',
  'total_attempts'          => 0,
  'number_of_weeks'         => 13,
  'untracked_challenge_id'  => 15  
);


/**
 * $config['Weeks']
 * The weeks that we should track users during
 **/
$config['Weeks'] = array(
  'Week' => array(
    array(
      'week_number' => 1,
      'start_date'  => '2011-09-05 00:00:00',
      'end_date'    => '2011-09-11 23:59:59',
    ),
    array(
      'week_number' => 2,
      'start_date'  => '2011-09-12 00:00:00',
      'end_date'    => '2011-09-18 23:59:59',
    ),
    array(
      'week_number' => 3,
      'start_date'  => '2011-09-19 00:00:00',
      'end_date'    => '2011-09-25 23:59:59',
    ),
    array(
      'week_number' => 4,
      'start_date'  => '2011-09-26 00:00:00',
      'end_date'    => '2011-10-02 23:59:59',
    ),
    array(
      'week_number' => 5,
      'start_date'  => '2011-10-03 00:00:00',
      'end_date'    => '2011-10-09 23:59:59',
    ),
    array(
      'week_number' => 6,
      'start_date'  => '2011-10-10 00:00:00',
      'end_date'    => '2011-10-16 23:59:59',
    ),
    array(
      'week_number' => 7,
      'start_date'  => '2011-10-17 00:00:00',
      'end_date'    => '2011-10-23 23:59:59',
    ),
    array(
      'week_number' => 8,
      'start_date'  => '2011-10-24 00:00:00',
      'end_date'    => '2011-10-30 23:59:59',
    ),
    array(
      'week_number' => 9,
      'start_date'  => '2011-10-31 00:00:00',
      'end_date'    => '2011-11-06 23:59:59',
    ),
    array(
      'week_number' => 10,
      'start_date'  => '2011-11-07 00:00:00',
      'end_date'    => '2011-11-13 23:59:59',
    ),
    array(
      'week_number' => 11,
      'start_date'  => '2011-11-14 00:00:00',
      'end_date'    => '2011-11-20 23:59:59',
    ),
    array(
      'week_number' => 12,
      'start_date'  => '2011-11-21 00:00:00',
      'end_date'    => '2011-11-27 23:59:59',
    ),
    array(
      'week_number' => 13,
      'start_date'  => '2011-11-28 00:00:00',
      'end_date'    => '2011-12-04 23:59:59',
    ),
  )
);


/**
 * $config['Challenges']
 * an array containing the challenges for this scvngr promotion
 */
$config['Challenges'] = array(
  'PromotionalChallenge' => array(
    array(
        'title' => 'High-Fives All Around',
        'description' => 'Take a picture high-fiving another table after a big moment in the game.',
        'points' => 3,
        'total_attempts' => 0,
        'total_points' => 0,
        'is_featured' => 0,
        'image_url' => '/images/leaderboard_images/high_fives.png'
    ),
     array(
        'title' => 'Check-In',
        'description' => 'Let your friends know you\'re here',
        'points' => 1,
        'total_attempts' => 0,
        'total_points' => 0,
        'is_featured' => 0,
        'image_url' => '/images/leaderboard_images/check_in.png'
    ),
      array(
        'title' => 'Social Check-in',
        'description' => 'Bump phones to check-in with friends. Earn 2 points per person you check-in with.',
        'points' => 2,
        'total_attempts' => 0,
        'total_points' => 0,
        'is_featured' => 0,
        'image_url' => '/images/leaderboard_images/social_check_in.png'
    ),
     array(
        'title' => 'Say something',
        'description' => 'Say anything you want. Write a short helpful note, a quick review, an idea, a suggestion, a shout or perhaps a haiku.',
        'points' => 2,
        'total_attempts' => 0,
        'total_points' => 0,
        'is_featured' => 0,
        'image_url' => '/images/leaderboard_images/say_something.png'
    ),
    array(
        'title' => 'Snap a picture',
        'description' => 'Simply grab a picture of this place. A cool panoramic shot, perhaps? Take your best shot!',
        'points' => 2,
        'total_attempts' => 0,
        'total_points' => 0,
        'is_featured' => 0,
        'image_url' => '/images/leaderboard_images/snap_a_picture.png'
    ),
    array(
        'title' => 'Guess the Score',
        'description' => 'Predict the final score of the game you\'re watching. Make sure to tell us who\'s playing.',
        'points' => 3,
        'total_attempts' => 0,
        'total_points' => 0,
        'is_featured' => 0,
        'image_url' => '/images/leaderboard_images/tv.png'
    ),
    array(
        'title' => 'Gridiron Pose',
        'description' => 'Have a picture of your best football action pose. See if your Server will block for you.',
        'points' => 2,
        'total_attempts' => 0,
        'total_points' => 0,
        'is_featured' => 0,
        'image_url' => '/images/leaderboard_images/gridiron.png'
    ),
    array(
        'title' => 'Coke Zero Match-Up',
        'description' => 'Tell us your favorite BWW menu item to pair with a Coke Zero&trade;.',
        'points' => 2,
        'total_attempts' => 0,
        'total_points' => 0,
        'is_featured' => 0,
        'image_url' => '/images/leaderboard_images/coke_bottle_top.png'
    ),
    array(
        'title' => 'Coke Zero Pride',  
        'description' => 'Draw a picture of a Coke Zero&trade; logo on your napkin and take a picture of it.',
        'points' => 2,
        'total_attempts' => 0,
        'total_points' => 0,
        'is_featured' => 0,
        'image_url' => '/images/leaderboard_images/camera.png'
    ),
    array(
        'title' => 'Do The Wave',
        'description' => 'Get your table to do the wave &amp; take a photo or even better get the whole restaurant involved.',
        'points' => 3,
        'total_attempts' => 0,
        'total_points' => 0,
        'is_featured' => 0,
        'image_url' => '/images/leaderboard_images/wave.png'
    ),
    array(
        'title' => 'Coke Zero Transportation',
        'description' => 'Take a picture of your Server carrying a Coke Zero&trade; to the table.',
        'points' => 2,
        'total_attempts' => 0,
        'total_points' => 0,
        'is_featured' => 0,
        'image_url' => '/images/leaderboard_images/transportation.png'
    ),
   array(
        'title' => 'Paper Football',
        'description' => 'Time to play some paper football. Create your own football and take a photo of your field goal attempt.',
        'points' => 3,
        'total_attempts' => 0,
        'total_points' => 0,
        'is_featured' => 0,
        'image_url' => '/images/leaderboard_images/paper.png'
    ),
   array(
        'title' => 'Fantasy Team Name',
        'description' => 'Tell us your Fantasy Football team name.',
        'points' => 2,
        'total_attempts' => 0,
        'total_points' => 0,
        'is_featured' => 0,
        'image_url' => '/images/leaderboard_images/teamname.png'
    ),
    array(
        'id' => 15,
        'title' => 'Untracked', 
        'description' => '',
        'points' => 0,
        'total_attempts' => 0,
        'total_points' => 0,
        'is_featured' => 0
    )
  )
);

?>