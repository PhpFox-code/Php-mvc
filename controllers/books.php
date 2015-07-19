<?php 
  class controller_books Extends Controller_Base 
  {

    function __construct()
	{
		$this->layouts = "first_layouts";
		parent::__construct();
	}    
	
	function index() {
		$model = new Model_Books();
        $books = $model->getAllRows();
        if(isset($books)){
            $this->setModel('books', $books); 
        }
		$this->view('books_view');
	}

	function addform(){
		$this->view('add_form');
	}

	function add(){
	    $field = array('name' => $_POST["Name"],
	    	           'description' => $_POST["Description"],
	    	           'date' => $_POST["Date"],
	    	           'autor' => $_POST["Autor"],
	    	           'pages' => $_POST["Pages"]
	    	);
        $model = new Model_Books();
        
	    foreach ($field as $key => $value) {
	    	if(!empty($value)){
               $model->$key = $value;
	    	}
	    }
       $model->save();
		header('Location: http://example/books');
	}


	function delete(){
		$id = $_GET["id"];
        $id = (int) $id; 
		if(is_int($id)){
			$model = new Model_Books();
		    $model->getRowById($id);
		    $model->deleteById($id);
		}
		header('Location: http://example/books');
	}

	function deleteAll(){
		$model = new Model_Books();
		$model->deleteAll();
		header('Location: http://example/books');
	}

	function edit_get(){
		$id = $_GET["id"];
        $id = (int) $id; 
		if(is_int($id)){
			$model = new Model_Books();
		    $books = $model->getRowById($id);
		    $this->setModel('books',$books);

		    $this->view('add_form');
		}
	}

	function edit_post(){
	    $id = $_POST["Id"];
	    $id = (int) $id;
	    if(is_int($id)){
	    	 $model = new Model_Books();
		     $model->getRowById($id);

	         $field = array('name' => $_POST["Name"],
    	           'description' => $_POST["Description"],
    	           'date' => $_POST["Date"],
    	           'autor' => $_POST["Autor"],
    	           'pages' => $_POST["Pages"]
    	     );
  	         foreach ($field as $key => $value) {
    	          if(!empty($value)){
                       $model->$key = $value;
    	          }
             }	     
            $model->update($id);
	    }
	    header('Location: http://example/books');
   }



 }
?>