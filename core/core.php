<?php
// Загрузка классов "на лету"
function __autoload($className) {
	$filename = strtolower($className) . '.php';  
	$expArr = explode('_', $className);  //   строка className => expArr[] (lolo_ddd => expArr([0]=lolo,[1]=ddd))

	if(empty($expArr[1]) OR $expArr[1] == 'Base'){  //   (Controller_Base )    Route(empty expArr[1]) !!!
		$folder = 'lib';			
	}
        else{			
		switch(strtolower($expArr[0])){ 
			case 'model':					
				$folder = 'models';	
				break;
				
			default:
				$folder = 'lib';
				break;
		}
	}

	$file = SITE_PATH . DS . $folder . DS . $filename;
	if (!file_exists($file)) {
		die("<h1> File: ".$file." not found !!! </h1>");
	}		
	include ($file);
}

