<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Coke Zero&#8482; Tablegating Challenge | Buffalo Wild Wings&reg; </title>
  <meta name="description" content="">
  <meta name="author" content="">
  
  <meta name="viewport" content="initial-scale=1, user-scalable=no, minimum-scale=1.0,  target-densitydpi = medium-dpi, maximum-scale=1.0">
  <link rel="shortcut icon" href="/favicon.png">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">

  <?php echo $this->Html->css('reset.css'); ?>
  <?php echo $this->Html->css('media-queries.css'); ?>
  <!--[if lt IE 8 ]> 
    <?php echo $this->Html->css('ie7fix.css'); ?>
  <![endif]-->
    <!--[if IE  ]> 
    <?php echo $this->Html->css('iefix.css'); ?>
  <![endif]-->
   
   <?php echo $javascript->link('css3-mediaqueries.js'); ?>
<script type="text/javascript" src="http://use.typekit.com/gug4kqv.js"></script> 
<script type="text/javascript">try{Typekit.load();}catch(e){}</script> 

</head>

<body<?php if(isset($body_id)) echo " id=\"$body_id\"" ?> <?php if(isset($body_class)) echo " class=\"$body_class\"" ?> >
  <div id="container">

   <?php echo $this->element('header');?>

    <div id="main" role="main">
		<?php echo $content_for_layout ?>
    </div>
    
		<?php echo $this->element('footer');?>

  </div> 

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='/js/jquery-1.5.2.min.js'>\x3C/script>")</script>
<script>
	var _gaq=[["_setAccount","UA-2451897-4"],["_trackPageview"]]; 
	var _gaq1=[["_setAccount","UA-2451897-1"],["_trackPageview"]]; 
	
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
	g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
	s.parentNode.insertBefore(g,s)}(document,"script"));

</script>
<?php echo $javascript->link('script-compress.js'); ?>


<!--[if lt IE 7 ]>
	
  <?php echo $html->script('dd_belatedpng')?>
  
<![endif]-->

</body>
</html>