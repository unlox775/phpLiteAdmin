<?php require($stage->extend->run_hook('header', 0)) ?>
<html>
<head>
	<link rel="stylesheet" href="<?php echo $ctl->SKIN_BASE ?>/css/screen.css" media="all" type="text/css"/>
	<meta name="viewport" content="width=device-width"/>
	<meta http-equiv="viewport" content="width=device-width,initial-scale=1"/>
	<script type="text/javascript" src="<?php echo $ctl->SKIN_BASE ?>/js/skin.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link href="http://fonts.googleapis.com/css?family=Exo:300,300italic&subset=latin,latin-ext" rel="stylesheet" type="text/css"/>
</head>
<body>

<div id="main_header" class="container">
	<div class="row">
		<div id="main_logo"><div class="inner"> An<span class="sib">sib</span>le<span class="stage">Stage</span></div></div>

		<div id="main_header_nav">
			<?php require($stage->extend->run_hook('header', 5)) ?>

			<?php
			
			    ###  And stuff to switch between environments
			    $uri = $_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].$_SERVER['PATH_INFO'];
			    $script_name = $_SERVER['SCRIPT_NAME'];
			    $script_name = preg_replace('/actions\/(update|tag).php/','project.php',$script_name);
			    $query_string = $_SERVER['QUERY_STRING'];
			    $query_string = preg_replace('/[\&\?](cmd|command_output|tag)=[^\&]+/','',$query_string);
			    $query_string = preg_replace('/action=(entire_repo_update|entire_repo_tag)/','action=repo_admin',$query_string);
			    
			    ###  Output Staging Area Switch line
			    $sandboxes = array();
			    foreach ( $stage->staging_areas as $env => $area ) {
			        $selected = false;
			        if ( ! empty( $area['test_by_func'] ) )        $selected = call_user_func($area['test_by_func']);
			        else if ( ! empty( $area['test_uri_regex'] ) ) $selected = preg_match($area['test_uri_regex'], $uri);
					else                                           $selected = ( $env == $stage->env );
			        $sandboxes[] = array( 'url' => ( $stage->config('default_url_protocol') ."://". 
													 ( ! empty( $area['host'] ) ? $area['host'] : $_SERVER['HTTP_HOST'] ) . $stage->url_prefix .'/change_env.php?env='. $env .'&redirect='. $stage->url_prefix .'/'. basename($script_name)
													 . urlencode("?". $query_string)
													 ),
										  'label' => $area['label'],
										  'selected' => $selected,
										  );
			    }
			  
			    ###  Separator between sandboxes and staging areas
			    $sandboxes[] = array( 'url' => null,
									  'label' => ' --- ',
									  'selected' => false,
									  );
			
			    ###  Output Sandbox Switch line
			    foreach ( $stage->sandbox_areas as $env => $area ) {
			        $selected = false;
			        if ( ! empty( $area['test_by_func'] ) )        $selected = call_user_func($area['test_by_func']);
			        else if ( ! empty( $area['test_uri_regex'] ) ) $selected = preg_match($area['test_uri_regex'], $uri);
					else                                           $selected = ( $env == $stage->env );
			        $sandboxes[] = array( 'url' => ( $stage->config('default_url_protocol') ."://". 
													 ( ! empty( $area['host'] ) ? $area['host'] : $_SERVER['HTTP_HOST'] ) . $stage->url_prefix .'/change_env.php?env='. $env .'&redirect='. $stage->url_prefix .'/'. basename($script_name)
													 . urlencode("?". $query_string)
													 ),
										  'label' => $area['label'],
										  'selected' => $selected,
										  );
			    }
			?>
			<?php require($stage->extend->run_hook('header', 6)) ?>

			<ul>
				<li>
					<form id="switch_env">
					Switch to: 
					<select name="switch_to" id="switch_to" onchange="if ( $(this).val() ) location.href = $(this).val()">
						<?php foreach( $sandboxes as $sb ) { ?>
							<option value="<?php echo $sb['url'] ?>"<?php if ( $sb['selected'] ) echo 'selected="selected"' ?>><?php echo $sb['label'] ?></option>
						<?php } ?>
					</select>
					</form>
				</li>
				<li><a href="admin.php">Admin Tools</a></li>
				<li><a href="list.php">All Projects</a></li>
			</ul>
			
			<?php require($stage->extend->run_hook('header', 10)) ?>
		</div>

	</div>
</div>

<div id="main_body" class="container">
	<div class="row">
		<div class="eleven columns centered">
