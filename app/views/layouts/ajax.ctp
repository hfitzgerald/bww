<?php
//Make sure these are always added first into asset before your stuff in views
$this->Html->script(array('plugins','commonscript'),array('inline'=>false));
?>


  <title>Ajax-Respond</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="initial-scale = 1,user-scalable=no,maximum-scale=1.0">
  <link rel="shortcut icon" href="/favicon.png">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">

  <?php echo $this->Html->css('style.css?v=2'); ?>
  <?php echo $this->Html->css('media-queries.css'); ?>
  <!--[if lt IE 8 ]> 
    <?php echo $this->Html->css('ie7fix.css'); ?>
  <![endif]-->
   <?php echo $javascript->link('respond.min.js'); ?>
   
  <!--<script type="text/javascript" src="http://use.typekit.com/gug4kqv.js"></script> 
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script> -->

</head>

<body<?php if(isset($body_id)) echo " id=\"$body_id\"" ?> <?php if(isset($body_class)) echo " class=\"$body_class\"" ?> >
  <div id="container">
   
 
		<?php echo $content_for_layout ?>
    

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='/js/jquery-1.5.2.min.js'>\x3C/script>")</script>

<?php echo $javascript->link('script.js'); ?>
<?php echo $javascript->link('jqs.js'); ?>
<?php echo $javascript->link('locator.js'); ?>
<?php echo $javascript->link('jquery.ba-hashchange.js'); ?>

<script>
	var current = 0;
	var sOptions = {swipe:swipeEvent, threshold:34};
	$('#screen').swipe(sOptions);
	
	function swipeEvent(evt, dir)
	{
		if(dir == 'right'){shft(206);} else
		if(dir == 'left'){shft(-206);}
	}
	
	function shft(dir){
		current += dir;
		$('#screen').stop(true).animate(
		{
		backgroundPositionX : current+"px"
		}, 300);
	}
	
	
	/*var bE = document.getElementById('screen');
	var num = 0;
	var t;
	
	function animationGo()
	{
		t = self.setInterval(loop, 1);
	}
	
	function loop()
	{
		bE.style.backgroundPosition = num+"px 0px";
		num += .2;
		
		if(num >= 206){t=clearInterval(t);}
	}
	
	
	var bE = document.getElementById('screen');
	bfg_bind_touch(bE, runLeft, runRight);
	
	function runLeft(){
		animationGo();
	}
	
	function runRight(){
		animationGo();
	}
	
	/*Who needs jQuery? Plug in the element you want touch interaction with, then the functions for left/right interaction*//*
	function bfg_bind_touch(boundElement, leftFunction, rightFunction){
		var dwn;
		var ups;
		var threshold = 60;
		boundElement.ontouchstart = function(e) { dwn = e.touches[0].pageX; }
		boundElement.ontouchmove = function(e) { e.preventDefault(); ups = e.touches[0].pageX; }
		boundElement.ontouchend = function(e){  calculate();}
		function calculate(){
		  	if ((dwn - ups) > threshold){ leftFunction(); }
		 	if ((ups- dwn) > threshold){ rightFunction(); }
		}
	}*/
</script>

<!--[if lt IE 7 ]>
	
  <?php echo $html->script('dd_belatedpng')?>
  
<![endif]-->

</body>
</html>