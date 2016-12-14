<?php

namespace App\Models;
use  Doctrine\ORM\Mapping as ORM;


/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Account\Repository\UserRepository")
 */

class AccountModel {


    private $firstName;
    private $lastName;
    private $app;

    public function __construct($firstName="",$lastName="") {

        $this->app = \Yee\Yee::getInstance();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getAccountDetails() {

        $app = $this->app;
        return $app->db['default']->where("email", $_SESSION['userEmail'])->getOne('users');
    }



    public function updateAccount() {

        $app = $this->app;



        $data = array(
            'firstName' => $this->firstName,
            'lastName'=> $this->lastName,
        );


        $app->db['default']->where('email',$_SESSION['userEmail'])->update('users',$data);

    }

    public function validatePassword($pass,$passConf) {

        $pass = trim($pass);
        $passConf = trim($passConf);
        $regex = "/[a-zA-Z0-9]/";

        if (strlen($pass) > 2 && strlen($pass) <= 20) {

            if (preg_match($regex, $pass)) {
                if ($pass == $passConf) {
                    return true;
                }
            }
        }
        return false;
    }

    public function updatePassword($newPass) {

        $app = $this->app;

        $data = array(
            'password' => $newPass,
        );

        $app->db['default']->where('email',$_SESSION['userEmail'])->update('users',$data);
    }
}

?>