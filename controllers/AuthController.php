<?php

use Delight\Auth\InvalidEmailException;
use Delight\Auth\InvalidPasswordException;
use Delight\Auth\TooManyRequestsException;
use Delight\Auth\UserAlreadyExistsException;
use Delight\Auth\DuplicateUsernameException;

class AuthController
{

    public function processregistration($auth)
    {
        try {
            $username = $_POST['username'];
            if (preg_match('/[\x00-\x1f\x7f\/:\\\\]/', $username) === 0) {
                $userId = $auth->registerWithUniqueUsername($_POST['email'], $_POST['password'], $username, function ($selector, $token) {
                    $url = 'https://www.example.com/verify_email?selector=' . urlencode($selector) . '&token=' . urlencode($token);
                    // TODO: Send URL to the user through email
                });
            }
        } catch (InvalidEmailException $e) {
            die('Invalid email address');
        } catch (InvalidPasswordException $e) {
            die('Invalid password');
        } catch (UserAlreadyExistsException $e) {
            die('User already exists');
        } catch (TooManyRequestsException $e) {
            die('Too many requests');
        } catch (DuplicateUsernameException $e) {
            die('Username already exists');
        }
        header("Location: " . WWW_ROOT . "/index.php");
    }

}