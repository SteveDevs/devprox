<?php
define('DB_HOST', 'localhost');
define('DSN', 'mysql:host=localhost;dbname=test');
define('DB_USER', 'admin');
define('DB_PASS', 'password');
define('DB_NAME', 'test');

spl_autoload_register(function($class){
    require str_replace("\\", "/", $class).".php";
});

//new Classes\RedBlackTree($_POST["number_nodes"]);
(new Classes\CSV())->saveCsvToDB($_FILES['file']);

