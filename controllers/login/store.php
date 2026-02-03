<?php
declare(strict_types=1);

use Core\Session;
use Core\Validator;
use Core\Authenticator;

$authenticator = new Authenticator();
$validator = new Validator();

$email = $_POST['email'];
$password = $_POST['password'];


//checks if the user exist. if it exist, checks the password if it match to the users password
if(!$authenticator->attemptLogin($email, $password)) {
    Session::flash('errors', ['user' => 'User does not exist']);
    redirect('/login');

}

// validate the forms
$validator->validateAll(email:$email, password:$password);

if(!empty($validator->errors())) {
    Session::flash('errors', $validator->errors());
    redirect('/login');
}


redirect('/home');


?>