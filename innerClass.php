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
require 'Classes'.DS.'AutoLoad.php';
use Classes\Autoload;
use Classes\Request;

class innerClass
{
    private $hello;

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
        $this->hello = "Olá". $hello." !!!";
    }

}

$autoLoad = new AutoLoad();
$autoLoad->setPath(ROOT);
$autoLoad->setExt('php');

spl_autoload_register(array($autoLoad, 'load'));

$request = new Request();

$obj = new innerClass();
$obj->setHello($request->getParameter('nome'));

echo $obj->getHello();