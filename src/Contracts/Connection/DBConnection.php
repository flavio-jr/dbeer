<?php

namespace Dbeer\Contracts\Connection;

use Dbeer\Exceptions\Connection\NotSupportedDatabase;
use PDO;

/**
 * Contract to DB connections
 * @author Flavio
 */
interface DBConnection
{
    /**
     * @method host
     * @param string $host
     * @return self
     */
    public function host(string $host): self;

    /**
     * @method port
     * @param string $port
     * @return self
     */
    public function port(string $port): self;

    /**
     * @method user
     * @param string $user
     * @return self
     */
    public function user(string $user): self;

    /**
     * @method password
     * @param string $pass
     * @return self
     */
    public function password(string $pass): self;

    /**
     * @method database
     * @param string $db
     * @return self
     */
    public function database(string $db): self;

    /**
     * @method dbName
     * @param string $dbName
     * @return self
     */
    public function dbName(string $dbName): self;

    /**
     * Get a ready to use PDO connection object
     * @method getConnection
     * @throws NotSupportedDatabase
     * @return PDO
     */
    public function getConnection(): PDO;
}