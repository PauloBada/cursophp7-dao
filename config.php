<?php

spl_autoload_register(function($class_name) {

	// "class" é o diretório dentro de htdocs\DAO\class onde estão as classes agora
	$filename = "class".DIRECTORY_SEPARATOR.$class_name.".php";

	if (file_exists($filename)) {
		require_once($filename);
	}
});

?>