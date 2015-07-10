<div class="footer">
	<div class="foot_container">
		<div class="menu">
			<a href="/#how">How to Play</a>
			<a href="/leaderboard">Leaderboard</a>
			<a href="/challenges">Challenges</a>
			<a href="/rules">Rules</a>
			<div class="clr"></div>
		</div>
		<div class="bww_locator">
			<input type="number" onkeyup="locLink(event);" class="zipbox" onFocus="this.value = '';" onBlur="if(this.value == ''){this.value='Zip';}" name="zipcode" id="zipcode" value="Zip"  size="5" maxlength="5">
			<a class="search_btn"  onclick="locationGo();">Search</a>
		</div>
		
		<div class="social">
			<div style="width:65px; margin:0px auto;">
		<iframe src="http://www.facebook.com/plugins/like.php?app_id=118191678280376&amp;href=http%3A%2F%2Fwww.facebook.com%2FBuffaloWildWings&amp;send=false&amp;layout=button_count&amp;width=320&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=tahoma&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:320px; height:21px;" allowTransparency="true"></iframe>
			</div>
			<div id="scvngr">
				<span id="icon"></span><span id="totalC"><?php echo $this->requestAction(array('controller' => 'promotions', 'action' => 'getTotalAttempts')); ?> <span></span></span>
			</div>
		</div>
		</div>
		<div class="clr"></div>
		<div class="base">
			<div class="container">
			<div class="content">
				© 2011 Buffalo Wild Wings, Inc. All rights reserved. 
				“Coke Zero” and “Coca-Cola Zero” are trademarks of The 
				Coca-Cola Company. Coca-Cola Zero is the Official Fan 
				Refreshment of NCAA® Football. NCAA is a trademark of 
				the National Collegiate Athletic Association and the 
				NCAA Football logo is a registered trademark of the NCAA 
				licensed to NCAA Football USA, Inc.
			</div>
			<div class="content">
				NO PURCHASE NECESSARY. VOID WHERE PROHIBITED.
				 Runs 9/5/11 - 12/4/11. Open to legal residents of the 50 U.S. or  D.C., 18
				  & older.  Odds of winning depend upon the number of challenge points earned 
				  during each Weekly Grand Prize Period. Total ARV: $54,600.  Subject to complete
				   Official Rules at <a style="text-decoration: none; color:#fff;" href="http://challenge.buffalowildwings.com">http://challenge.buffalowildwings.com</a>.
			</div>
			<div class="clr"></div>
		</div>
	</div>
</div>