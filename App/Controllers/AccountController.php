<?php

use Yee\Managers\Controller\Controller;
use Yee\Managers\CacheManager;
use App\Models\AccountModel;


class AccountController extends Controller {


    /**
     * @Route('/account')
     * @Name('account.index')
     */
    public function indexAction( )
    {
        /** @var Yee\Yee $yee */
        $app = $this->getYee();

        if (isset($_SESSION['isLogged']) === true) {

            $myAccount = new AccountModel();
            $accDetail = $myAccount->getAccountDetails();

            $javascript = array(
                '/js/updateAccount.js',
            );

            $data = array(
                'title' => 'Account Controller',
                'userDetail' => $accDetail,
                'javascript' => $javascript,
            );

            $app->render('/account.twig', $data);

        } else {

            $app->redirect('/login');
        }
    }


    /**
     * @Route('/changePass')
     * @Name('account.index')
     */
    public function changePassAction() {

        /** @var Yee\Yee $yee */
        $app = $this->getYee();

        if (isset($_SESSION['isLogged']) === true) {

            $myAccount = new AccountModel();
            $accDetail = $myAccount->getAccountDetails();

            $javascript = array(
                '/js/changePass.js',
            );

            $data = array(
                'title' => 'Change Password',
                'userDetail' => $accDetail,
                'javascript' => $javascript,
            );

            $app->render('/changePass.twig', $data);

        } else {

            $app->redirect('/login');
        }
    }
}