<?php

require_once(dirname(dirname(__FILE__)) .'/lib/Stark/Controller/Base.class.php');
	
class phpLiteAdmin__root extends Stark__Controller__Base {
	public function database_list_page($ctl) {
		$databases = array();
		foreach ( Database::get_databases() as $database ) {
			$db = new Database( $database );

			$databases[ $database ] = array( 'table_count' => count( $db->get_tables() ),
											 'database' => $database,
											 );
		}

		return( array( 'databases' => $databases,
					   )
				);
	}
	public function table_list_page($ctl) {
		if ( ! isset( Database::$config['databases'][ $_REQUEST['db'] ] ) )
			return trigger_error("Invalid database: {$_REQUEST['db']}");
		$database = new Database($_REQUEST['db']);
		$tables = array();
		foreach ( $database->get_tables() as $table ) {
			$sql = "SELECT COUNT(*) as row_count FROM $table";
			$sth = $database->dbh()->query($sql);
			$data = $sth->fetchAll(PDO::FETCH_ASSOC);

			$tables[ $table ] = $data[0];
		}

		return( array( 'database' => $database->database,
					   'tables'   => $tables,
					   )
				);
	}
	public function tables_nav_page($ctl) {
		$db_name = null;
		$tables = null;
		if ( ! empty($_REQUEST['db'] ) && isset( Database::$config['databases'][ $_REQUEST['db'] ] ) ) {
			$database = new Database($_REQUEST['db']);
			$db_name = $database->database;
			$tables = $database->get_tables();
		}
			
		return( array( 'database' => $db_name,
					   'tables'   => $tables,
					   'databases' => Database::get_databases(),
					   )
				);
	}
}
