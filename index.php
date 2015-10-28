
<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 05/10/2015
 * Time: 10:55
 */
//header('Content-Type: charset=utf-8');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT',dirname(__FILE__));
ini_set('date.timezone', 'America/Sao_Paulo');
//define('ROOT',($_SERVER['HTTP_HOST'] !== 'localhost:8000')? '/home/storage/8/46/a1/apligraf/public_html/apligraf/grafico-server' : dirname(__FILE__) );

require 'vendor/autoload.php';
//echo ROOT.DS.'Classes'.DS.'AutoLoad.php';exit();

use tresrisolution\Classes\Request;
use tresrisolution\Classes\Historico;
use tresrisolution\Classes\Topicos;
use tresrisolution\Classes\Perfil;
use tresrisolution\Classes\Retas;
use tresrisolution\Classes\Negocios;
use tresrisolution\Classes\Corretoras;
use tresrisolution\Classes\Cadastro;
use tresrisolution\Classes\ManipulaAnalise;
use tresrisolution\Classes\ManipulaAlertas;
use tresrisolution\Classes\Noticia;
use tresrisolution\Classes\Cores;
use tresrisolution\Classes\Loga;

/*CRIANDO OS OBJETOS PARA MONTAR O XML*/

$request        = new Request();
$historico      = new Historico();
$topico         = new Topicos();
$pGrafico       = new Perfil();
$reta           = new Retas();
$negocio        = new Negocios();
$corretoraObj   = new Corretoras();
$cadObj         = new Cadastro();
$analiseObj     = new ManipulaAnalise();
$alertaObj      = new ManipulaAlertas();
$noticiaObj     = new Noticia();
$coresObj       = new Cores();
$logaObj        = new Loga();

$xml = "";

$xml .= "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
$xml .= "<grafico>";

//		// verifica se o usu�rio pediu s�rie hist�rica
if( $request->getParameter("serie") != null && !empty(trim($request->getParameter("serie"))) )
{
	$ativo          = strtoupper($request->getParameter("ativo"));
	$periodo        = $request->getParameter("periodo");
	$horaFimPregao  = $request->getParameter("hfpregao");
	$nBarras        = 2600; //$periodo == 0 ? 2600 : 1100;

	if( $periodo == 1 )
		$nBarras = 2160;  // aprox 4 dias
	else if( $periodo == 5 )
		$nBarras = 1620;  // aprox 15 dias
	else if( $periodo == 15 )
		$nBarras = 1584;  // aprox 44 dias

	$tmp = $request->getParameter("barras");

//	echo is_null($tmp)?'Sem valor':'tem valor';exit;

	if( $tmp != null && !empty(trim($tmp)) )
	{
		$v[] = explode(',',$tmp);//vivoFDPdoCaralho

		if( $periodo == 0 && count($v) > 0 ) // n�mero de barras para di�rio
			$nBarras = $v[0];

		else if( $periodo == 1 && count($v) > 1 ) // n�mero de barras para intraday de 1 min
			$nBarras = $v[1];

		else if( $periodo == 5 && count($v) > 2 ) // n�mero de barras para intraday de 5 min
			$nBarras = $v[2];

		else if( $periodo == 15 && count($v) > 3 ) // n�mero de barras para intraday de 15 min
			$nBarras = $v[3];
	}

	if( $request->getParameter("serie") == "1" ) // hist�rico completo
	{
		$xml .= $historico->getHistorico($ativo, $periodo, $horaFimPregao, false, false, $nBarras);

	}
	if( $request->getParameter("serie") == "2" ) // hist�rico apenas de hoje
		$xml .= $historico->getHistorico($ativo, $periodo, $horaFimPregao, true, false, $nBarras);

	if( $request->getParameter("serie") == "3" ) // hist�rico di�rio de um indexador
		$xml .= $historico->getHistorico($ativo, $periodo, $horaFimPregao, false, true, $nBarras);

	if( $request->getParameter("serie") == "4") // hist�rico de �ltimas para o Compar$ativo
	{
		$ativos[] = explode(';',$ativo);
		for( $i = 0; $i < count($ativos); $i++ )
		{
			$xml .= $historico->getHistorico($ativos[$i], $periodo, $horaFimPregao, false, true, $nBarras);
		}
	}

}

if( $request->getParameter("topico") != null && !empty(trim($request->getParameter("topico"))))
{
	echo "Entrou em topico";exit;
	$ativo = strtoupper($request->getParameter("ativo"));
	$dh = $request->getParameter("dh");
	$erro = $request->getParameter("erro");
	$usuario = $request->getParameter("usuario");
	$corretora = $request->getParameter("corretora");
	$licencas = $request->getParameter("licencas");
	$analiseGratuita = $request->getParameter("ag");
	$modulos = $request->getParameter("modulos");

	if( $dh != null && count($dh) > 19 )
		$dh = substr($dh,0, 19);

	$ultdhCorrecao = 0;
	try
	{
		$ultdhCorrecao = $request->getParameter("ult_dh_correcao");
	}catch(ErrorException $e){}

	$ultdhAnalise = 0;
	try
	{
		$ultdhAnalise = $request->getParameter("ult_dh_analise");
	}catch(ErrorException $e){}

	$listLicAnalises = new ArrayObject();

	if( $licencas != null && !empty($licencas) )
	{
		foreach( explode(',',$licencas) as $s)
			try{ $listLicAnalises->append($s); }
			catch(ErrorException $e){echo $e->getTraceAsString();}
	}

	if( $request->getParameter("topico") == "1" ) // t�pico compat�vel com o ALL2 do Feeder
		$xml .= $topico->getTopico($ativo, $dh, $erro, $usuario, $corretora, $ultdhCorrecao, $ultdhAnalise, $listLicAnalises, $analiseGratuita != null && $analiseGratuita == "1", $modulos);
}


