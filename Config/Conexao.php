<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 18/09/2015
 * Time: 15:31
 */

namespace Classes\DataBase;
use \PDO;

class Conexao
{
    public static $instance;

    private function __construct() {}

    public static function getInstance()
        {
            if (!isset(self::$instance))
            {
                self::$instance = new PDO("pgsql:host=localhost dbname=cotacoes user=postgres password=morango");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
                echo "Conectou";
            }
            return self::$instance; }

}