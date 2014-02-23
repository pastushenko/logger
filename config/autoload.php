<?php 
spl_autoload_register(function ($class) {
	
	if (file_exists(dirname(__FILE__).'/../interfaces/' . $class . '.php')) {
		include_once( dirname(__FILE__).'/../interfaces/' . $class . '.php' );
		
	} elseif (file_exists(dirname(__FILE__).'/../exceptions/' . $class . '.php')) {
		include_once( dirname(__FILE__).'/../exceptions/' . $class . '.php' );
		
	} elseif (file_exists(dirname(__FILE__).'/../helpers/' . $class . '.php')) {
		include_once( dirname(__FILE__).'/../helpers/' . $class . '.php' );
		
	} elseif (file_exists(dirname(__FILE__).'/../core/' . $class . '.php')) {
		include_once( dirname(__FILE__).'/../core/' . $class . '.php' );
		
	}
});