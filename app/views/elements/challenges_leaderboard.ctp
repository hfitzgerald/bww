<div id="users_leaderboard" class="challenge">
  <?php foreach($challenges as $index => $challenge): ?>
    <?php $position = $index + 1; ?>   
    <div class="user <?php echo $position; ?>">
      <span id="<?php echo "rank_$position"; ?>" class="rank_text"><?php echo $position; ?>.</span>
    <div class="link">
        <?php echo $this->Html->image($challenge['PromotionalChallenge']['image_url'], array('alt' => $challenge['PromotionalChallenge']['title'],'class' => "icon")); ?>
    </div>
      <div class="info">
        <p class="name"><?php echo $challenge['PromotionalChallenge']['title']; ?></p>
        <a href="/challenges" class="location">Learn More</a>
      </div>
      <div class="description">
      	<?php echo $challenge['PromotionalChallenge']['description']; ?>
      </div>
      <div class="points">
        <span class="text"><?php echo ($challenge[0]['totalPoints']); ?></span>
      </div>
    </div>
  <?php endforeach; ?>
</div>