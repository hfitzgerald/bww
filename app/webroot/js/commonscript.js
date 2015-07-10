/* Author: 

*/
$(document).ready(function() {
	$('#redeemRewardButton').hover(function(){
		$('#passwordForm').css( {backgroundPosition: "0px -36px"} );
	},
	function(){
		$('#passwordForm').css( {backgroundPosition: "0px 0px"} );
	});
	
	$('#redeemRewardButton').click(function(){
		redeemCode = $('#rewardPassword').val();
		$.post('/promotions/redeem_code', {code: redeemCode}, function(data) {
			if((data.valid)) {
				//send to new url
				$('#passwordNotValid').css({display: "none"});
				window.location = data.url;
			}
			else {
				$('#passwordNotValid').css({display: "block"});
			}
		})
		return false;
	});
});






















