<?php 
 Abstract Class Controller_Base{
     
	private $template;
	protected $layouts; // шаблон
	public $vars = array();

	function __construct() {
		$this->template = new Template($this->layouts, get_class($this));
	}

	abstract function Index(); 
    
    protected function setModel($varname = 0, $value = 0){
    	if (empty($varname)OR empty($value)) {
    		$cont_name = get_class($this);
    		die("<h1>Error: Model is not set for `".$cont_name."` </h1>");
    	}
    	$this->template->vars($varname, $value);
    } 

    protected function view($name){
        if(empty($name)){
        	die("<h1>Error: View is not set for `".$cont_name."` </h1>");
        }
        $this->template->view($name);
    }

 }

?>