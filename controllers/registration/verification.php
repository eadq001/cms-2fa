<?php declare(strict_types=1);

use Core\Token\Token;
use Core\Database;

// get the token
// query if the token exist
// check if it still not expired
// if it exist let the user access this page if not redirect to register page
// save the user in the users table if the otp code is correct.

$db = new Database;
$token = $_GET['token']; //get the token in the url
$tokenCheck = new Token();

$otp = [$_POST['otp-1'], $_POST['otp-2'], $_POST['otp-3'], $_POST['otp-4'], $_POST['otp-5'], $_POST['otp-6']];
$otp = (int) implode($otp); //combines all the value in the 6 input forms into 1 


// checks if the user exist in email_verification and checks if the token is expired or not.
$user = $tokenCheck->checkTokenExpiry($token);

// redirect to register page if the code already expired
if (!$user) {
    redirect('/register');
}

// proceed to verification if there is any pending code
if ($otp === $user['otp']) {
    $db->query('INSERT INTO users (username, email, password, email_verified, created_at)
    VALUES (:username, :email, :password, :email_verified, :created_at)', [
        'username' => $user['username'],
        'email' => $user['email'],
        'password' => $user['password'],
        'email_verified' => 1,
        'created_at' => $user['created_at']
    ]);

    // delete temporary row generated for verification
    $db->query('DELETE FROM email_verifications WHERE id = :id', ['id' => $user['id']]);

    // alert the user being verified and redirect to login page
    redirect('/login');
    } else {
    redirect("/verify_email?token={$token}");
    // dd('wrong otp');
}

?>