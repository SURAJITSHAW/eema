<?php

ob_start();
// session_start();

if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

date_default_timezone_set('Asia/Calcutta');



// if(!defined('HOME')) define('HOME', 'http://182.18.138.199/eema/');
	if(!defined('HOME')) define('HOME', 'http://localhost/eema/');

if(!defined('HOME_URI')) define('HOME_URI', $_SERVER['DOCUMENT_ROOT'].DS.'eema'.DS);

if(!defined('ASSETS')) define('ASSETS', HOME.'assets/');

if(!defined('PUBLIC')) define('PUBLIC', HOME.'public/');



if(!defined('DB_HOST')) define('DB_HOST', 'localhost');

if(!defined('DB_USER')) define('DB_USER', 'root');

if(!defined('DB_PASS')) define('DB_PASS', '');

if(!defined('DB_NAME')) define('DB_NAME', 'eema');

if(!defined('TBL_PREFIX')) define('TBL_PREFIX', '');

if(!defined('TBL_SUFFIX')) define('TBL_SUFFIX', '_tbl');



if( file_exists(HOME_URI.'process'.DS.'_db_conn.php') )

	include_once('_db_query.php');

?>