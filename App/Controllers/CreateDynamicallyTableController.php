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

    	$createTableModel = new CreateTableModel();
    	$createTableModel->checkIfTableExistIfNotCreateIt();

    	echo "Your database is ready! <br><a href='/home'>Home page</a>";
	}
}