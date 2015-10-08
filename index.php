
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

echo "<hr />";
$data = new DateTime();

$hora = $data->format('His');

echo "Hora atual: ". $hora;
echo "<br />Minutos: ".$data->format('i');

echo "<h4>Utilizando minha classe </h4>";

$dh = new \Classes\Data();

echo $dh->getHora().':'.$dh->getMinuto().':'.$dh->getSegundo();

$matches = '< Vamos que vamos!><';
echo "<br />";
echo preg_replace("/^</", "abretag", $matches);

if(preg_match('/<$/',$matches)){
    echo "OK";
}else{
    echo "Nok";
}
echo "<hr/>";
$alerta;
$alerta2 = [1,2,3];

$alerta = $alerta2;//['atençao','cuidado','perigo'];
$alerta2 = ['Brasil','Argentina','Canadá'];
echo "<pre>";
print_r($alerta);
echo "<hr/>";
print_r($alerta2);

        $texto = "banana,maçã,laranja";

		$frutas[] = explode(",",$texto);
        print_r($frutas);
		echo $frutas[0][0]; //imprime banana
       // echo $frutas[1]; //imprime maçã
		//echo $frutas[2]; //imprime laranja















