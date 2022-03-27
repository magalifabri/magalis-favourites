<?php

class DatabaseManager
{
    public PDO $connection;

    public function __construct()
    {
        if (!empty(getenv("DATABASE_URL"))) {
            $dbParams = parse_url(getenv("DATABASE_URL"));
        } else {
            $dbParams = parse_url("postgres://jbtztfbzbjaign:78ec6211787e5856ffa77927117ff1382906a137279d93f9b63284878d932a8e@ec2-63-32-248-14.eu-west-1.compute.amazonaws.com:5432/d8198g5t3eekd4");
        }

        $this->connection = new PDO(
            "pgsql:
            host={$dbParams['host']};
            port={$dbParams['port']};
            dbname=" . ltrim($dbParams["path"], "/") . ";",
            $dbParams['user'],
            $dbParams['pass']
        );

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
}
