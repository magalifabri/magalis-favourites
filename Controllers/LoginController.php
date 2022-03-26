<?php

class LoginController
{
    private LoginModel $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel;
    }


    public function login()
    {
        if (!empty($_POST)) {
            if (
                $this->loginModel->validate()
                && $this->loginModel->authenticate()
            ) {
                header('Location: index.php?page=admin');
                exit();
            }
        }

        require_once 'Views/login.php';
    }
}
