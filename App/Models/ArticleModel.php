<?php

namespace App\Models;

class ArticleModel {

    private $app;

    public function __construct() {

        $this->app = \Yee\Yee::getInstance();

    }

    public function addComment($articleTitle, $articleContent, $category) {

        $app = $this->app;

        $email = $_SESSION['userEmail'];
        $dateTimeNow = date("Y-m-d H:i:s");

        $data = array(
            'title' => $articleTitle,
            'author_id' => $email,
            'date' => $dateTimeNow,
            'content' => $articleContent,
            'category' => $category,
        );

        if( $app->db['default']->insert('articles',$data) ) {
            return true;
        }
        return false;

    }

    public function getComments(){

        $app = $this->app;
        return $app->db['default']->get('articles');
    }
}