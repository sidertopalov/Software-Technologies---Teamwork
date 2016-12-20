<?php

use Yee\Managers\Controller\Controller;
use Yee\Managers\CacheManager;
use App\Models\CreateTableModel;

class CreateDynamicallyTableController extends Controller
{
     /**
     * @Route('/createTablesForProject')
     * @Name('home.index')
     */
    public function indexAction( )
    {
    	$app = $this->getYee();

        if (!isset($_SESSION['isLogged']) ) {
            $app->redirect('/login');
        }

        if ($_SESSION['isAdmin'] != 1) {
            $app->redirect('/account');
        }
        
    	$createTableModel = new CreateTableModel();
    	$createTableModel->checkIfTableExistIfNotCreateIt();

    	echo "Your database is ready! <br><a href='/home'>Home page</a>";
	}
}