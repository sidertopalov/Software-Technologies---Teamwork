<?php

use Yee\Managers\Controller\Controller;
use Yee\Managers\CacheManager;
//use App\Models\AjaxModel;

class LoginController extends Controller
{
     /**
     * @Route('/login')
     * @Name('login.index')
     */
    public function indexAction( )
    {
       /** @var Yee\Yee $yee */
        $app = $this->getYee();
           
        if (isset($_SESSION['isLogged']) === false) {
        
             $javascript = array(

                 '/js/login.js',
                
                 );

            $data = array(

                "title"         => "Login Controller",
                "javascript"    => $javascript,

                );
            
            $app->render('login.twig', $data);
        } else {

            $app->redirect('/');
        }
    }

     /**
     * @Route('/logout')
     * @Name('login.index')
     */
    public function logoutAction()
    {
        $app = $this->getYee();

        $_SESSION['isLogged'] = false;
        $_SESSION['userEmail'] = null;

      //  session_unset();
        session_destroy();

        $app->redirect("/");
    }



}
