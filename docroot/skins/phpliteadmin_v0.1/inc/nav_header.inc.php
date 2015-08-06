<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<title>phpLiteAdmin</title>
	<link rel="stylesheet" href="<?= $view->controller->SKIN_BASE ?>/css/foundation.css">
	<link rel="stylesheet" href="<?= $view->controller->SKIN_BASE ?>/css/screen.css">
	<link rel="stylesheet" href="<?= $view->controller->SKIN_BASE ?>/css/jquery-ui-1.8.21.smothness.css">
	<link rel="stylesheet" href="<?= $view->controller->SKIN_BASE ?>/js/jquery.tablesorter/themes/blue/style.css">
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?= $view->controller->SKIN_BASE ?>/css/ie.css">
	<![endif]-->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?= $view->controller->SKIN_BASE ?>/js/modernizr.foundation.js"></script>
	<script type="text/javascript" src="<?= $view->controller->SKIN_BASE ?>/js/foundation.js"></script>
	<script type="text/javascript" src="<?= $view->controller->SKIN_BASE ?>/js/foundation-app.js"></script>
	<script type="text/javascript" src="<?= $view->controller->SKIN_BASE ?>/js/jquery.tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="<?= $view->controller->SKIN_BASE ?>/js/phpliteadmin.js"></script>
	<script type="text/javascript">
	  var cur_database = <?= json_encode($view->database) ?>;
	  
	  $(document).ready(function() {
		  if ( parent.cur_database !== cur_database ) {
			  parent.cur_database = cur_database;
			  parent.browser.location.href = ( cur_database
											   ? '/table_list.php?db='+ escape(cur_database)
											   : '/database_list.php'
											 );
		  }
	  });
	</script>
</head>
<body>
