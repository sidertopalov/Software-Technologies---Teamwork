<?php

use Yee\Managers\Controller\Controller;
use Yee\Managers\CacheManager;
use App\Models\CategoryModel;

// Category Controller for Admin...

class CategoryController extends Controller {  
     /**
     * @Route('/category')
     * @Name('categoryAdd.index')
     */
    public function indexAction( )
    {
      
        /** @var Yee\Yee $yee */
        $app = $this->getYee();

        $javascript = array(

            '/js/categoryAdd.js',
          );
        
        $data = array(

            'title' => 'New Category',
            'javascript' => $javascript,
          );

        if ( !isset($_SESSION['isLogged']) ) {

            $app->redirect('/login');   
        }

        if ($_SESSION['isAdmin']) {
          $app->render('/categoryAdd.twig',$data);

        } else {

          $app->redirect('/account'); 

        }

    }
     /**
     * @Route('/categoryUpdate/:id') 
     * @Name('updateCategory.index')
     */
     public function updateCategory($id) {

          $app = $this->getYee();
          
          $categoryId = $id;

          if ($_SESSION['isAdmin'] != 1) {
            $app->redirect('/account');
          }

          $categoryModel = new CategoryModel();
          $categoryProperty = $categoryModel->getCategoryById($categoryId);

          if ($categoryProperty == null) {
              
              $app->redirect('/categoryList');
          }


          $javascript = array(

            '/js/categoryUpdate.js',
            );


          $data = array(
            'title' => 'Update Category',
            'javascript' => $javascript,
            'categoryId' => $categoryId,
            'categoryName' => $categoryProperty['name'],
            ); 
          $app->render('/categoryUpdate.tpl',$data);
     }

     /**
     * @Route('/categoryDelete/:id') 
     * @Name('updateCategory.index')
     */
     public function deleteCategory($id) {

          $app = $this->getYee();

          if ($_SESSION['isAdmin'] != 1) {
            $app->redirect('/myProject/account');
          }

          $categoryModel = new CategoryModel();
          $categoryProperty = $categoryModel->getCategoryById($id);

          if ($categoryProperty == null) {
              
              $app->redirect('/categoryList');
          }

          $javascript = array(

            '/js/categoryDelete.js',
            );

          $data = array(
            'title' => 'Delete Category',
            'javascript' => $javascript,
            'categoryId' => $categoryProperty['id'],      
            'categoryName' => $categoryProperty['name'],
            ); 
          $app->render('/pages/categoryDelete.tpl',$data);
     }

     /**
     * @Route('/categoryList') 
     * @Name('updateCategory.index')
     */
     public function listCategory() {

            $app = $this->getYee();

            $categoryModel = new CategoryModel();
            $categoryList = $categoryModel->getCategory();

            if (!isset($_SESSION['isLogged']) ) {
                $app->redirect('/login');
            }

            if ($_SESSION['isAdmin'] != 1) {
                $app->redirect('/account');
            }

            $data = array(
                'title' => 'List Category',
                'categoryDetails' => $categoryList,
            ); 

            $app->render('/listCategory.twig',$data);
     }
}