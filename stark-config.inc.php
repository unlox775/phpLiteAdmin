<?php

/////////////////////////
/// Stark MVC Config
$config->CONTROLLER_PRELOAD_LIBS
= array();

///  Controller configuration
$config->CONTROLLER_CLASS_PREFIX = 'phpLiteAdmin__';


/////////////////////////
///  Ansible Skin Configuration

$ctl->SKIN_BASE = rtrim($ctl->url_prefix).'skins/phpliteadmin_v0.1';

///  Make scoped_include() keep the $stage var
#$config->scope_global_vars[] = 'stage';

require(dirname(__FILE__) .'/config.inc.php');
