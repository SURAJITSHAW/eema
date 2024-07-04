<?php
##############################################
########## Databse Queries File ##############
########### Author: ABHIJEET K. ##############
##############################################

	if( file_exists(HOME_URI.'process'.DS.'_db_conn.php') )
	include_once('_db_conn.php');
    if( file_exists(HOME_URI.'process'.DS.'_sessions.php') )
	include_once('_sessions.php');

	function buildName($suf){
		return $suf."_tbl";
	}

	function sql_exec($sql){
		global $link;
		return mysql_query($sql, $link);
	}

	function refine($val, $sanitize = true){
        global $mysqli;
        $val = trim(preg_replace(array('/\s+/'), array(' '), $val));
        if($sanitize){
            $val = filter_var($val, FILTER_SANITIZE_STRING);
        }
		return mysqli_escape_string($mysqli, $val);
	}

	function replaceByDash($str){
		return preg_replace(array('/\s+/','/\'/'), array('-',''), strtolower($str));
	}

    global $mysqli;
	$mysqli = $connect->_link;

    if( file_exists(HOME_URI.'process'.DS.'function.php') )
	include_once('function.php');
?>
