<?php

/*
 * Copyright (C) xiuno.com
 */

//$_SERVER['REQUEST_URI'] = '/?search-test.htm';
//$_SERVER['REQUEST_URI'] = '/?qq_login.htm';
//$_SERVER['REQUEST_URI'] = '/?user-login.htm';
//$_SERVER['REQUEST_METHOD'] = 'POST';
//$_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
//$_COOKIE['bbs_sid'] = 'e1d8c2790b9dd08267e6ea2595c3bc82';
//$postdata = 'email=admin&password=c4ca4238a0b923820dcc509a6f75849b';
//parse_str($postdata, $_POST);

// 0: Production mode; 1: Developer mode; 2: Developer Plugin mode;
!defined('DEBUG') AND define('DEBUG', 1);
define('APP_PATH', dirname(__FILE__).'/'); // __DIR__
!defined('ADMIN_PATH') AND define('ADMIN_PATH', APP_PATH.'admin/');
!defined('XIUNOPHP_PATH') AND define('XIUNOPHP_PATH', APP_PATH.'xiunophp/');

// !ini_get('zlib.output_compression') AND ob_start('ob_gzhandler');

//ob_start('ob_gzhandler');
$conf = (@include APP_PATH.'conf/conf.php') OR exit(header('Location: install/'));

// 转换为绝对路径，防止被包含时出错。
substr($conf['log_path'], 0, 2) == './' AND $conf['log_path'] = APP_PATH.$conf['log_path']; 
substr($conf['tmp_path'], 0, 2) == './' AND $conf['tmp_path'] = APP_PATH.$conf['tmp_path']; 
substr($conf['upload_path'], 0, 2) == './' AND $conf['upload_path'] = APP_PATH.$conf['upload_path']; 

if(DEBUG > 1) {
	include XIUNOPHP_PATH.'xiunophp.php';
} else {
	include XIUNOPHP_PATH.'xiunophp.min.php';
}

// 测试数据库连接 / try to connect database
db_connect() OR exit($errstr);

include APP_PATH.'model/plugin.func.php';
include _include(APP_PATH.'model.inc.php');
include _include(APP_PATH.'index.inc.php');

?>