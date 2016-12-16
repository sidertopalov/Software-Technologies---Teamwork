<?php 

use Yee\Managers\Controller\Controller;
use Yee\Managers\CacheManager;
use App\Models\ArticleModel;
use App\Models\CategoryModel;

class ArticleController extends Controller {

    /**
     * @Route('/article')
     * @Name('article.index')
     */
    public function indexAction() {

        /** @var Yee\Yee $yee */
        $app = $this->getYee();

        if (isset($_SESSION['isLogged']) === true) {

            
            $categoryModel = new CategoryModel();

            $categorys = $categoryModel->getCategory();

            $javascript = array(
                '/js/addArticle.js',
                );



            $data = array(
                'title'             => 'Add Article',
                'javascript'        => $javascript,
                'categoryDetails'   => $categorys,
                );

            $app->render('addArticle.twig', $data);
     
        } else {

            $app->redirect('/login');
        }
    }



    /**
     * @Route('/articleList')
     * @Name('article.index')
     */
    public function listArticles() {

        /** @var Yee\Yee $yee */
        $app = $this->getYee();

        if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
        
            $app->redirect("/account");
        }

        $article = new ArticleModel();

        // order by date ASC
        $commentsList = $article->getComments();

        // order by date DESC
        $commList = array_reverse($commentsList);

        // var_dump();
        // die;

        $data = array(
                'title' => 'List of Articles',
                'commentDetails' => $commList,
                );

        $app->render('articleList.twig',$data);
    }
}