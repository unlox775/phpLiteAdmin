<?php
require_once(dirname(__FILE__) .'/models/Database.class.php');

Database::$config = array( 'databases' => array( 'History' => 'sqlite:/Expendable-Copies/iPhoto Library/Database/History.apdb',
												 ),
						   );
