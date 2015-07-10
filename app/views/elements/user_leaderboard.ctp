<?php $eClass = ""; ?>
<div id="users_leaderboard" class="player">
  <?php foreach($users as $index => $user): ?>
    <?php $position = $index + 1;
			if($position > 9){ $eClass = ' expanded' ;}
	 ?>
    <div class="user <?php echo "u".$position; echo $eClass; ?>">
      <span id="<?php echo "rank_$position"; ?>" class="rank_text"><?php echo $position; ?>.</span>
      <a href="<?php echo "http://scvngr.com/users/" . $user['User']['id'] ?>" class="link">
        <?php echo $this->Html->image($user['User']['image_url'], array('alt' => "user_icon",'class' => "icon")); ?>
      </a>
      <div class="info">
        <p class="name"><?php echo $user['User']['name']; ?></p>
        <p class="location"><?php echo $user['Location']['city'] . "," . $user['Location']['state']; ?></p>
      </div>
      <div class="points">
        <span class="text"><?php echo $user['WeeklyUserTotal']['points']; ?></span>
      </div>
    </div>
  <?php endforeach; ?>
</div>