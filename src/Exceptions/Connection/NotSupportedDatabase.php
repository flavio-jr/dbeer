<?php

namespace Dbeer\Exceptions\Connection;

class NotSupportedDatabase extends \Exception
{
    public function __construct(string $database)
    {
        return parent::__construct("
            Dbeer don't support this database: {$database}
        ");
    }
}
