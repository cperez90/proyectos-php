<?php

namespace Core;

use Core\Dao\UserDao;

class Authenticator
{
    private UserDao $userDao;

    public function __construct(UserDao $userDao)
    {
        $this->userDao = $userDao;
    }
    public function attempt($email, $password)
    {
        $user = $this->userDao->findByEmail($email);
        if ($user) {
            if (password_verify($password, $user['password'])){
                $this->login($user);

                return true;
            }
        }

        return false;
    }

    public function login($user): void
    {
        if (!$user || !is_array($user)) {
            throw new \Exception("login recibió un usuario inválido.");
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

    }
}