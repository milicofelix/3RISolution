
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
use Classes\Request;

$autoLoad = new AutoLoad();
$autoLoad->setPath(ROOT);
$autoLoad->setExt('php');

spl_autoload_register(array($autoLoad, 'load'));

$request = new Request();

    echo "<h3>Home</h3>";

        $xml = "";

		$xml .= "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		$xml .= "<grafico>";

		// verifica se o usuário pediu série histórica
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
        	if( $tmp != null && !empty(trim($tmp)) )
            {
                $v[] = $tmp.split(",");//vivoFDPdoCaralho

        		if( $periodo == 0 && count($v) > 0 ) // número de barras para diário
                        $nBarras = $v[0];

        		else if( $periodo == 1 && count($v) > 1 ) // número de barras para intraday de 1 min
                        $nBarras = $v[1];

        		else if( $periodo == 5 && count($v) > 2 ) // número de barras para intraday de 5 min
                        $nBarras = $v[2];

        		else if( $periodo == 15 && count($v) > 3 ) // número de barras para intraday de 15 min
                        $nBarras = $v[3];
        	}

			if( $request->getParameter("serie") == "1" ) // histórico completo
                $xml .= getHistorico($ativo, $periodo, $horaFimPregao, false, false, $nBarras);

			if( $request->getParameter("serie").equals("2") ) // histórico apenas de hoje
                $xml .= getHistorico($ativo, $periodo, $horaFimPregao, true, false, $nBarras);

			if( $request->getParameter("serie").equals("3") ) // histórico diário de um indexador
                $xml .= getHistorico($ativo, $periodo, $horaFimPregao, false, true, $nBarras);

			if( $request->getParameter("serie") == "4") // histórico de Últimas para o Compar$ativo
            {
                $ativos[] = $ativo->split(";");
				for( $i = 0; $i < count($ativos); $i++ )
				{
                    $xml .= getHistorico($ativos[$i], $periodo, $horaFimPregao, false, true, $nBarras);
				}
			}
		}

		if( $request->getParameter("topico") != null && !empty(trim($request->getParameter("topico"))))
        {
            $ativo = strtoupper($request->getParameter("ativo"));
			$dh = $request->getParameter("$dh");
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
                ult$dhCorrecao = Long.parseLong($request->getParameter("ult_$dh_correcao"));
            }catch(NumberFormatException e){}

			long ult$dhAnalise = 0;
			try
            {
                ult$dhAnalise = Long.parseLong($request->getParameter("ult_$dh_analise"));
            }catch(NumberFormatException e){}

			ArrayList<Integer> listLicAnalises = new ArrayList<Integer>();
			if( licencas != null && !licencas.equals("") )
            {
                for( $s : licencas.split(",") )
					try{ listLicAnalises.add(Integer.parseInt(s)); }
                    catch(NumberFormatException e){}
			}

			if( $request->getParameter("topico").equals("1") ) // tópico compatível com o ALL2 do Feeder
                $xml .= getTopico($ativo, $dh, erro, usuario, corretora, ult$dhCorrecao, ult$dhAnalise, listLicAnalises, analiseGratuita != null && analiseGratuita.equals("1"), modulos));
		}

		if( $request->getParameter("perfil") != null )
        {
            // usuário pediu a lista de nomes de perfis + um perfil completo
            if( $request->getParameter("perfil").equals("0") )
            {
                $xml .= getPerfisGrafico(request));
                $xml .= getPerfilGrafico(request));
            }

            // usuário pediu um perfil específico
            if( $request->getParameter("perfil").equals("1") )
                $xml .= getPerfilGrafico(request));

            // usuário mandou salvar um perfil
            if( $request->getParameter("perfil").equals("2") )
                $xml .= salvaPerfilGrafico(request));

            // usuário mandou excluir um perfil
            if( $request->getParameter("perfil").equals("3") )
                $xml .= excluiPerfilGrafico(request));

            // usuário pediu lista de perfis compartilhados
            if( $request->getParameter("perfil").equals("4") )
                $xml .= getPerfisCompartilhados(request));

            // usuário pediu lista de todos os perfis compartilhados por uma dado analista
            if( $request->getParameter("perfil").equals("5") )
                $xml .= getPerfisCompartilhadosAnalista(request));

            // usuário pediu lista de todos os perfis compartilhados por todos analistas que ele tem direito
            if( $request->getParameter("perfil").equals("6") )
                $xml .= getPerfisCompartilhadosTodosAnalistas(request));
        }

		if( $request->getParameter("reta") != null )
        {
            // usuário pediu retas
            if( $request->getParameter("reta").equals("1") )
                $xml .= getRetas(request));

            // usuário mandou salvar retas
            if( $request->getParameter("reta").equals("2") )
                $xml .= salvaRetas(request));

            // usuário mandou excluir retas
            if( $request->getParameter("reta").equals("3") )
                $xml .= excluiRetas(request));
        }

		if( $request->getParameter("salvaretaant") != null )
        {
            // usuário mandou salvar retas do $ativo anterior
            if( $request->getParameter("salvaretaant").equals("1") )
                $xml .= salvaRetas(request));
        }

		if( $request->getParameter("apagaretaant") != null )
        {
            // usuário mandou excluir retas
            if( $request->getParameter("apagaretaant").equals("1") )
                $xml .= excluiRetas(request));
        }

		if( $request->getParameter("negocio") != null )
        {
            $xml .= getNegocios(request));
        }

		if( $request->getParameter("datas") != null )
        {
            $xml .= getDatasNegocios(request));
        }

		if( $request->getParameter("corretoras") != null )
        {
            $xml .= getListaCorretoras(request));
        }

		if( $request->getParameter("cadastro") != null )
        {
            $xml .= getCadastro());
        }

		if( $request->getParameter("correcao") != null )
        {
            long ult$dh = 0;
			try
            {
                ult$dh = Long.parseLong($request->getParameter("ult_$dh_correcao"));
            }catch(NumberFormatException e){}
			$xml .= getHistoricosCorrigidos(ult$dh));
		}

		if( $request->getParameter("analise") != null )
        {
            long ult$dh = 0;
			try
            {
                ult$dh = Long.parseLong($request->getParameter("ult_$dh_analise"));
            }catch(NumberFormatException e){}

			$xml .= getAnalisesXML(ult$dh));
		}

		if( $request->getParameter("alerta") != null )
        {
            if( $request->getParameter("alerta").equals("1") )
                $xml .= getAlertas());

            if( $request->getParameter("alerta").equals("2") )
                $xml .= desativaAlerta(request));

            if( $request->getParameter("alerta").equals("3") )
                $xml .= excluiAlerta(request));
        }

		if( $request->getParameter("noticia") != null )
        {
            $xml .= getNoticias(request));
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
            if( $request->getParameter("cores").equals("1") )
                $xml .= salvaCores(request));

            if( $request->getParameter("cores").equals("2") )
                $xml .= getCores(request));
        }

		if( $request->getParameter("alertas") != null )
        {
            $xml .= getAlertasAbasGrafico(request));
        }

		$xml .= "</grafico>");

		sendResponse($xml, response);

		// faz log das atualizações via contingência
		if( $request->getParameter("topico") != null && !$request->getParameter("topico").trim().equals("") )
        {
            $erro = $request->getParameter("erro");
			$usuario = $request->getParameter("usuario");
			$corretora = $request->getParameter("corretora");

			logaContingencia(erro, usuario, corretora);
		}
