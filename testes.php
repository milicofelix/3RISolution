<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>HTML5 – Estrutura básica</title>
</head>
<body>
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

//$ativo = "LiuAED_basteao";
//
//$posicao = strpos($ativo, 'AED_');
//
//echo substr($ativo, $posicao);
//
//echo "<hr />";
//$data = new DateTime();
//
//$hora = $data->format('His');
//
//echo "Hora atual: ". $hora;
//echo "<br />Minutos: ".$data->format('i');
//
//echo "<h4>Utilizando minha classe </h4>";
//
//$dh = new \Classes\Data();
//
//echo $dh->getHora().':'.$dh->getMinuto().':'.$dh->getSegundo();
//
//$matches = 'AED_< Vamos que vamos!><';
//echo "<br />";
////echo preg_replace("/^</", "abretag", $matches);
//
//if(preg_match('/^AED_/',$matches)){
//    echo "OK";
//}else{
//    echo "Nok";
//}
//echo "<hr/>";
//$alerta;
//$alerta2 = [1,2,3];
//
//$alerta = $alerta2;//['atençao','cuidado','perigo'];
//$alerta2 = ['Brasil','Argentina','Canadá'];
//echo "<pre>";
//print_r($alerta);
//echo "<hr/>";
//print_r($alerta2);

//        $texto = "banana,maçã,laranja";
//
//		$frutas[] = explode(",",$texto);
//        print_r($frutas);
//		echo $frutas[0][0]; //imprime banana
       // echo $frutas[1]; //imprime maçã
		//echo $frutas[2]; //imprime laranja

//$licenca = "Adriano Felix de Freitas, nasceu em 1981, logo o mesmo tem 34 anos de idade, e é Desenvolvedor web desde 2006";
//$listLicencas = array();
//
//foreach( explode(',',$licenca) as $l )
//{
//
//    $listLicencas[] = $l;
//
//
//}
//
//print_r($listLicencas);
//
//$data2 = "25-10-1982 10:45:33";
////$short_data = substr($data2,0,10);
//
//echo "<hr/>";
//echo str_replace(':','',substr($data2,11,19));
////echo $short_data;
////substr()$rs[7]->substring(0, 10)->replaceAll("-", "")
//
//$texto = "micro-ondas-micro-ondas-micro-ondas";
//$indice = (substr_count($texto, "-")+1);
//
//        echo $texto."<br />".$indice;
//
//
//$request = new \Classes\Request();
//
//echo $request->getParameter('sobrenome');

//// Criando uma imagem truecolor, com tamanho 200px por 300px, e fundo preto
////$img = imagecreatetruecolor(200, 300);
//
//// Abrindo uma imagem JPG existente
//$arq = imagecreatefromjpeg('imagens/eu.jpg');
//
//$qualidade = 100; // valor entre 0-100
//$img = "";
//header('Content-Type: image/jpeg');
//imagejpeg($arq, null, $qualidade);
//
//$destino = 'imagens/imagem.jpg';
//$qualidade = 100; // valor entre 0-100
//
//imagejpeg($arq, $destino, $qualidade);

//echo "<h3>Convertendo temperaturas</h3>";
//
//$temperaturaClass   = new \Classes\TemperaturaClassAdapter();
//$temperatura       = new \Classes\Temperatura();
////utilizando Adapter Class
//
//$temperatura->setTemperatura(30);
//
////echo $temperatura->getTemperatura();
//echo "<br />";
////echo $temperatura->getTemperaturaFa();
//echo "<hr />";
////utilizando Adapter Object
//$temperatura->setTemperatura(86);
////$temperaturaObject->setTemperatura(86);
//$temperaturaObject  =  new \Classes\TemperaturaObjectAdapter($temperatura);
// echo $temperaturaObject->getTemperatura();
// echo "<br />";
// echo $temperatura->getTemperatura();


$arrayList = new \Classes\ArrayList();
$frutas = $arrayList;

$arrayList->Add('Banana');
$arrayList->Add('Morango');
$arrayList->Add('Melância');
$arrayList->Add('Pêra');
$arrayList->Add('Uva');
$arrayList->Add('Maçã');
$arrayList->Add('Goiaba');
echo "<br />";
//echo $arrayList->GetKey('Morango');
//echo "<pre>";
//print_r($frutas,false);
//echo "</pre>";
//$arrayList->Remove(0);
//$arrayList->Add('Melão');
//echo "<br />";
//echo $arrayList->Size();
//echo "<pre>";
//print_r($frutas);
//echo "</pre>";
//$paises = ['Brasil','Argentina','Peru','Bolivia','Uruguai','Paraguai','Venezuela','Chile'];
//
//$obj = new ArrayObject($paises);
////echo "<pre>";
////print_r($obj);
////$obj->append(array('Alemanha','Espanha','Costa Rica'));
//$p = $obj->getIterator();
//$p->offsetSet($p->count(),'Mexico');
//
////echo "<pre>";
////var_dump($obj);exit();
////$obj->asort();
//$total = $p->count();
//while($p->valid()){
//    if($p->current() == "Argentina") {
//        echo "Removendo ". $p->current(). " da lista";
//        $p->offsetUnset($p->key());
//    }
//    echo $p->current();
//    echo '<br />';
//    $p->next();
//}
////var_dump($obj->offsetExists('Brasil'));exit();
////if($obj->offsetExists('Bolivia')){
////    echo "Gooooolllll, da Bolivia!!!!";
////}else{
////    echo "Valor n encontrado!";
////}
//
//echo "<h4>Existem ".$total." elementos</h4>";
//$copia = $p->getArrayCopy();
//$copia = $obj->getIterator();
//echo "<h3>Copia dos paises acima</h3>";
//foreach($copia as $k => $v){
//    echo $k+1 . ' - '. $v.'<br />';
//}

$alerta = new \Classes\Alerta();

$objAlerta = new ArrayObject($alerta);
$al = $objAlerta->getIterator();
$xml = "";
for($i = $objAlerta->getIterator();$i->valid();$i->next()){
    $xml .="<alerta>";
    $xml .="<u>"  . $i->offsetExists($i->key()) . "</u>";
//    $xml .="<e>" . $i->offsetGet('empresa') . "</e>";
//    $xml .="<a>" . $i->offsetGet(' ativo')  . "</a>";
//    $xml .="<p>" . $i->offsetGet('periodo') . "</p>";
//    $xml .="<dh>" . $i->offsetGet('dh')     . "</dh>";
//    $xml .="<d1>" . $i->offsetGet('data1')  . "</d1>";
//    $xml .="<d2>" . $i->offsetGet('data2')  . "</d2>";
//    $xml .="<h1>" . $i->offsetGet('hora1')  . "</h1>";
//    $xml .="<h2>" . $i->offsetGet('hora2')  . "</h2>";
//    $xml .="<v1>" . $i->offsetGet('valor1') . "</v1>";
//    $xml .="<v2>" . $i->offsetGet('valor2') . "</v2>";
//    $xml .="<te>" . $i->offsetGet('texto')  . "</te>";
//    $xml .="<ti>" . $i->offsetGet('tipo')   . "</ti>";
//    $xml .="<al>" . $i->offsetGet('alerta') . "</al>";
//    $xml .="<ac>" . ($i->offsetGet('acionado ') ? 1 : 0) . "</ac>";
    $xml .="</alerta>";

}

print_r($xml);

?>
</body>
</html>