<?php

/**
 * Created by PhpStorm.
 * User: milic
 * Date: 14/10/2015
 * Time: 10:22
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOT',dirname(__FILE__));
//
////define('ROOT',($_SERVER['HTTP_HOST'] !== 'localhost:8000')? '/home/storage/8/46/a1/apligraf/public_html/apligraf/grafico-server' : dirname(__FILE__) );
//
require 'vendor/autoload.php';

use tresrisolution\Classes\Request;

class innerClass
{
    private $hello;
    private $ambiente;
    /**
     * @return string
     */
    public function getHello()
    {
        return $this->hello;
    }

    /**
     * @param string $hello
     */
    public function setHello($hello)
    {
        $this->hello = "Olá" . $hello . " !!!";
    }

    public function ambienteInit($ambiente){

        switch($ambiente){
            case 'local':
                return $this->getcfg('localhost.cfg');
                break;
            /*FALTANDO MAPEAR*/
        }
    }

    public function getcfg($nome)
    {
        if (($hf = fopen(ROOT . DS . 'Config' . DS . $nome, 'r')) != FALSE) {
            $linha = fgets($hf);
            fclose($hf);
            return new PDO("pgsql:".$linha);
        }
        return '';
    }
}


$request = new Request();

$obj = new innerClass();
$obj->setHello($request->getParameter('nome'));

echo $obj->getHello();
echo "<br />";
print_r($obj->ambienteInit('local'));
