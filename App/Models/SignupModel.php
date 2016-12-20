<?php

namespace App\Models;

class SignupModel 
{
	private $email;
	private $pass;
	private $confPass;
	private $fname;
	private $lname;
	private $app;

	public function __construct($username, $pass, $confPass, $fname, $lname) {
		$this->app 		 = \Yee\Yee::getInstance();
		$this->email  	 = $username;
        $this->pass 	 = $pass;
        $this->confPass  = $confPass;
        $this->fname  	 = $fname;
        $this->lname  	 = $lname;
	}

	/**
	* Checks for a valid email format.
	*
	* @return boolean true if the email format is valid.
	*/
	public function isEmail() {

		if(filter_var(trim($this->email), FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}

	/**
	* Checks if password format and $pass are equal(==) to $confPass.
	*
	* @return boolean true if $pass == $confPass and the format are correct.
	*/
	public function checkPass() {
		$pass = trim($this->pass);
		$confPass = trim($this->confPass);
		$regex = "/[a-zA-Z0-9]/";
		if (strlen($pass) > 5 && strlen($pass) <= 20 ) {
			
			if (preg_match($regex, $pass)) {
				if ($pass == $confPass) {
					return true;
				}
			}
		}
		return false;
	}

	/**
	* Helper method calls isEmail() and checkPass().
	*
	* @var boolean true if the email and  the password are correct.
	*/
	public function validate() {
		
		if (!$this->isEmail()) {
			return false;
		}
		if (!$this->checkPass()) {
			return false;
		}
		return true;
	}

	/**
	* Check database if this $email has already existed or hasn't
	*
	* @return boolean true if $email doesn't exist in the database
	*/
	public function checkUserDb() {
		$app = $this->app;
		$isUserExist = $app->db['default']->where('email',$this->email)->getOne('users');
		if (!is_null($isUserExist)) {
			return false;
		}
		return true;
	}

	/**
	* Converts $pass in md5 hash
	*
	* @return string
	*/
	public function hashpassword() {
		return md5($this->pass);
	}

	/**
	* Registers a new account. You need to use validate() and checkUserDb() functions before use register().
	*
	* @return void
	*/
	public function register() {
		$app 		 = $this->app;
		$db 		 = $app->db['default'];
		$hashpass = $this->hashpassword();
		
        $data = array(
				"email" 			=> $this->email,
				"password" 			=> $hashpass,
				"first_name" 		=> $this->fname,
				"last_name" 	    => $this->lname,
				"is_admin"			=> 0,
			);
        
		$db->insert("users", $data );
	}
}