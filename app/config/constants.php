<?php
// projekti nimi
define('PROJECT_NAME', 'Blog');
// juur url
define('URLROOT', 'http://'.$_SERVER['HTTP_HOST'].'/'.PROJECT_NAME);
// rakenduse juurkataloog
define('APPROOT', dirname(dirname(__FILE__)));

// db parameetrid
define('DB_HOST', 'localhost');
define('DB_USER', 'markko');
define('DB_PASS', '');
define('DB_NAME', 'blog');

define('PASSWORD_LEN', 8);