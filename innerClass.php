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

    public function __construct () {
        echo '<strong style=\'font-size: 20px\'>Instanciamos um novo objeto !</strong><br />';
    }

    public function __destruct () {
        echo '<strong style=\'font-size: 20px\'>Destruimos o objeto !</strong>';
    }

    public function getHello()
    {
        return $this->hello;//IEny2Mil16
    }

    public function __get($attr){

        echo "Nao existe um atributo com o nome '<strong style='font-size: 30px'>".$attr."'!'</strong>";

    }

    public function __set($attr,$valor){

        echo "O valor do atributo '<strong style='font-size: 30px'>".$attr."' eh $valor!'</strong>";

    }

    /**
     * @param string $hello
     */
    public function setHello($hello)
    {
        $this->hello =  $hello;
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

    public function toArray() {
        $array = get_object_vars ( $this );
        foreach ( $array as $key => $value ) {
            if (is_object ( $value )) {
                $array [$key] = $value->toArray ();
            } else {
                $array [$key] = $value;
            }
        }

        return $array;
    }
}


$request = new Request();
$obj = new innerClass();
////print_r($obj->toArray(),false);exit;
//$obj->setHello($request->getParameter('nome'));
//$arrayComum = array();
//$obj->selva = "Brasil";
//$obj->selva;
echo $obj->getHello();
//echo "<hr />";
//$objBarra = new \tresrisolution\Entidades\AtivoCorrigidoEntity();
//$objArr = new \tresrisolution\Classes\ArrayList();
////$objBarra->abertura = array('Banana','Laranja','Goiaba');
////$objArr->append();
// //array_push($arrayComum,$objBarra->abertura);
////$objBarra->abertura = "Brasil";
//$arrayComum = $objBarra;
//$ultDH = 5;
//$arrayComum->codigo = 1981;
//$arrayComum->dh = '12:00:00';
//echo "<pre>";
//print_r($arrayComum);
//echo "<hr />";
//for($i =0; $i < count($arrayComum) && $arrayComum->dh > $ultDH; $i++ ){
//    array_push($arrayComum, $arrayComum->codigo);
//    array_push($arrayComum, $arrayComum->dh);
//}
//
//print_r($arrayComum);
//$frutas = array('Banana','Laranja','Goiaba');
//$barra = new \tresrisolution\Classes\Barra();
//echo "<pre>";
//print_r($barra);
//echo "</pre>";
//echo "<hr />";
//$barra->abertura = 'Show do ano';
//$barra->data = '15/10/2015';
//$barra->hora = '10:00:00';
//$barra->volume = 30000;
//$barra->maxima = 80000;
//$objBarra = new \tresrisolution\Classes\ArrayList($barra);
//$res = array();
//foreach($objBarra as $key => $b){
//    if(empty($b))
//        $res[] = $key.' - Vazio';
//    else
//    $res[] = $key.' - '.$b;
//}
//echo "<hr />";
//for($i = 0; $i < $objBarra->count(); $i++){
//
//    echo $res[$i]."<br />";IEny2Mil16
//}
//$diretorio = new DirectoryIterator(dirname(__FILE__));
//
//while($diretorio->valid()){
//    echo $diretorio->getFilename()."<br />";
//    $diretorio->next();
//}
if(isset($_GET['nome'])){
    $obj->setHello($request->getParameter('nome'));
}
/*** a simple array ***/
$array = new \tresrisolution\Classes\Barra();

/*** create the array object ***/
$arrayObj = new \tresrisolution\Classes\ArrayList($array);



/*** append a value to the array ***/
$arrayObj->offsetSet('hoje', $obj->getHello());
$arrayObj->natcasesort();
/*** iterate over the array ***/
for($iterator = $arrayObj->getIterator();
    /*** check if valid ***/
    $iterator->valid();
    /*** move to the next array member ***/
    $iterator->next())
{
    /*** output the key and current array value ***/
    echo $iterator->key() . ' -> ' . $iterator->current() . '<br />';
}


echo '<h4>'.date('d/m/Y ', strtotime($arrayObj->offsetGet('hoje'))).'</h4>';

echo '<hr />';

$data = "2015-07-31";
$hora = "13:45:00-03";

$data = str_replace('-','',substr($data,0,10));
$hora = str_replace('-','',substr($hora,0,8));

echo $hora;