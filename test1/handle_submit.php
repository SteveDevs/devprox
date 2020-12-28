<?php

spl_autoload_register(function($class){
    require str_replace("\\", "/", $class).".php";
});

if(isset($_GET['identity_no'])){
	echo (new Classes\User())->get($_GET['identity_no']);
}else{
	return (new Classes\User())->insert($_POST);
}