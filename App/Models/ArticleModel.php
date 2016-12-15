<?php

namespace App\Models;

class ArticleModel {

  private $app;

  public function __construct() {

    $this->app = \Yee\Yee::getInstance();

  }

  public function addComment($articleTitle, $articleContent, $categoryId) {

    $app = $this->app;
    
    $email = $_SESSION['userEmail'];
    $dateTimeNow = date("Y-m-d H:i:s");

    $data = array(

      'title' => $articleTitle,
      'author_id' => $email,
      'date' => $dateTimeNow,
      'content' => $articleContent,
      'category_Id' => $categoryId,

      );

    if( $app->db['default']->insert('article',$data) ) {
      return true;
    }
    return false;

  }

  public function getComments(){

    $app = $this->app;

    return $app->db['default']->get('article');
  }
}