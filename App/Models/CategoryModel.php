<?php

namespace App\Models;


class CategoryModel {

	   
    public function addCategory($category) {

        $app = \Yee\Yee::getInstance();

        $data = array(
            
            'name' => $category,
          );

        $app->db['default']->insert('category',$data);
    }


    public function getCategory() {
    
       $app = \Yee\Yee::getInstance();

      return $app->db['default']->get('category');
    }



    public function isExistCategory($categoryName) {

        $app = \Yee\Yee::getInstance();

        if ($app->db['default']->where('name',$categoryName)->getOne('category')) {
            return true;
        }
        return false;

    }



    public function getCategoryById($id) {

        $app = \Yee\Yee::getInstance();

        return $app->db['default']->where('id',$id)->getOne('category');
    }



    public function updateCategoryById($id,$name) {

      $app = \Yee\Yee::getInstance();

      $data = array(

            'name' => $name,
        );

      $app->db['default']->where('id',$id)->update('category',$data);
    }



    public function deleteCategory($id) {

      $app = \Yee\Yee::getInstance();

      $app->db['default']->where('id',$id)->delete('category');
    }


}