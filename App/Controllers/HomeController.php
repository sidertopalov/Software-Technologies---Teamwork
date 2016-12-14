<?php

use Yee\Managers\Controller\Controller;
use Yee\Managers\CacheManager;

class HomeController extends Controller
{
     /**
     * @Route('/(home)')
     * @Name('home.index')
     */
    public function indexAction( )
    {
        /** @var Yee\Yee $yee */
        $app = $this->getYee();
        $data = array(
            "message"   => "This is home controller!",
            "title"     => "Home",
            );
        $app->render('home.twig', $data);
    }

}
