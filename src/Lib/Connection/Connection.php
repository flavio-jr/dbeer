<?php

namespace Dbeer\Lib;

use Dbeer\Contracts\Connection\DBConnection;
use Dbeer\Contracts\Connection\ConnectionBuilder;
use PDO;
use Dbeer\Exceptions\Connection\NotSupportedDatabase;

class Connection implements DBConnection
{
    /**
     * @var string
     */
    private $host = '127.0.0.1';

    /**
     * @var string
     */
    private $port;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $database;

    /**
     * @var string
     */
    private $dbName;

    private $supportedDatabases = [
        'mysql',
        'pgsql'
    ];

    public function host(string $host): DBConnection
    {
        $this->host = $host;
        return $this;
    }

    public function port(string $port): DBConnection
    {
        $this->port = $port;
        return $this;
    }

    public function user(string $user): DBConnection
    {
        $this->user = $user;
        return $this;
    }

    public function password(string $pass): DBConnection
    {
        $this->password = $pass;
        return $this;
    }

    public function database(string $db): DBConnection
    {
        $this->database = $db;
        return $this;
    }

    public function dbName(string $dbName): DBConnection
    {
        $this->dbName = $dbName;
        return $this;
    }

    public function getConnection(): PDO
    {
        if (!in_array($this->database, $this->supportedDatabases)) {
            throw new NotSupportedDatabase($this->database);
        }

        return $this->{$this->database}();
    }

    private function mysql(): PDO
    {
        return new PDO("mysql:
            {$this->dbName};
            host={$this->host};
            port={$this->port}
        ",
            $this->user,
            $this->password
        );
    }

    private function pgsql(): PDO
    {
        return new PDO("pgsql:
            host={$this->host}
            port={$this->port}
            dbname={$this->dbName}
            user={$this->user}
            password={$this->password}
        ");
    }
}
