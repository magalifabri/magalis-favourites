<?php

class LoginModel
{
    private DatabaseManager $dbConn;

    public function __construct()
    {
        $this->dbConn = new DatabaseManager();
    }


    public function validate(): bool
    {
        if (empty($_POST['username'])) {
            return false;
        }
        if (empty($_POST['password'])) {
            return false;
        }

        return true;
    }

    public function authenticate(): bool
    {
        $query =
            "SELECT *
            FROM magalis_favourites__users
            WHERE username = :username;";
        $stmt = $this->dbConn->connection->prepare($query);
        $stmt->bindParam(':username', $_POST['username']);
        $stmt->execute();
        $results = $stmt->fetchAll();

        if (!password_verify($_POST['password'], $results[0]['password'])) {
            return false;
        }

        $_SESSION['loggedIn'] = 1;

        return true;
    }
}
