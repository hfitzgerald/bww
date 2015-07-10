<?php
//Make sure these are always added first into asset before your stuff in views
$this->Html->script(array('plugins','commonscript'),array('inline'=>false));
?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en" id="home"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en" id="home"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en" id="home"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en" id="home"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Buffalo Wild Wings - Fall Football Promotion</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width;">
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
	
  <?php echo $this->Html->css('admin.css?v=2'); ?>
  <?php echo $javascript->link('modernizr-1.7.min.js'); ?>
</head>

<body id="admin">

  <div id="container">
    <div id="main" role="main">
	  <?php echo $content_for_layout ?>
    </div>
  </div>  <!-- end #container -->


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.js"></script>
<script>window.jQuery || document.write("<script src='/js/jquery-1.5.2.min.js'>\x3C/script>")</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23606592-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


<?php echo $javascript->link('script.js'); ?>
<?php echo $javascript->link('jquery.ba-hashchange.js'); ?>
<?php echo $javascript->link('commonscript.js'); ?>
<?php echo $javascript->link('jquery.fixedheadertable.min.js'); ?>
<?php echo $javascript->link('admin.js'); ?>

  <!--[if lt IE 7 ]>
	<?php echo $html->script('dd_belatedpng')?>
  <![endif]-->

</body>
</html>