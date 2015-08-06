<?php

class Database {
	public static $config = array();
	public static $dbhs = null;
	public $database = null;
	
	public function __construct($database) {
		$this->database = $database;
	}

	public function dbh() {
		if ( empty( self::$dbhs[ $this->database ] ) ) {
			self::$dbhs[ $this->database ] = new PDO(self::$config['databases'][ $this->database ],'','');  $GLOBALS['orm_dbh'] = self::$dbhs[ $this->database ];
			self::$dbhs[ $this->database ]->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		return self::$dbhs[ $this->database ];
	}

	public static function get_databases() {
		return( array_keys( self::$config['databases'] ) );
	}

	public function get_tables($verbose = false) {
		$sql = "SELECT * FROM sqlite_master WHERE type='table'";
		$sth = $this->dbh()->query($sql);
		$data = $sth->fetchAll(PDO::FETCH_ASSOC);
		if ( $verbose ) return( $data );

		$return = array('sqlite_master');
		foreach( $data as $row ) {
			$return[] = $row['name'];
		}
		return( $return );
	}
}