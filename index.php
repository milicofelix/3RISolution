
<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 05/10/2015
 * Time: 10:55
 */
//header('Content-Type: charset=utf-8');


define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
//include_once "banco.inc";

require 'Classes'.DS.'AutoLoad.php';
use Classes\Autoload;

$autoLoad = new AutoLoad();
$autoLoad->setPath(ROOT);
$autoLoad->setExt('php');

spl_autoload_register(array($autoLoad, 'load'));

echo "<h3>Pagina de teste</h3>";

$ativo = "LiuAED_basteao";

$posicao = strpos($ativo, 'AED_');

echo substr($ativo, $posicao);
















