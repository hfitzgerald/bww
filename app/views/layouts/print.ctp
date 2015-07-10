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

  <title><?php echo $title_for_layout;?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width, initial-scale=1.0;">
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
	
  <?php echo $this->Html->css('style.css?v=2'); ?>
</head>

<body id="homepage">

	<?php echo $content_for_layout ?>


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


  
</body>
</html>