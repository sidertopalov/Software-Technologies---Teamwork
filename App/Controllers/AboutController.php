<?php

use Yee\Managers\Controller\Controller;
use Yee\Managers\CacheManager;

class AboutController extends Controller
{
     /**
     * @Route('/about')
     * @Name('home.index')
     */
    public function indexAction( )
    {
        /** @var Yee\Yee $yee */
        $app = $this->getYee();
        $data = array(
            "title"     => "About",
        );
        $app->render('about.twig', $data);
    }

}
