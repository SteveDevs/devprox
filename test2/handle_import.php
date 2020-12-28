<?php
define('DB_HOST', 'localhost');
define('DSN', 'mysql:host=localhost;dbname=steve_devprox');
define('DB_USER', 'admin');
define('DB_PASS', 'Hasher_80');
define('DB_NAME', 'steve_devprox');

spl_autoload_register(function($class){
    require str_replace("\\", "/", $class).".php";
});

//new Classes\RedBlackTree($_POST["number_nodes"]);
(new Classes\CSV())->saveCsvToDB($_FILES['file']);

