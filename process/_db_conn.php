<?php

##############################################
########## Databse Connectivity ##############
##############################################

class Database {
	public $_link = null;

	private $_result = false;

	function __construct(){
		$this->_link = $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS);

		if( !$this->_link ){
			$_SESSION['error_msg'] = '!Database Connection Failed...';
		}else{
			$this->_result = $mysqli->select_db(DB_NAME);
			if( !$this->_result ){
				$_SESSION['error_msg'] = '!Database Not Found...';
			}
			else {
                // Output success message
                // echo 'Database connection successful!';
            }
		}
	}

}


$connect = new Database;
?>
