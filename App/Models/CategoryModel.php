<?php

namespace App\Models;

// Admin Panel Model

class CategoryModel {

	   
    public function addCategory($category) {

        $app = \Yee\Yee::getInstance();

        $data = array(
            'category' => $category,
        );

        $app->db['default']->insert('categories',$data);
    }

    public function getCategory() {
    
        $app = \Yee\Yee::getInstance();

        return $app->db['default']->get('categories');
    }

    public function isExistCategory($categoryName) {

        $app = \Yee\Yee::getInstance();

        if ($app->db['default']->where('category',$categoryName)->getOne('categories')) {
            return true;
        }
        return false;

    }

    public function getCategoryById($id) {

        $app = \Yee\Yee::getInstance();

        return $app->db['default']->where('id',$id)->getOne('categories');
    }

    public function updateCategoryById($id, $name) {

        $app = \Yee\Yee::getInstance();

        $data = array(
            'category' => $name,
        );

        return $app->db['default']->where('id',$id)->update('categories',$data);
    }

    public function deleteCategory($id) {

        $app = \Yee\Yee::getInstance();

        $category = $this->getCategoryById($id);
        $app->db['default']->where('category', $category['category'])->delete('articles');
        $app->db['default']->where('id',$id)->delete('categories');
    }
}