$(function() {
  
	//clear the value
	var $zipValue = $('#location-zip-box');
	var $zipValueTop = $('#location-zip-box-top');
	
	$zipValue.focus(function(){
		$(this).val('');
	});
	$zipValueTop.focus(function(){
		$(this).val('');
	});
	
	$('.getZipForm').submit(function(){
		var zipFormID = $(this).attr('id');
		var zipCode = $('#' + zipFormID + ' input:text[name="zip"]').val();
		var gaTrackLoc = $(this).attr('ref');
		
		//ADDITIONAL PARAMS
		var zipDest = $('#' + zipFormID + ' input:hidden[name="dest"]').val();
		var zipHash = $('#' + zipFormID + ' input:hidden[name="hash"]').val();
		
		//SET DEFAULTS IF PARAMS ARE EMPTY
		if(zipDest == "" || zipDest == null)
			zipDest = "locator";
		if(zipHash == "" || zipHash == null)
			zipHash = "";
		
		//CHECK IF IT'S AN ACTUAL ZIP CODE
		if(isZip(zipCode)) { 
			/* Google tracking Code */
			/* Have to double push the gaq.push so safari has time to load the trackEvent */
			_gaq.push(function() {
				var tracker = _gat._createTracker('UA-XXX');
				tracker._trackEvent('flavor fanatics', 'search button click', gaTrackLoc);
			});
			var gotolink =  '/' + zipDest + '/' + zipCode + zipHash;
			_gaq.push(function() {
				setTimeout(function(){ window.location = gotolink; },300);
			});
			
			return false; 
		}else{
			$('#'+zipFormID+' .zipError').fadeIn();
		}
		
		return false;
	});
	
	/* STANDINGS FUNCTIONS */
	
	if($('.standingsBox').length > 0){
		
		//var views = new Array('firstTen', 'secondTen', 'lastTen');
		var curPlayView = 0;
		var curChalView = 0;
		var standingsClickable = true;
		var aniSpeed = 500;
		$('.standingInactive').css('opacity', '.3');
		
		$('.standingsNavItem').click(function(){
			if(standingsClickable){
				standingsClickable = false;
				var section = $(this).parent().attr('id').replace('Nav','');
				var clickedItem = $(this).attr('id').replace(section,'');
				var currentSet = null;
				var nextSet = null;
				var maxPage = null;
				
				if(section == "players"){
					currentSet = curPlayView;
					if($('#players2').length > 0)
						maxPage = 2;
					else
						maxPage = 1;
				} else{
					currentSet = curChalView;
					if($('#challenges2').length > 0)
						maxPage = 2;
					else
						maxPage = 1;
				}
				
				if(clickedItem == "PrevTen" && currentSet > 0){
					nextSet = currentSet - 1;
				} else if(clickedItem == "NextTen" && currentSet < maxPage){
					nextSet = currentSet + 1;
				} else if(clickedItem == "firstTen"){
					nextSet = 0;
				} else if(clickedItem == "secondTen"){
					nextSet = 1;
				} else if(clickedItem == "lastTen"){
					nextSet = 2;
				} else{
					nextSet = currentSet;
				}
				
				if(currentSet != nextSet){					
					$('#' + section + currentSet).animate({height: 'toggle', opacity: 'toggle'}, aniSpeed, function(){
						$('#' + section + nextSet).animate({height: 'toggle', opacity: 'toggle'}, aniSpeed, function(){
							if(section == "players")
								curPlayView = nextSet;
							else
								curChalView = nextSet;
							standingsClickable = true;
						});
					});
				} else{
					standingsClickable = true;
				}
			}
		});
		
	}
	
	/* END STANDINGS FUNCTIONS */
	/* Google tracking Code */
	
	
	//capture Link click and track
	
	/* !!!! ----------- Moved the Event Tracking Code for Zip Code Search clicks up into the        $('.getZipForm').submit(function(){        at the top of this script  --------------------!!!!   */
	 
	$("#menuMLnk,#facebookMLnk,#locatorMLnk,#vewLeaderboardBtn,#vewChallengeBtn,#downloadScvngrTxt,#flavorMLnk,#gamesMLnk,#rulesMLnk,#printRules,#leaderTopPlayers,#leaderTopRestaurants,#leaderTopChallenges,#sideFacebook,#scvngrEnter").click(function(e){
	
		switch(this.id){
			
			/* 
			Have to double push the gaq.push so safari has time to load the trackEvent 	
			*/
	
			case "menuMLnk":
			
				e.preventDefault();
				_gaq.push(function() {
					var tracker = _gat._createTracker('UA-XXX');
					tracker._trackEvent('flavor fanatics', 'menu button click', 'top nav');
					// MediaMind Conversion Tracking
					mmConversion(126126);
				});
				var gotolink = this.href;
				_gaq.push(function() {
					setTimeout(function(){ location.href = gotolink; },300);
				});	
				
			break;
			case "facebookMLnk":
							
				e.preventDefault();
				_gaq.push(function() {
					var tracker = _gat._createTracker('UA-XXX');
					tracker._trackEvent('flavor fanatics', 'facebook button click', 'top nav');
					// MediaMind Conversion Tracking
					mmConversion(126127);
				});
				var gotolink = this.href;
				_gaq.push(function() {
					setTimeout(function(){ location.href = gotolink; },300);
				});	
				
			break;
			case "locatorMLnk":
				
				e.preventDefault();
				_gaq.push(function() {
					var tracker = _gat._createTracker('UA-XXX');
					tracker._trackEvent('flavor fanatics', 'locations button click', 'top nav');
				});
				var gotolink = this.href;
				_gaq.push(function() {
					setTimeout(function(){ location.href = gotolink; },300);
				});	
				
			break;
			case "gamesMLnk":
			
				e.preventDefault();
				_gaq.push(function() {
					var tracker = _gat._createTracker('UA-XXX');
					tracker._trackEvent('flavor fanatics', 'games button click', 'top nav');
				});
				var gotolink = this.href;
				_gaq.push(function() {
					setTimeout(function(){ location.href = gotolink; },300);
				});	

				
			break;
			case "flavorMLnk":
			
				e.preventDefault();
				_gaq.push(function() {
					var tracker = _gat._createTracker('');
					tracker._trackEvent('flavor fanatics', 'see our sauces button click', 'top nav');
				});
				var gotolink = this.href;
				_gaq.push(function() {
					setTimeout(function(){ location.href = gotolink; },300);
				});
				
			break;
			/*case "vewLeaderboardBtn":
				_gaq.push(function() {
					var tracker = _gat._createTracker('UA-XXX');
					tracker._trackEvent('flavor fanatics', 'top scvngr actions button click', 'main page');
				});
			break;*/
			/*case "vewChallengeBtn":
				_gaq.push(function() {
					var tracker = _gat._createTracker('UA-XXX');
					tracker._trackEvent('flavor fanatics', 'facebook button click', 'main page');
				});
			break;*/
			case "downloadScvngrTxt":
			
				e.preventDefault();
				_gaq.push(function() {
					var tracker = _gat._createTracker('UA-XXX');
					tracker._trackEvent('flavor fanatics', 'download scvngr link click', 'main page');
					// MediaMind Conversion Tracking
					mmConversion(126128);
				});
				var gotolink = this.href;
				_gaq.push(function() {
					setTimeout(function(){ location.href = gotolink; },300);
				});
				
			break;
			case "rulesMLnk":
			
				e.preventDefault();
				_gaq.push(function() {
					var tracker = _gat._createTracker('UA-XXX');
					tracker._trackEvent('flavor fanatics', 'view rules button click', 'rules');
				});
				var gotolink = this.href;
				_gaq.push(function() {
					setTimeout(function(){ location.href = gotolink; },300);
				});

			break;
			case "printRules":
			
				e.preventDefault();
				_gaq.push(function() {
					var tracker = _gat._createTracker('UA-XXX');
					tracker._trackEvent('flavor fanatics', 'print rules button click', 'rules');
				});
				var gotolink = this.href;
				_gaq.push(function() {
					setTimeout(function(){ location.href = gotolink; },300);
				});

			break;
			/*case "leaderTopPlayers":
				_gaq.push(function() {
					var tracker = _gat._createTracker('UA-XXX');
					tracker._trackEvent('flavor fanatics', '', 'leaderboard');
				});
			break;
			/*case "leaderTopRestaurants":
				_gaq.push(function() {
					var tracker = _gat._createTracker('UA-XXX');
					tracker._trackEvent('flavor fanatics', '', 'leaderboard');
				});
			break;
			/*case "leaderTopChallenges":
				_gaq.push(function() {
					var tracker = _gat._createTracker('UA-XXX');
					tracker._trackEvent('flavor fanatics', '', 'leaderboard');
				});
			break;
			
			
			*/
			case "sideFacebook":
			
				e.preventDefault();
				_gaq.push(function() {
					var tracker = _gat._createTracker('UA-XXX');
					tracker._trackEvent('flavor fanatics', 'join in button click', 'left hand nav');
					// MediaMind Conversion Tracking
					mmConversion(126130);
				});
				var gotolink = this.href;
				_gaq.push(function() {
					setTimeout(function(){ location.href = gotolink; },300);
				});
				
			break;
			case "scvngrEnter":
				e.preventDefault();
				_gaq.push(function() {
					var tracker = _gat._createTracker('UA-XXX');
					tracker._trackEvent('flavor fanatics', 'play us on scvngr button click', 'left hand nav');
					// MediaMind Conversion Tracking
					mmConversion(126129);
				});
				var gotolink = this.href;
				_gaq.push(function() {
					setTimeout(function(){ location.href = gotolink; },300);
				});
			break;
			

		}
		
		
	});
	

 });
function isZip(s) {
     // Check for correct zip code
     reZip = new RegExp(/(^\d{5}$)|(^\d{5}-\d{4}$)/);

     if (!reZip.test(s)) {
          return false;
     }
	return true;
}

function locLink(e)
	{		
	if(e.keyCode == 13){locationGo();}			
	}

function locationGo()
	{
	var zipValue = document.getElementById('zipcode');
	window.location = 'http://locations.buffalowildwings.com/?postalcode='+zipValue.value;
	}
var current = 0;
var sOptions = {swipe:swipeEvent, threshold:34};
$('#screen').swipe(sOptions);

function swipeEvent(evt, dir)
{
	if(dir == 'right'){shft(206);} 
	else if(dir == 'left'){shft(-206);}
}
function shft(dir)
{
	current += dir;
	finalString = current+"px";
	$('#screen').stop(true).animate(
	{
		backgroundPosition : finalString
		
	}, 300);
}