if( $request->getParameter("perfil") != null )
{
	// usu�rio pediu a lista de nomes de perfis + um perfil completo
	if( $request->getParameter("perfil") == "0")
	{
		$xml .= $pGrafico->getPerfisGrafico($request);
		$xml .= $pGrafico->getPerfilGrafico($request);
	}

	// usu�rio pediu um perfil espec�fico
	if( $request->getParameter("perfil") == "1")
		$xml .= $pGrafico->getPerfilGrafico($request);

	// usu�rio mandou salvar um perfil
	if( $request->getParameter("perfil") == "2")
		$xml .= $pGrafico->salvaPerfilGrafico($request);

	// usu�rio mandou excluir um perfil
	if( $request->getParameter("perfil") == "3")
		$xml .= $pGrafico->excluiPerfilGrafico($request);

	// usu�rio pediu lista de perfis compartilhados
	if( $request->getParameter("perfil") == "4")
		$xml .= $pGrafico->getPerfisCompartilhados($request);

	// usu�rio pediu lista de todos os perfis compartilhados por uma dado analista
	if( $request->getParameter("perfil") == "5")
		$xml .= $pGrafico->getPerfisCompartilhadosAnalista($request);

	// usu�rio pediu lista de todos os perfis compartilhados por todos analistas que ele tem direito
	if( $request->getParameter("perfil") == "6")
		$xml .= $pGrafico->getPerfisCompartilhadosTodosAnalistas($request);
}

if( $request->getParameter("reta") != null )
{
	// usu�rio pediu retas
	if( $request->getParameter("reta") == "1")
		$xml .= $reta->getRetas($request);

	// usu�rio mandou salvar retas
	if( $request->getParameter("reta") == "2")
		$xml .= $reta->salvaRetas($request);

	// usu�rio mandou excluir retas
	if( $request->getParameter("reta") == "3")
		$xml .= $reta->excluiRetas($request);
}

if( $request->getParameter("salvaretaant") != null )
{
	// usu�rio mandou salvar retas do $ativo anterior
	if( $request->getParameter("salvaretaant") == "1")
		$xml .= $reta->salvaRetas($request);
}

if( $request->getParameter("apagaretaant") != null )
{
	// usu�rio mandou excluir retas
	if( $request->getParameter("apagaretaant") == "1")
		$xml .= $reta->excluiRetas($request);
}

if( $request->getParameter("negocio") != null )
{
	$xml .= $negocio->getNegocios($request);
}

if( $request->getParameter("datas") != null )
{
	$xml .= $negocio->getDatasNegocios($request);
}

if( $request->getParameter("corretoras") != null )
{
	$xml .= $corretoraObj->getListaCorretoras($request);
}

if( $request->getParameter("cadastro") != null )
{
	$xml .= $cadObj->getCadastro();
}

if( $request->getParameter("correcao") != null )
{
	$ultdh = 0;
	try
	{
		$ultdh = $request->getParameter("ult_dh_correcao");
	}catch(ErrorException $e){$e->getTraceAsString();}
	$xml .= $historico->getHistoricosCorrigidos($ultdh);
}

if( $request->getParameter("analise") != null )
{
	$ultdh = 0;
	try
	{
		$ultdh = $request->getParameter("ult_dh_analise");
	}catch(ErrorException $e){}

	$xml .= $analiseObj->getAnalisesXML($ultdh);
}

if( $request->getParameter("alerta") != null )
{
	if( $request->getParameter("alerta") == "1")
		$xml .= $alertaObj->getAlertas();

	if( $request->getParameter("alerta") == "2")
		$xml .= $alertaObj->desativaAlerta($request);

	if( $request->getParameter("alerta") == "3")
		$xml .= $alertaObj->excluiAlerta($request);
}

if( $request->getParameter("noticia") != null )
{
	$xml .= $noticiaObj->getNoticias($request);
}

if( $request->getParameter("log_entrada") != null )
{
	//$xml .= logaEntrada(request));
}

if( $request->getParameter("log_saida") != null )
{
	//logaSaida(request);
}

if( $request->getParameter("log_status") != null )
{
	//logaStatusConexao(request);
}

if( $request->getParameter("cores") != null )
{
	if( $request->getParameter("cores") == "1")
		$xml .= $coresObj->salvaCores($request);

	if( $request->getParameter("cores") == "2")
		$xml .= $coresObj->getCores($request);
}

if( $request->getParameter("alertas") != null )
{
	$xml .= $alertaObj->getAlertasAbasGrafico($request);
}

$xml .= "</grafico>";


echo $xml;

// faz log das atualiza��es via conting�ncia
if( $request->getParameter("topico") != null && !empty(trim($request->getParameter("topico"))))
{
	$erro = $request->getParameter("erro");
	$usuario = $request->getParameter("usuario");
	$corretora = $request->getParameter("corretora");

	$logaObj->logaContingencia($erro, $usuario, $corretora);
}
