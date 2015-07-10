<div class="col_container">
	<div class="wrapper">
		<div class='standings'>
			
			<div class="standings_header">
				<img src="/images/desktop/leaderboard_header.png" />
				<select class="styled">
				<?php
				for($i=1; $i<$active_week+1; $i++)
				{
					if($i == $week_number){$week_selected = 'selected = "selected"';} else {$week_selected = '';}
					echo "<option ".$week_selected." value='".$i."'>Week ".$i."</option> \r\n";	
				}
				?>
				</select>
			
			</div>
			
			<div class="players">  <div class="wrap">
				<?php echo $this->element('user_leaderboard', array('users' => $users)); ?>
			</div>
				<div class="pbtn" onclick="prev('player');"></div><div class="nbtn" onclick="next('player');"></div>
			</div>
			
			<div class="restaurants"">  <div class="wrap">
				<?php echo $this->element('locations_leaderboard', array('locations' => $locations)); ?>
			</div>
					<div class="pbtn" onclick="prev('restaurant');"></div><div class="nbtn" onclick="next('restaurant');"></div>
			</div>
			
			<div class="clr"></div>
			
			<div class="challenges">  
				<?php echo $this->element('challenges_leaderboard', array('challenges' => $challenges)); ?>
			</div>
			
		</div>
	</div>
</div>


<script>

    /*CUSTOM DROPDOWN*/
var checkboxHeight = "25";
var radioHeight = "25";
var selectWidth = "109";

var Custom = {
	init: function() {
		var inputs = document.getElementsByTagName("input"), span = Array(), textnode, option, active;
		for(a = 0; a < inputs.length; a++) {
			if((inputs[a].type == "checkbox" || inputs[a].type == "radio") && inputs[a].className == "styled") {
				span[a] = document.createElement("span");
				span[a].className = inputs[a].type;

				if(inputs[a].checked == true) {
					if(inputs[a].type == "checkbox") {
						position = "0 -" + (checkboxHeight*2) + "px";
						span[a].style.backgroundPosition = position;
					} else {
						position = "0 -" + (radioHeight*2) + "px";
						span[a].style.backgroundPosition = position;
					}
				}
				inputs[a].parentNode.insertBefore(span[a], inputs[a]);
				inputs[a].onchange = Custom.clear;
				if(!inputs[a].getAttribute("disabled")) {
					span[a].onmousedown = Custom.pushed;
					span[a].onmouseup = Custom.check;
				} else {
					span[a].className = span[a].className += " disabled";
				}
			}
		}
		inputs = document.getElementsByTagName("select");
		for(a = 0; a < inputs.length; a++) {
			if(inputs[a].className == "styled") {
				option = inputs[a].getElementsByTagName("option");
				active = option[0].childNodes[0].nodeValue;
				textnode = document.createTextNode(active);
				for(b = 0; b < option.length; b++) {
					if(option[b].selected == true) {
						textnode = document.createTextNode(option[b].childNodes[0].nodeValue);
					}
				}
				span[a] = document.createElement("span");
				span[a].className = "select";
				span[a].id = "select" + inputs[a].name;
				span[a].appendChild(textnode);
				inputs[a].parentNode.insertBefore(span[a], inputs[a]);
				if(!inputs[a].getAttribute("disabled")) {
					inputs[a].onchange = Custom.choose;
				} else {
					inputs[a].previousSibling.className = inputs[a].previousSibling.className += " disabled";
				}
			}
		}
		document.onmouseup = Custom.clear;
	},
	pushed: function() {
		element = this.nextSibling;
		if(element.checked == true && element.type == "checkbox") {
			this.style.backgroundPosition = "0 -" + checkboxHeight*3 + "px";
		} else if(element.checked == true && element.type == "radio") {
			this.style.backgroundPosition = "0 -" + radioHeight*3 + "px";
		} else if(element.checked != true && element.type == "checkbox") {
			this.style.backgroundPosition = "0 -" + checkboxHeight + "px";
		} else {
			this.style.backgroundPosition = "0 -" + radioHeight + "px";
		}
	},
	check: function() {
		element = this.nextSibling;
		if(element.checked == true && element.type == "checkbox") {
			this.style.backgroundPosition = "0 0";
			element.checked = false;
		} else {
			if(element.type == "checkbox") {
				this.style.backgroundPosition = "0 -" + checkboxHeight*2 + "px";
			} else {
				this.style.backgroundPosition = "0 -" + radioHeight*2 + "px";
				group = this.nextSibling.name;
				inputs = document.getElementsByTagName("input");
				for(a = 0; a < inputs.length; a++) {
					if(inputs[a].name == group && inputs[a] != this.nextSibling) {
						inputs[a].previousSibling.style.backgroundPosition = "0 0";
					}
				}
			}
			element.checked = true;
		}
	},
	clear: function() {
		inputs = document.getElementsByTagName("input");
		for(var b = 0; b < inputs.length; b++) {
			if(inputs[b].type == "checkbox" && inputs[b].checked == true && inputs[b].className == "styled") {
				inputs[b].previousSibling.style.backgroundPosition = "0 -" + checkboxHeight*2 + "px";
			} else if(inputs[b].type == "checkbox" && inputs[b].className == "styled") {
				inputs[b].previousSibling.style.backgroundPosition = "0 0";
			} else if(inputs[b].type == "radio" && inputs[b].checked == true && inputs[b].className == "styled") {
				inputs[b].previousSibling.style.backgroundPosition = "0 -" + radioHeight*2 + "px";
			} else if(inputs[b].type == "radio" && inputs[b].className == "styled") {
				inputs[b].previousSibling.style.backgroundPosition = "0 0";
			}
		}
	},
	choose: function() {
		option = this.getElementsByTagName("option");
		for(d = 0; d < option.length; d++) {
			if(option[d].selected == true) {
				document.getElementById("select" + this.name).childNodes[0].nodeValue = option[d].childNodes[0].nodeValue;
				window.location = "/leaderboard/week/"+this.value;
			}
		}
	}
}
window.onload = Custom.init;
  
  /*END*/
  
  
  
	function prev(cls)
	{	
		$('.'+cls).animate({top: "+=305"}, 500, function(){
			var tmp = $('.'+cls).css('top');
			tmp = tmp.replace("px", ""); 
			if(tmp >= 0){
				$('.'+cls).stop(true);
				$('.'+cls+'s .pbtn').hide();
				}
			if(tmp <= -300){
				$('.'+cls+'s .nbtn').show();
				}
		});
	}	

	function next(cls)
	{
		$('.'+cls).animate({top: "-=305"}, 500, function(){
		var tmp = $('.'+cls).css('top');
			tmp = tmp.replace("px", ""); 
			if(tmp <= -1220){
				$('.'+cls).stop(true);
				$('.'+cls+'s .nbtn').hide();
				}
			if(tmp <= 0){
				$('.'+cls+'s .pbtn').show();
				}
		});
	}	
</script>