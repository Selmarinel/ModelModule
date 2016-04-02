<?php

class Config
{
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '123';
    const DB_BASE = 'test_job';
    private $link;

    public function __construct()
    {
        $last = error_reporting();
        error_reporting(E_ERROR);
        $this->link = mysqli_connect(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_BASE);
        error_reporting($last);
    }

    public function getSource()
    {
        return $this->link;
    }
}