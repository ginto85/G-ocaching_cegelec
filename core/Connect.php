<?php

namespace App\core;

use \PDO;

error_reporting(E_ALL); // report all errors

class Connect
{
    // database connection
    protected $_host = '';
    protected $_dbName = '';
    protected $_user = '';
    protected $_pass = '';

    public function connexion()
    {
        $pdo = new PDO(
            'mysql:host=' . $this->_host . ';dbname=' . $this->_dbName,
            $this->_user,
            $this->_pass
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES UTF8MB4');
        return $pdo;
    }
}
