<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 05/10/2015
 * Time: 15:30
 */

namespace Classes;


class GraficoServer
{
    private $connectionCotacoes;
        //private Statement  statementCotacoes;

    private $connectionIntranet;
    private $statementIntranet;

    private $connectionIntranetRemoto;
    private $statementIntranetRemoto;

    //Thread threadAtualizaMemoria;

        // <String=código do ativo,TreeMap=histórico do ativo>
    //private LinkedHashMap<String,TreeMap<String,Barra>> mapHistoricos = new LinkedHashMap<String,TreeMap<String,Barra>>();

    private $dataHoje = 0;

    private $atualizandoMemoria = false;

    private $servidorLocal = "";

        //private long lUltimoRequest = System.currentTimeMillis();

    //final $configCotacoes = getConfig("/etc/apligraf/cotacoes_java.cfg");
    //final $configIntranet = getConfig("/etc/apligraf/intranet.cfg");
    //final $configIntranetRemoto = getConfig("/etc/apligraf/intranet_remoto.cfg");

    //final String JDBC_DRIVER  = "org.postgresql.Driver";
    //final String DATABASE_URL_COTACOES = "jdbc:postgresql://" + configCotacoes.host + "/" + configCotacoes.db;
    //final String DATABASE_URL_INTRANET = "jdbc:postgresql://" + configIntranet.host + "/" + configIntranet.db;
    //final String DATABASE_URL_INTRANET_REMOTO = "jdbc:postgresql://" + configIntranetRemoto.host + "/" + configIntranetRemoto.db;


        // lista de ativos corrigidos
    private $tamanhoListAC = 3000;
    //private ArrayList<AtivoCorrigido> listAC = new ArrayList<AtivoCorrigido>(tamanhoListAC);
    //private LinkedHashMap<String,Integer> mapAC = new LinkedHashMap<String,Integer>();
    private $ultDHAtivoCorrigido = null;

        // lista de todas as análises
    protected $tamanhoListAN = 200;
    //private ArrayList<Analise> listAnalises = new ArrayList<Analise>(tamanhoListAN);
    protected $ultDHAnalise = null;
    //private Thread threadAnalises;

        // lista de todos os alertas
    protected $tamanhoListAL = 3000;
    //private ArrayList<Alerta> listAlertas = new ArrayList<Alerta>(tamanhoListAL);
    //private Thread threadAlertas;

    private $bLog = false;

    private $ultMinutoCacheMemoria = -1;

    public function modulosContemGrupo($grupos, $modulos)
    {

        if( $modulos != null && !empty($modulos) )
        {
            $grupos  = str_replace($grupos,"|", ";");
            $modulos = str_replace($modulos,"|", ";");

            $vGrupos[]  = str_split(grupos,";");
            $vModulos[] = str_split(modulos,";");

            for( $i = 0; $i < count(vGrupos); $i++ )
                for( $j = 0; $j < count($vModulos); $j++ )
                    if( in_array($vGrupos[$i],$vModulos[$j]) )
                        return true;
        }

        return false;
    }

}