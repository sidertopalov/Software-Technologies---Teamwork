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
		$signupModel->sayHi();
		echo "<br> Hello from SignupController! ";

	}
}