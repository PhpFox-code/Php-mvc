<?php

Class Router {

	private $path;
	private $args = array();

	private $controller;
	private $action;

	function __construct() {
		$this->path = SITE_PATH. DS .'controllers'.DS;
	}
	
	// определение контроллера и экшена из урла
	private function getPathController() {
        $route = (empty($_GET['route'])) ? '' : $_GET['route'];   //если пустой то " " иначе получаем значение route;
		unset($_GET['route']);  
        if (empty($route)) {
			$route = 'index'; 
		}
		
        // Получаем части урла
        $route = trim($route, '/');
        $parts = explode('/', $route);

        $cmd_path = $this->path;

        foreach ($parts as $part) {
        	$part = strtolower($part);
			$fullpath = $cmd_path.$part;

			if (is_file($fullpath . '.php')) {   
				$this->controller = $part;
				array_shift($parts);
				break;
			}

			if (is_dir($fullpath)) {
				$cmd_path .= $part . DS;
				array_shift($parts);
			}
        }

        // Получаем экшен
        $this->action = array_shift($parts);
        if (empty($this->action)) { 
			$this->action = 'index'; 
		}

		if(!empty($parts)){
            die("Invalid URL"); 
		}

        return $cmd_path . $this->controller . '.php';

	}
	
	function start() {
        // Анализируем путь
        $path_controller = $this->getPathController();
		
        // Проверка существования файла, иначе 404
        if (!is_readable($path_controller)) {
			die ('404 Not Found File Controller');
        }
		
        // Подключаем файл
        include ($path_controller);

        // Создаём экземпляр контроллера
        $class = 'controller_' . $this->controller;
        $obj_controller = new $class();
		
        // Если экшен не существует - 404
        if (!is_callable(array($obj_controller, $this->action))) {
			die ('404 Not Found Action!');
        }

        // Выполняем экшен
        $action_controller = $this->action;
        $obj_controller->$action_controller();
	}
}