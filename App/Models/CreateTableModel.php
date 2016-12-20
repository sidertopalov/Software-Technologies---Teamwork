<?php

namespace App\Models;

/**
* Class helper for creating dynamically tables into DB
*/
class CreateTableModel
{

	private $dbTableNames = ["users" , "articles" , "article_comments", "categories"];

	public function checkIfTableExistIfNotCreateIt()
	{

		$app = \Yee\Yee::getInstance();

		$tableNames = $this->getAllTableNames();

		for ($i=0; $i < count($this->dbTableNames); $i++) { 
			$name = $this->dbTableNames[$i];
			if (!in_array($name, $tableNames)) {
				$this->createTable($name);
				sleep(0.5);
			}
		}
		return $this;
	}

	private function getAllTableNames()
	{
		$app = \Yee\Yee::getInstance();
		$arr = [];
		$tables = $app->db['default']->query('SHOW TABLES FROM softuni');
		foreach ($tables as $key => $value) {
			foreach ($value as $kk => $vv) {
				$arr[] = $vv;	
			}
		}
		return $arr;
	}

	public function createTable($name, $database='default')
	{
		$app = \Yee\Yee::getInstance();

		switch ($name) {
			case 'users':
				$app->db[$database]->query("CREATE TABLE IF NOT EXISTS `users`
						(
							user_id int NOT NULL AUTO_INCREMENT,
							first_name varchar(50),
							last_name varchar(50),
							email varchar(50) NOT NULL,
							password varchar(50) NOT NULL,
							is_admin int(1) NOT NULL,
							PRIMARY KEY (user_id)
						)"
				);
				break;
			case 'articles':
				$app->db[$database]->query("CREATE TABLE IF NOT EXISTS `articles` (
						  id int(11) NOT NULL AUTO_INCREMENT,
						  title varchar(64) NOT NULL,
						  author_id varchar(80) NOT NULL,
						  date datetime NOT NULL,
						  content text NOT NULL,
						  category varchar(50) NOT NULL,
						  PRIMARY KEY (id)
						)"
				);
				break;
			case 'article_comments':
				$app->db[$database]->query("CREATE TABLE IF NOT EXISTS `article_comments` (
					  	id int(11) NOT NULL AUTO_INCREMENT,
					  	question_id int(11) NOT NULL,
						author_id varchar(80) NOT NULL,
						comment text NOT NULL,
						PRIMARY KEY (id)
					)"
				);
				break;		
			case 'categories':
				$app->db[$database]->query("CREATE TABLE IF NOT EXISTS `categories`
						(
							id int NOT NULL AUTO_INCREMENT,
							category varchar(50) UNIQUE,
							PRIMARY KEY (id)
						)"
				);
				break;
			default:
				
				break;
		}
	}
}