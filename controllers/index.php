<?php 
   class controller_index Extends Controller_Base 
   {

     function __construct()
	{
		$this->layouts = "first_layouts";
		parent::__construct();
	}    
	
	function index() {
		$this->view('index');
	}

   }
?>