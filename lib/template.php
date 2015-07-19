<?php
Class Template {

	private $controller;
	private $layouts;
	private $vars = array();
	
	function __construct($layouts, $controllerName) {
		$this->layouts = $layouts;
		$arr = explode('_', $controllerName);
		$this->controller = strtolower($arr[1]);
	}
	
	function vars($varname, $value) {
		if (isset($this->vars[$varname]) == true) {
			die("<h1>Error: Unable to set var `" . $varname . "`. Already set, and overwrite not allowed.</h1>");
		}
		$this->vars[$varname] = $value;
	}
	
	function view($name) {
		if(empty($this->layouts)){
			die("You Should set layout");
		}
		$pathLayout = SITE_PATH .DS. 'views' . DS . 'layouts' . DS . $this->layouts . '.php';
		$contentPage = SITE_PATH .DS. 'views' . DS . $this->controller . DS . $name . '.php';
		if (!file_exists($pathLayout)) {
			die("Not Found Layout: ". $this->layouts);
		}
		if (file_exists($contentPage) == false) {
			die("Not Found Template: ". $this->name);
		}
		
		foreach ($this->vars as $key => $value) {
			$$key = $value;
		}
		
		include ($pathLayout);               
	}
	
}