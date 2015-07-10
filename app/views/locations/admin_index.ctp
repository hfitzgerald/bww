<?php if($week == false): ?>
<h1>Week does not exist!</h1>

<?php else: ?>

<div id="week_info">
	<h1 id="week_number">Week <?php echo $week['Week']['week_number']; ?></h1>	
	<span><strong>Start Date:</strong> <?php echo $week['Week']['start_date']; ?></span>
	<span><strong>End Date:</strong> <?php echo $week['Week']['end_date']; ?></span>
</div>

<?php $nav_url = '/admin/week/'; ?>
<div id="navigation">
	<a href="<?php echo $nav_url . ($week['Week']['week_number'] - 1) ?>" id="previous" class="<?php if($week['Week']['week_number'] == 1) echo "inactive"; ?>">Previous Week</a>
	<a href="<?php echo $nav_url . ($week['Week']['week_number'] + 1) ?>" id="next" class="<?php if($week['Week']['week_number'] == $number_of_weeks) echo "inactive"; ?>">Next Week</a>
</div>

<div id="leaderboards">
	<div id="top_users">
		<h2>Top Users</h2>
		<table id="top_users_table" class="leaderboard_table">
			 <thead>
				<th class="image_column"></th>
			 	<th>id</th>
			 	<th>Name</th>
			 	<th>Total Points</th>
			 </thead>
			 <tbody>
			 	<?php foreach($users as $user): ?>
			 		<tr>
						<td><img class="user_icon" alt="user_icon" src="<?php echo $user['User']['image_url'] ?>"></td>
			 			<td><?php echo $user['User']['id']; ?></td>
			 			<td><?php echo $user['User']['name']; ?></td>
			 			<td><?php echo $user['WeeklyUserTotal']['points']; ?></td>
			 		</tr>
			 	<?php endforeach; ?>
			 </tbody>
		</table>
	</div>

	<div id="top_locations">
		<h2>Top Locations</h2>
		<table id="top_locations_table" class="leaderboard_table">
			<thead>
				<th>id</th>
				<th>Street Address</th>
				<th>City</th>
				<th>State</th>
				<th>Zip Code</th>
				<th>Phone Number</th>
				<th>Total Points</th>
			</thead>
			<tbody>
				<?php foreach($locations as $location): ?>
					<tr>
						<td><?php echo $location['Location']['id']; ?></td>
						<td><?php if(isset($location['Location']['street_address'])) echo $location['Location']['street_address']; ?></td>
						<td><?php if(isset($location['Location']['city'])) echo $location['Location']['city']; ?></td>
						<td><?php if(isset($location['Location']['state'])) echo $location['Location']['state']; ?></td>
						<td><?php if(isset($location['Location']['zip_code'])) echo $location['Location']['zip_code']; ?></td>
						<td><?php if(isset($location['Location']['phone_number'])) echo $location['Location']['phone_number']; ?></td>
						<td><?php echo $location['WeeklyLocationTotal']['points']; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	
	<div id="top_challenges">
		<h2>Top Challenges</h2>
		<table id="top_challenges_table" class="leaderboard_table">
			<thead>
				<th></th>
				<th>id</th>
				<th>title</th>
				<th>description</th>
				<th>point value</th> 
				<th>total attempts</th>
				<th>total points</th>
			</thead>
			<tbody>
				<?php foreach($challenges as $challenge): ?>
					<tr>
						<td><img class="challenge_icon" alt="challenge_icon" src="<?php echo $challenge['PromotionalChallenge']['image_url'] ?>"></td>
						<td><?php echo $challenge['PromotionalChallenge']['id']; ?></td>
						<td><?php if(isset($challenge['PromotionalChallenge']['title'])) echo $challenge['PromotionalChallenge']['title']; ?></td>
						<td><?php if(isset($challenge['PromotionalChallenge']['description'])) echo $challenge['PromotionalChallenge']['description']; ?></td>
						<td><?php if(isset($challenge['PromotionalChallenge']['points'])) echo $challenge['PromotionalChallenge']['points']; ?></td>
						<td><?php if(isset($challenge['PromotionalChallenge']['total_attempts'])) echo ceil($challenge['WeeklyPromotionalChallengeTotal']['points'] / $challenge['PromotionalChallenge']['points']); ?></td>
						<td><?php echo $challenge['WeeklyPromotionalChallengeTotal']['points']; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	

</div>

<script>
	var current_page = <?php echo $week['Week']['week_number'] . ";\n"; ?>
	var total_pages = <?php echo $number_of_weeks . ";\n"; ?>
</script>

<?php endif ?>