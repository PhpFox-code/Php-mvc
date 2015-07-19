<?php

Abstract Class Model_Base {

	protected $db;
	protected $table; // имя таблицы
	private $dataResult;  // результат запроса к бд
	
	public function __construct() {

		global $dbObject;
		$this->db = $dbObject;
		
		$modelName = get_class($this);  	// имя модели
		$arrExp = explode('_', $modelName);
		$this->table = strtolower($arrExp[1]);   // имя таблицы
	}	
	
	// получить имя таблицы
	public function getTableName() {
		return $this->table;
	}
	
	// получить все записи
	function getAllRows(){
		if(!isset($this->dataResult) OR empty($this->dataResult)){
			$stmt = $this->db->query("SELECT * FROM $this->table");
			$this->dataResult = $stmt->fetchAll();
			$this->dataResult = $this->getList($this->dataResult);
		}
        return $this->dataResult;
	}
	
	// получить запись по id
	function getRowById($id){
		$stmt = $this->db->query("SELECT * from $this->table WHERE id = $id");
		$row = $stmt->fetchAll();
		if(empty($row)){
			die("<h1>Id not found !</h1>");
		}
		$row = $this->getList($row);
		return $row;
	}
	
	// запись в базу данных
	public function save() {
		$arrayAllFields = array_keys($this->fieldsTable()); // взять клучи из моделей
		$arrayData = array(); // массив для хранения значений полей моделей

		foreach($arrayAllFields as $field){   // для каждого поля
			if(!empty($this->$field)){
				$arrayData[] = $this->$field;   // получить значение поля и записать в массив
			}else{
				die("<h1>Error: You Must complete all fields</h1>");
			}
		}

		$forQueryFields =  implode(', ', $arrayAllFields);   
		$rangePlace = array_fill(0, count($arrayAllFields), '?');
		$forQueryPlace = implode(', ', $rangePlace);
		
		$stmt = $this->db->prepare("INSERT INTO $this->table ($forQueryFields) values ($forQueryPlace)");  
		$result = $stmt->execute($arrayData);
		if(!$result){
			die("<h1>Error: When data is written to the database error occurred</h1>");
		}
	}

	// удалить запись по id
    public function deleteById($var_id = 0)
    {
     	if(empty($var_id)){
		 	die("<h1>Error: Id is Empty!</h1>");
		}
		$result =  $this->db->exec("DELETE FROM $this->table WHERE `id` = $var_id");
		if(!$result){
			die("<h1>Error: An error occurred while removing </h1>");
		}
    }

    // удаление всех записей
    public function deleteAll()
    {
		$result =  $this->db->exec("DELETE FROM $this->table WHERE true");
		if(!$result){
			die("<h1>Error: An error occurred while removing </h1>");
		}

    }

	// обновление записи по ID
	public function update($var_id = 0){
		 if(empty($var_id)){
		 	 die("<h1>Error: Id is Empty!</h1>");
		 }
		$arrayAllFields = array_keys($this->fieldsTable());
		$arrayForSet = array();
		foreach($arrayAllFields as $field){
			if(!empty($this->$field)){
				$arrayForSet[] = $field . ' = "' . $this->$field . '"';
			}else{
			   die("<h1>Error: You Must complete all fields</h1>");
			}
		}
		
		$strForSet = implode(', ', $arrayForSet);
		$stmt = $this->db->prepare("UPDATE $this->table SET $strForSet WHERE `id` = $var_id");  
		$result = $stmt->execute();
		if (!$result) {
			die("<h1>Error: Data not update</h1>");
		}
	}

    // сформировать удобный формат для вывода 
	private function getList($var){
	  if(!empty($var)){
		foreach ($var as $key_1 => $value) {
			foreach ($value as $key => $value) {
				if(is_string($key)){
					$row[$key] = $value;
				}
			}
            $rowss[$key_1] = $row;
		}
		if(isset($rowss)){
			return $rowss;
		}
      }
      return null;
	}
}