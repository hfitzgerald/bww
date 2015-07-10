<div id="users_leaderboard" class="restaurant">
  <?php foreach($locations as $index => $location): ?>
    <?php $position = $index + 1;
		if($position < 10){$posPlus = "0";} else {$posPlus = "";}
	 ?>   
    <div class="user <?php echo "u".$position; ?>">
      <span id="<?php echo "rank_$position"; ?>" class="rank_text"><?php echo $position; ?>.</span>

      <div class="info">
        <p class="name"><?php echo $location['Location']['city'] . ", " . $location['Location']['state']; ?></p>
      </div>
      <div class="points">
        <span class="text"><?php echo $location['WeeklyLocationTotal']['points']; ?></span>
      </div>
    </div>
  <?php endforeach; ?>
</div>