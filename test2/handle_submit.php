<?php
define('DB_HOST', 'localhost');
define('DSN', 'mysql:host=localhost;dbname=test');
define('DB_USER', 'admin');
define('DB_PASS', 'password');
define('DB_NAME', 'test');

spl_autoload_register(function($class){
    require str_replace("\\", "/", $class).".php";
});

if($_POST["number_nodes"] == 0){
	header("Location: error.php?error=" . 'Zero nodes where given');
	exit();
}
else if($_POST["number_nodes"] == 1){
	$random = new Classes\Random();
	$random->generate();

	$data = [
		'name' => $random->name,
		'surname' => $random->surname,
		'dob' => $random->date,
		'initial' => $random->name[0]
	];
    $csv = new Classes\CSV();
    $csv->generateCsv($data);
}

//new Classes\RedBlackTree($_POST["number_nodes"]);
new Classes\RedBlackTree($_POST["number_nodes"]);
