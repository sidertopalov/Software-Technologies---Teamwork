<?php

use Yee\Managers\Controller\Controller;
use Yee\Managers\CacheManager;
use App\Models\AjaxModel;
use App\Models\AccountModel;
use App\Models\ArticleModel;
use App\Models\CategoryModel;

class AjaxController extends Controller{


    /**
     * @Route('/ajax/login')
     * @Name('post.index')
     * @Method('post') 
     */
    public function loginAction() {

        /** @var Yee\Yee $yee */
        $app = $this->getYee();

        $baseUrl = \Yee\Yee::getDefaultSettings();

        $loginEmail   = $app->request->post('loginEmail');        
        $loginPass    = $app->request->post('loginPass');
        
        // Create instance of App\Models\Ajax\AjaxModel;
        $ajaxModel = new AjaxModel($loginEmail, $loginPass);
        
        if (!$ajaxModel->validateLogin()) {

            $error = "Fail to join! Check your email/password.";
        }
        if(isset($error)) {

            $data = array(
                "title"         => "AjaxControllerFail",
                'redirectTo'    => "/account",
                'message'       => $error,
                'error'         => false,
                );

        } else {
            $userProperty = $ajaxModel->userProperty();

            $_SESSION['isLogged'] = true;
            $_SESSION['userEmail'] = $loginEmail;
            $_SESSION['isAdmin'] = $userProperty['is_admin'];

            $data = array(
                "title"         => "AjaxControllerSuccess",
                'redirectTo'    => "/account",
                'message'       => "Hello, $loginEmail",
                'success'       => true,
                'error'         => true,
                );
        }

        echo json_encode( $data );
    }
    /**
     * @Route('/ajax/updateAccount')
     * @Name('post.index')
     * @Method('post')
     */
    public function postUpdateMyAccount() {

        $app = $this->getYee();

        // POST Variables
        $firstName = $app->request()->post('firstName');
        $lastName = $app->request()->post('lastName');

        $model = new AccountModel($firstName,$lastName);
        $userProperty = $model->getAccountDetails();

        if ( ( $userProperty['first_name'] === $firstName && $userProperty['last_name'] === $lastName ) && ( empty($pass) > 0 ) ) {

            $error = "There is no new date for update.";
        }

        if(strlen($firstName) < 4 ) {

            $error = "First name must contain at least 4 characters";
        }

        if(strlen($lastName) < 4 ) {

            $error = "Last name must contain at least 4 characters";
        }

        if (isset($error) == false) {

            $model->updateAccount();
        }

        if(isset($error)) {

            $data = array(
                'message'       => $error,
                'error'         => false,
            );

        } else {

            $data = array(
                'message'       => "Successfully updated!",
                'success'       => true,
                'error'         => true,
            );
        }

        echo json_encode( $data );
    }

    /**
     * @Route('/ajax/changePass')
     * @Name('post.index')
     * @Method('post')
     */
    public function postChangePassword() {

        $app = $this->getYee();


        $oldPass = $app->request()->post('pass');
        $newPass = $app->request()->post('newPass');
        $passConf = $app->request()->post('passConf');

        $model = new AccountModel();
        $userProperty = $model->getAccountDetails();

        $oldPassMatch = $userProperty['password'] == $oldPass;

        if (!$oldPassMatch) {

            $error = "Old password is wrong.";
        }

        if ( !$model->validatePassword($newPass,$passConf) ) {

            $error = "Password do not match.";
        }

        if(isset($error)) {

            $data = array(
                'message'       => $error,
                'error'         => false,
            );

        } else {

            $model->updatePassword($newPass);

            $data = array(
                'message'       => "Successfully updated!",
                'success'       => true,
                'error'         => true,
            );
        }

        echo json_encode( $data );
    }


    
    /**
     * @Route('/ajax/article')
     * @Name('article.index')
     * @Method('post')
     */
    public function postAddArticleAction() {

        /** @var Yee\Yee $yee */
        $app = $this->app;

        //------> POST Variables <-------
        $articleTitle = $app->request()->post('titleArticle');
        $articleContent = $app->request()->post('contentArticle');
        $categoryName = $app->request()->post('selectId');

        $article = new ArticleModel();

        if( 3 > strlen($articleTitle) && strlen($articleTitle) < 64) {

            $error = "Title must be atleast 3 characters.";
        }

        if ( empty($articleContent) == true ) {
            
            $error = "Content text cant be empty.";
        }

        if (isset($error) == false) {

            if(!$article->addComment($articleTitle, $articleContent, $categoryName)){
                $error = "Don't try to down my DB sucker!";
            }
        }

        if(isset($error)) {

            $data = array(
                'message'       => $error,
                'error'         => false,
                );


        } else {

            $data = array(
                'message'       => "Succesfully updated!",
                'success'       => true,
                'error'         => true,
                'redirectTo'    => "/category/view/". $categoryName,
            );
        }
        
        echo json_encode( $data );
    }

        /**
     * @Route('/ajax/category')
     * @Name('category.index')
     * @Method('post')
     */
    public function postAddCategoryAction() {

        /** @var Yee\Yee $yee */
        $app = $this->app;

        //------> POST Variables <-------
        $newCategory = $app->request()->post('newCategory');

        $categoryModel = new CategoryModel();

        if ($newCategory != "") {
            if ($categoryModel->isExistCategory($newCategory)) {
                $error = "Category already exist!";
            }
        } else {
            $error = "Wrong data.Check your field";
        }

        if (isset($error) == false) {
            $categoryModel->addCategory($newCategory);
        }

        if(isset($error)) {
            $data = array(
                'message'       => $error,
                'error'         => false,
                );
        } else {
            $data = array(
                'message'       => "Succesfully updated!",
                'success'       => true,
                'error'         => true,
                );
        }
        
        echo json_encode( $data );
    }

    /**
     * @Route('/ajax/categoryUpdate')
     * @Name('category.index')
     * @Method('post')
     */
    public function postUpdateCategoryAction() {

        /** @var Yee\Yee $yee */
        $app = $this->app;

        //------> POST Variables <-------
        $categoryId = $app->request()->post('categoryId');
        $categoryName = $app->request()->post('categoryName');

        $categoryModel = new CategoryModel();
        
        $categoryModel->updateCategoryById($categoryId, $categoryName);

        if(isset($error)) {

            $data = array(
                'message'       => $error,
                'error'         => false,
            );
        } else {

            $data = array(
                'message'       => "Succesfully updated!",
                'success'       => true,
                'error'         => true,
            );
        }
        echo json_encode( $data );
    }

    /**
     * @Route('/ajax/categoryDelete')
     * @Name('category.index')
     * @Method('post')
     */
    public function postDeleteCategoryAction() {

        /** @var Yee\Yee $yee */
        $app = $this->app;
        
        //------> POST Variables <-------
        $categoryId = $app->request()->post('categoryId');

        $categoryModel = new CategoryModel();

        $categoryModel->deleteCategory($categoryId);

        if(isset($error)) {

            $data = array(
                'message'       => $error,
                'error'         => false,
                );
        } else {

            $data = array(
                'message'       => "Succesfully updated!",
                'success'       => true,
                'error'         => true,
            );
        }
        
        echo json_encode( $data );
    }
}

