<?php

Class Model_Books Extends Model_Base {
	
	// $id
	public $name;
	public $description;
	public $date;
	public $autor;
	public $pages;

	public function fieldsTable(){
		return array(
			'name' => 'Name',
			'description' => 'Description',
			'date' => 'Date',
			'autor' => 'AutorName',
			'pages' => 'Pages'
		);
	}
	
}