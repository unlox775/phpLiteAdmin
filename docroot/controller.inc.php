<?php

///  DEFINE THE PATHS relative to this file

///  MODIFY this line to set the path to the Controller.class.php
require_once(dirname(__FILE__). '/../lib/Stark/Controller.class.php');
$ctl = new Stark__Controller
	///  MODIFY these to set paths to each resource
	( $_SERVER['SCRIPT_NAME'],
	  array( 'lib_path'    	   => dirname(__FILE__) .'/../lib', // directory with Stark libraries
			 'config_path' 	   => dirname(__FILE__) .'/../stark-config.inc.php',
			 'controller_path' => dirname(__FILE__) .'/../controllers',
			 'model_path'      => dirname(__FILE__) .'/../models',
			 'controller_inc_base' => dirname(__FILE__), // URL prefix derived from this
			 )
	 );
bug(dirname(__FILE__),$ctl->url_prefix);

///  Common: add the model path to include_path
set_include_path(get_include_path() . PATH_SEPARATOR . $ctl->model_path);

///  Run the Main Handler
$ctl->handler();

///  Define a shortcut to the view...
$view = $ctl->view;
