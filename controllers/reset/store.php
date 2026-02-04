<?php declare(strict_types=1);

use Core\Token\Token;
use Core\Database;
use Core\Session;
use Core\Validator;

$validator = new Validator();
$token = $_POST['token'];
$password = $_POST['password'];
$passwordConfirm = $_POST['password_confirmation'];

$db = new Database();
$checkToken = new Token();

// checks the user token if expire or not
$user = $checkToken->checkTokenExpiry($token);

// redirect if there is no user found
if (!$user) {
    redirect('/register');
}

$validator->validateAll(password: $password, passwordConfirm: $passwordConfirm);

// redirect to the current page if there are password validation error
if (!empty($validator->errors())) {
    Session::flash('errors', $validator->errors());
    redirect("/password_reset_page?token={$token}");
}

// update the password
$db->query('UPDATE users SET password = :password WHERE email = :email', ['email' => $user['email'], 'password' => password_hash($password, PASSWORD_BCRYPT)]);

$db->query('DELETE FROM password_reset WHERE email = :email', ['email' => $user['email']]);

// clear the session
Session::destroy();

echo "<script>
    alert('Password has been updated');
    window.location.href = '/login';
</script>"

?>