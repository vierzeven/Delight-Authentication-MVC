<?php

use Delight\Auth\InvalidEmailException;
use Delight\Auth\InvalidPasswordException;
use Delight\Auth\TooManyRequestsException;
use Delight\Auth\UserAlreadyExistsException;

class AuthController
{

    public function processregistration($auth)
    {
        try {
            $username = $_POST['username'];
            if (preg_match('/[\x00-\x1f\x7f\/:\\\\]/', $username) === 0) {
                $userId = $auth->registerWithUniqueUsername($_POST['email'], $_POST['password'], $username, function ($selector, $token) {
                    echo 'Send ' . $selector . ' and ' . $token . ' to the user (e.g. via email)';
                });
                echo 'We have signed up a new user with the ID ' . $userId;
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
    }

}