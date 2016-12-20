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
    public function indexAction( )
    {
        /** @var Yee\Yee $yee */
        $app = $this->getYee();

        if (isset($_SESSION['isLogged']) === false) {

	        $data = array(
	            "title"     => "Signup",
	        );
        	$app->render('signup.twig', $data);
        }
        else
        {
        	$app->redirect("/");
        }
    }


 	/**
     * @Route('/signuptwo')
     * @Name('post.index')
     * @Method('post') 
     */
    public function signUpAction( )
    {
        
        /** @var Yee\Yee $yee */
        $app = $this->getYee();
        
        // --------------> POST variables <-------------
        $emailSignup    = $app->request->post('emailSignup');
        $passSignup     = $app->request->post('passSignup');
        $passConfSignup = $app->request->post('passConfSignup');
        $fnameSignup    = $app->request->post('fnameSignup');
        $lnameSignup    = $app->request->post('lnameSignup');

        // Create instance of App\Models\SignupModel;
        $signupModel = new SignupModel($emailSignup,$passSignup,$passConfSignup,$fnameSignup,$lnameSignup);
    
         if (!$signupModel->validate()) {
            
            $error = "Invalid Email/Password";
        } 
        else if (!$signupModel->checkUserDb()){
            $error = "Email is already exists";
        }

        if ( !isset($error) ) {
            // Registration new account
            $signupModel->register();

             $data = array(
                'title'         => "Login",
                'succ'          => 'Your registration is successful!',
            );
            $app->redirect('/login');
            
        } else{
            $data = array(
                'title'         => "SignupController",
                'error'         => $error,
                );
            
            $app->render('/signupErr.twig', $data);
        }
    }
}