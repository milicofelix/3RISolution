
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

$matches = 'AED_< Vamos que vamos!><';
echo "<br />";
//echo preg_replace("/^</", "abretag", $matches);

if(preg_match('/^AED_/',$matches)){
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

//        $texto = "banana,maçã,laranja";
//
//		$frutas[] = explode(",",$texto);
//        print_r($frutas);
//		echo $frutas[0][0]; //imprime banana
       // echo $frutas[1]; //imprime maçã
		//echo $frutas[2]; //imprime laranja

$licenca = "Adriano Felix de Freitas, nasceu em 1981, logo o mesmo tem 34 anos de idade, e é Desenvolvedor web desde 2006";
$listLicencas = array();

foreach( explode(',',$licenca) as $l )
{

    $listLicencas[] = $l;


}

print_r($listLicencas);

$data2 = "25-10-1982 10:45:33";
//$short_data = substr($data2,0,10);

echo "<hr/>";
echo str_replace(':','',substr($data2,11,19));
//echo $short_data;
//substr()$rs[7]->substring(0, 10)->replaceAll("-", "")

$texto = "micro-ondas-micro-ondas-micro-ondas";
$indice = (substr_count($texto, "-")+1);

        echo $texto."<br />".$indice;


$request = new \Classes\Request();

echo $request->getParameter('sobrenome');
















