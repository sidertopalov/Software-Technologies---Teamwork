<?php

use Yee\Managers\Controller\Controller;
use Yee\Managers\CacheManager;
use App\Models\SignupModel;

class SignupController extends Controller
{

	/**
	 * @Route('/signup')
	 * @Name('signup.index')
	 */
	public function indexAction()
	{
		$app = $this->getYee();

		$signupModel = new SignupModel();
		
		$app->render('/signup.twig');
	}
}