<?php 

	$this->layout="home";
	
	//$this->set("body_id","THIS IS MY BODY");

?>

<div id="subhead">
	<?php echo $html->image('subheadHome.png', array('id'=>'subheadHome', 'alt'=>'Play SCVNGR at SUBWAY Restaurants')); ?>
</div>

<div id="home1" class="homeBlock">
	<?php echo $html->link(null, 'http://www.scvngr.com',array('id'=>'homeDownload', 'target'=>'_new', 'escape'=>false)); ?>
	<p>Get started on your iPhone or Android smartphone</p>
</div>

<div id="home2" class="homeBlock">
	<ul>
		<li>Create an out-of-this-world<br/>
   			sandwich with avocado!</li>
		<li>What’s your super power? And more!</li>
	</ul>
</div>

<div id="home3" class="homeBlock">
	<ul>
		<li>A <i>Green Lantern</i> Movie Ticket</li>
		<li>An Exclusive <i>Green Lantern</i> Video</li>
		<li><i>Green Lantern</i> Wallpapers</li>
	</ul>
</div>

<div id="passwordFormWrapper">
	<div id="passwordForm">
		<form method="POST" action="/promotions/redeem_code" >
			<input type="text" id="rewardPassword" /><input type="submit" id="redeemRewardButton" />
		</form>
	</div>
</div>
<div id="passwordNotValid">Your code is not valid, please re-enter.</div>

<div id="winTickets">
	<p> Win tickets to the Green Lantern Premiere in LA!  The top 25 players at the end of June 13 will each be eligible to win two &#40;2&#41; FREE tickets 
		to the premiere screening! Winners will be emailed on June 14th by SCVNGR with details on how to attend.  <br>
		<a href="/standings" class="winLink">View Standings &raquo;</a>
	</p>
</div>
