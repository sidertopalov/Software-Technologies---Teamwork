<?php

use Yee\Managers\Controller\Controller;
use Yee\Managers\CacheManager;
use App\Models\CategoryUserModel;

// Category Controller for Users...

class CategoryUsersController extends Controller {  
     /**
     * @Route('/categorySelect')
     * @Name('categorySelect.index')
     */
    public function indexAction( )
    {
      
        /** @var Yee\Yee $yee */
        $app = $this->getYee();
        
        $categoryUserModel = new CategoryUserModel();
        $categoryProperty = $categoryUserModel->getCategory();

        sort($categoryProperty);

        $data = array(
            'title' => 'List of Category',
            'categoryDetails' => $categoryProperty,
          );

        $app->render('/categorySelect.twig',$data);


    }
     /**
     * @Route('/category/view/:name') 
     * @Name('updateCategory.index')
     */
    public function updateCategory($name) {

        $app = $this->getYee();
        
        $categoryName = $name;

        $categoryUserModel = new CategoryUserModel();

        // check if category exists
        $category = $categoryUserModel->getCategoryIdByName($categoryName);
        
        
        if (is_null($category)) {
            $app->redirect('/categorySelect');
        }
        
        // take all articles by category
        $articleListByCategoryId = array_reverse($categoryUserModel->getArticlesByCategory($categoryName));
        
        $data = array(
            'title' => $categoryName,
            'articleDetails' => $articleListByCategoryId,
        );

        $app->render('/categoryUserList.twig',$data);
    }


    /**
    * @Route('/read/article/:id')
    * @Name('readArticle.index')
    */
    public function readArticleAction($articleId){

        $app = $this->getYee();

        $categoryUserModel = new CategoryUserModel();

        // take article by id
        $articleDetails = $categoryUserModel->getArticleDetailsById($articleId);

        // if article doesn't exist redirect to categorySelect.
        if (is_null($articleDetails)) {
            $app->redirect('/categorySelect');
        }

        $data = array(
            'articleDetails' => $articleDetails,
        );
        $app->render('/articleRead.twig',$data);
    } 

}