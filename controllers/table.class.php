<?php

require_once(dirname(dirname(__FILE__)) .'/lib/Stark/Controller/Base.class.php');
	
class phpLiteAdmin__table extends Stark__Controller__Base {
	public function browse_page($ctl) {
		if ( ! isset( Database::$config['databases'][ $_REQUEST['db'] ] ) )
			return trigger_error("Invalid database: {$_REQUEST['db']}");
		$database = new Database($_REQUEST['db']);
		
		if ( empty( $_REQUEST['sql'] ) ) {
			if ( ! in_array($_REQUEST['table'], $database->get_tables()) )
				return trigger_error("Invalid table: {$_REQUEST['table']}");
			$_REQUEST['sql'] = "SELECT * FROM {$_REQUEST['table']} LIMIT 100";
		}
		$sth = $database->dbh()->query($_REQUEST['sql']);
		$data = $sth->fetchAll(PDO::FETCH_ASSOC);

		return( array( 'database' => $database->database,
					   'table'    => $_REQUEST['table'],
					   'data'     => $data,
					   )
				);
	}
	public function structure_page($ctl) {
		if ( ! isset( Database::$config['databases'][ $_REQUEST['db'] ] ) )
			return trigger_error("Invalid database: {$_REQUEST['db']}");
		$database = new Database($_REQUEST['db']);
		if ( ! in_array($_REQUEST['table'], $database->get_tables()) )
			return trigger_error("Invalid table: {$_REQUEST['table']}");

		$sql = "SELECT * FROM sqlite_master WHERE tbl_name = ". $database->dbh()->quote($_REQUEST['table']) ."";
		$sth = $database->dbh()->query($sql);

		$table_cols = array();
		$table_indexes = array();
		foreach( $sth->fetchAll(PDO::FETCH_ASSOC) as $row ) {
			if ( $row['type'] == 'table' ) {
				foreach ( explode(',', preg_replace('/^CREATE TABLE \S+ \(/','',preg_replace('/\)$/','',trim($row['sql'] ) ) ) ) as $col_def ) {
					///  PRIMARY KEY
					if ( preg_match('/^PRIMARY KEY\s*\(\s*(\w+(?:\s*,\s*\w+)*)\s*\)/i',trim($col_def),$m) ) {
						$table_indexes['PRIMARY KEY'] = array( 'definition' => $m[1]);
					}
					///  UNIQUE KEY
					else if ( preg_match('/^UNIQUE KEY\s*\(\s*(\w+(?:\s*,\s*\w+)*)\s*\)/i',trim($col_def),$m) ) {
						$table_indexes['UNIQUE KEY'] = array( 'definition' => $m[1] );
					}
					///  Skip keys and Constraints
					else if ( preg_match('/^(PRIMARY|KEY|CONSTRAINT|UNIQUE)/i',trim($col_def),$m) ) {
						continue;
					}
					///  COLUMN
					else if ( preg_match('/^(\w+)\s*(\S.+)$/',trim($col_def),$m) ) {
						$table_cols[ $m[1] ] = array( 'definition' => $m[2] );

						if ( strpos(strtoupper($m[2]), 'PRIMARY KEY' ) !== false ) {
							$table_indexes['PRIMARY KEY'] = array( 'definition' => '('. $m[1] .')');
						}
					}
				}
			}
			else if ( $row['type'] == 'index' ) {
				$table_indexes[ $row['name'] ] = array( 'definition' => preg_replace('/^CREATE INDEX \S+ ON \w+/i','',$row['sql']) );
			}
		}
		
		return( array( 'database' => $database->database,
					   'table'    => $_REQUEST['table'],
					   'data'     => $data,
					   'table_cols' => $table_cols,
					   'table_indexes' => $table_indexes,
					   )
				);
	}
}