$(document).ready(function(){
	$('#location-zip-box').focus(function(){
		$(this).val('');
	});
	
	/* Check to see if we're on the national leaderboard */
	if(window.national_leaderboard){
		$('#national-local').click(function(){
			$('#local-search').show('fast', function(){});
			
			$('#leaderboard-zip-box').focus(function(){
				$(this).val('');
			});
			
			$('#leaderboard-zip-box').blur(function(){
				if($(this).val() === ''){
					$(this).val('5 Digit Zip');
				} else if(isZip($(this).val())) {
					window.location = '/local_leaderboard/'+$(this).val();
					return false; 
				}
			});
			
			return false;
		});
	}

	$('#location-zip-box').blur(function(){
		if($(this).val() === ''){
			$(this).val('Zip Code');
		}
		
	});
	
	$('#topPlayersZipForm').submit(submitLocation);
	
	if($('.scroll-pane').length){
		$('.scroll-pane').jScrollPane();
	}
	
	if($(".leaderboardZipForm").length){
		$(".leaderboardZipForm").submit(function(e){
			var zipFormID = $(this).attr('id');
			var zipcode = $('#' + zipFormID + ' input:text[name="zip"]').val();
			var zipDest = $('#' + zipFormID + ' input:hidden[name="dest"]').val();
			var zipHash = $('#' + zipFormID + ' input:hidden[name="hash"]').val();
			
			if(isZip(zipcode)) {
				//var apiKey = "ABQIAAAA1PuqETXMwdI8GlTRrXnM9xRRMxWtxLkr00eu9YahxQd-rPdTkRQOl4Qzcz5LuwCcu5cVtW6o8m8Emw"; //DEV
				var apiKey = "ABQIAAAA1PuqETXMwdI8GlTRrXnM9xRel3keiwxzo09Rljb_HBBMP8874xQyaLaYnAUy-lgJpLEJJ9wM0c8q7Q"; //PRODUCTION
				
				$.getJSON("http://maps.google.com/maps/geo?q="+ zipcode + "&key="+ apiKey + "&sensor=false&output=json&callback=?",
				  function(data, textStatus){
					 var lon = data.Placemark[0].Point.coordinates[0];
					 var lat = data.Placemark[0].Point.coordinates[1];
					 
					$.get("/promotions/setLatLong/" + lat + "/" + lon + "/" + zipcode, function(data, textStatus){
					 	if(textStatus == "success"){
					 		window.location = '/leaderboard/' + zipcode + zipHash;
					 	} else{
					 		console.dir(textStatus);
					 	}
					 });
				}); 
			} else{
				$('#'+zipFormID+' .zipError').fadeIn();
			}
			return false;
		});
	}	
});

function submitLocation(){
	if(isZip($('#location-zip-box').val())) { 
		window.location = '/locator/'+$('#location-zip-box').val();
		return false; 
	}
	 
	return false;
}
