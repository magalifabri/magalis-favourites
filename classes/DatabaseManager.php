<?php

class DatabaseManager
{
    public PDO $connection;

    public function __construct()
    {
        // $dbParams = parse_url("postgres://rdrpgzetkswtrq:e748744bacea6156695a414e71ce21fa9acc90cb8e00ed121d212e5937f6f5d1@ec2-54-73-178-126.eu-west-1.compute.amazonaws.com:5432/d5t1vau8vj18om");

        // $this->connection = new PDO(
        //     "pgsql:
        //     host={$dbParams['host']};
        //     port={$dbParams['port']};
        //     dbname=" . ltrim($dbParams["path"], "/") . ";",
        //     $dbParams['user'],
        //     $dbParams['pass']
        // );
        $this->connection = new PDO(
            'mysql:
            host=localhost;
            port=3306;
            dbname=recommendations;',
            'root',
            'root'
        );

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
}
