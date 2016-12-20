<?php
namespace App\Models;

use App\Models\CategoryModel;

class CategoryUserModel extends CategoryModel
{

	private $app;
	
	public function __construct()
	{
		$this->app = \Yee\Yee::getInstance();
	}

	public function getCategoryIdByName($categoryName) {

		$app = $this->app;

		$result = $app->db['default']->where('category',$categoryName)->getOne('categories');

		return $result;
	}

	public function getArticlesByCategory($category){

		$app = $this->app;

		return $app->db['default']->where('category',$category)->get('articles');
	}

	public function getArticleDetailsById($articleId) {

		$app = $this->app;

		return $app->db['default']->where('id',$articleId)->getOne('articles');

	}

}