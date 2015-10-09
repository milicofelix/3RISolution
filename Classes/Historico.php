<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 06/10/2015
 * Time: 16:27
 */

namespace Classes;


use Classes\Config\Conexao;

class Historico extends GraficoServer
{
    private $conn;
    public $listAC = array();
    private $dt;

    public function __construct(){
        $this->conn = Conexao::getInstance();
        $this->dt   = new Horas();
    }

    private function getHistoricosCorrigidos($ultDH)
    {
        $sb = "";

        for ($i = 0; $i < count($this->listAC) && $this->listAC->get($i)->dh > $ultDH; $i++) {

            if (strlen($sb) != 0)
                $sb .= ";";

            $sb .= $this->listAC->get($i)->codigo;
            $sb .= ",";
            $sb .= $this->listAC->get($i)->dh;
        }

        return $sb;
    }

    /**
     * @param $ativo
     * @param $periodo
     * @param $horaFimPregao
     * @param $somenteBarrasHoje
     * @param $indexador
     * @param $nBarras
     * @return string
     */
    private function getHistorico($ativo, $periodo, $horaFimPregao, $somenteBarrasHoje, $indexador, $nBarras)
	{
        $xml = "";

        $tmHistorico = getHistoricoBanco2($ativo, $periodo, $horaFimPregao);

        if( count($tmHistorico) > 0 )
        {
            $l = $this->currentTimeMillis();

        	//TreeMap<String,Barra> $tmHistorico = mapHistoricos.get($ativo . ($periodo > 0 ? "." . String.valueOf($periodo) : ""));

			$xml .= "<serie id=\"" . $ativo . "\" hh=\"" . $this->dt->getHoraInt() . "\">";

			$startBarra = -1; // barra inicial que será enviada ao cliente

        	foreach( $tmHistorico->values() as $b )
        	{
                $startBarra++;

                if( $somenteBarrasHoje && $b->data != $this->dataHoje ) continue;
                else if( $startBarra < count($tmHistorico)-$nBarras )     continue;

                $xml .="<barra>";
                $xml .="<d>" . $b->data . "</d>";
                $xml .="<u>" . $b->ultima . "</u>";
                if( !$indexador || $periodo > 0 )
                    $xml .="<h>" . $b->hora . "</h>";
                if( !$indexador )
                {
                    $xml .="<a>" . $b->abertura . "</a>";
                    $xml .="<M>" . $b->maxima . "</M>";
                    $xml .="<m>" . $b->minima . "</m>";
                    $xml .="<v>" . $b->volume . "</v>";
                    $xml .="<n>" . $b->negocios . "</n>";
                    $xml .="<t>" . $b->vft . "</t>";
                }
                $xml .="</barra>";
            }

        	$xml .="</serie>";



			if( $this->bLog )
                echo "Tempo de consulta no Hashtable para " . $ativo . ($periodo > 0 ? "." . $periodo : "") . ": " . ($this->currentTimeMillis() - $l) . "ms";
        }

        return $xml;

	}


    public function currentTimeMillis(){

        $timeparts = explode(" ",microtime());
        $currenttime = bcadd(($timeparts[0]*1000),bcmul($timeparts[1],1000));

        return $currenttime;
    }

    public function getHistoricoBanco($ativo, $periodo, $horaFimPregao)
	{
        //Connection connectionCotacoes = conexaoBancoCotacoes();

        if( !$this->conn )
        {
            echo "Nao pude recuperar Historico Banco por nao conseguir conexao com o banco COTACOES";
            return;
        }

        $statementCotacoes = null;
		$rs = null;

		try
        {
            $maxBarras = 2600; // para diário
        	if( $periodo == 1 )
                $maxBarras = 2160;  // aprox 4 dias
            else if( $periodo == 5 )
                $maxBarras = 1620;  // aprox 15 dias
            else if( $periodo == 15 )
                $maxBarras = 1584;  // aprox 44 dias

        	$sql = null;
        	if( preg_match('/^AED_/',$ativo)) // apenas para avanço e declínio
            {
                $indice = substr($ativo, strpos($ativo,"_")+1);
        		$sql = "SELECT 0 as abertura, 0 as maxima, desceram as minima, subiram as ultima, 0 as volume, 0 as negocios, data, 0 as vft
                          FROM indices_bovespa_diario
                          WHERE codigo = ? ORDER BY data DESC LIMIT " . $maxBarras;
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1, $indice, \PDO::PARAM_INT);
                $stmt->execute();

        	}
            else if( $periodo == 0 ) // diário
            {
                $sql  = "SELECT abertura, maxima, minima, ultima, volume, negocios, dt as data, vft
                          FROM historico_ajustado_diario
                          WHERE codigo = ? AND dt <> now()::date ";
                $sql .= "UNION ";
                $sql .= "SELECT abertura, maxima, minima, ultima, volume, negocios, dt as data, vft
                          FROM historico_ajustado_diario_hoje
                          WHERE codigo = ? AND dt = now()::date ";
                $sql .= "ORDER BY data DESC LIMIT " . $maxBarras;

                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1, $ativo, \PDO::PARAM_INT);
                $stmt->bindValue(2, $ativo, \PDO::PARAM_INT);
                $stmt->execute();
            }
            else if( $periodo == 15 )
            {
                $sql  = "SELECT abertura, maxima, minima, ultima, volume, negocios, dh as data, vft
                          FROM historico_ajustado_15min
                          WHERE codigo = ? AND dh::date <> now()::date ";
                $sql .= "UNION ";
                $sql .= "SELECT abertura, maxima, minima, ultima, volume, negocios, dh as data, vft
                          FROM historico_ajustado_15min_hoje
                          WHERE codigo = ? AND dh::date = now()::date ";
                $sql .= "ORDER BY data DESC LIMIT " . $maxBarras;

                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1, $ativo, \PDO::PARAM_INT);
                $stmt->bindValue(2, $ativo, \PDO::PARAM_INT);
                $stmt->execute();
            }
            else if( $periodo == 5 )
            {
                $sql  = "SELECT abertura, maxima, minima, ultima, volume, negocios, dh as data, vft
                          FROM historico_ajustado_5min
                          WHERE codigo = ? AND dh::date <> now()::date ";
                $sql .= "UNION ";
                $sql .= "SELECT abertura, maxima, minima, ultima, volume, negocios, dh as data, vft FROM historico_ajustado_5min_hoje WHERE codigo = ? AND dh::date = now()::date ";
                $sql .= "ORDER BY data DESC LIMIT " . $maxBarras;

                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1, $ativo, \PDO::PARAM_INT);
                $stmt->bindValue(2, $ativo, \PDO::PARAM_INT);
                $stmt->execute();
            }
            else if( $periodo == 1 )
            {
                $sql  = "SELECT abertura, maxima, minima, ultima, volume, contratos as negocios, dh as data, vft FROM intra_diario WHERE codigo = ? AND dh::date = now()::date ";
                $sql .= "UNION ";
                $sql .= "SELECT abertura, maxima, minima, ultima, volume, negocios, dh as data, vft FROM historico_ajustado_1min WHERE codigo = ? ";
                $sql .= "ORDER BY data DESC LIMIT " . $maxBarras;
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $ativo, \PDO::PARAM_INT);
            $stmt->bindValue(2, $ativo, \PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetchAll();

			//TreeMap<String,Barra> $tmHistorico = new TreeMap<String,Barra>();   Alterar depois##################################################################

			foreach( $result as $rs)
            {
                $b = new Barra();

           		if( $periodo == 0 )
                {
                    $b->data = $rs->getString(7)->replaceAll("-", ""); //Alterar depois##################################################################
                    $b->hora = 200000;
                }
                else
                {
                    $b->data = str_replace('-','',substr($rs[7],0,10));
                    $b->hora = str_replace(':','',substr($rs[7],11,19));
                }

           		$b->abertura = $rs[1];
           		$b->maxima   = $rs[2];
           		$b->minima   = $rs[3];
           		$b->ultima   = $rs[4];
           		$b->volume   = $rs[5];
           		$b->negocios = $rs[6];
           		$b->vft      = $rs[8];

           		// faz data e hora como chave
           		//$tmHistorico.put(String.valueOf($b->data) + ($b->hora < 1000 ? "000" : $b->hora < 10000 ? "00" : $b->hora < 100000 ? "0" : "") + String.valueOf($b->hora), b);//Alterar depois##################################################################
           	}

//           	if( $tmHistorico.size() > 0 )
//                mapHistoricos.put($ativo . ($periodo > 0 ? "." . String.valueOf($periodo) : ""), $tmHistorico);//Alterar depois##################################################################
		}
        catch(\PDOException $e)
		{
            //e.printStackTrace();
            echo "Erro ao tentar recuperar historico de ativo";
        }

	}

    private function getHistoricoBanco2($ativo, $periodo, $horaFimPregao)
	{
        //Connection connectionCotacoes = conexaoBancoCotacoes();

        //TreeMap<String,Barra> tmHistorico = new TreeMap<String,Barra>();
        $tmHistorico = array();

		if( !$this->conn )
        {
            echo "Nao pude recuperar Historico Banco por nao conseguir conexao com o banco COTACOES";
            return $tmHistorico;
        }

		$statementCotacoes = null;
		$rs = null;

		try
        {
            $maxBarras = 2600; // para diário
        	if( $periodo == 1 )
                $maxBarras = 2160;  // aprox 4 dias
            else if( $periodo == 5 )
                $maxBarras = 1620;  // aprox 15 dias
            else if( $periodo == 15 )
                $maxBarras = 1584;  // aprox 44 dias

        	$sql = null;
        	if( $ativo->startsWith("AED_") ) // apenas para avanço e declínio
            {
                $indice = (substr_count($ativo, "_")+1);
        		$sql = "SELECT 0 as abertura, 0 as maxima, desceram as minima, subiram as ultima, 0 as volume, 0 as negocios, data, 0 as vft
                          FROM indices_bovespa_diario
                          WHERE codigo = '" . $indice . "' order by data desc limit " . $maxBarras;
        	}
            else if( $periodo == 0 ) // diário
            {
                //$sql = "SELECT abertura, maxima, minima, ultima, volume, negocios, dt as data, vft FROM historico_ajustado_diario WHERE codigo = '" . $ativo . "' order by dt desc limit " . $maxBarras;
                $sql  = "SELECT abertura, maxima, minima, ultima, volume, negocios, dt as data, vft
                          FROM historico_ajustado_diario
                          WHERE codigo = '" . $ativo . "'
                          AND dt <> now()::date ";
                $sql .= "UNION ";

                $sql .= "SELECT abertura, maxima, minima, ultima, volume, negocios, dt as data, vft
                          FROM historico_ajustado_diario_hoje
                          WHERE codigo = '" . $ativo . "'
                          AND dt = now()::date ";
                $sql .= "ORDER BY data DESC LIMIT " . $maxBarras;
            }
            else if( $periodo == 15 )
            {
                //$sql = "SELECT abertura, maxima, minima, ultima, volume, negocios, dh as data, vft FROM historico_ajustado_15min WHERE codigo = '" . $ativo . "' order by dh desc limit " . $maxBarras;
                $sql  = "SELECT abertura, maxima, minima, ultima, volume, negocios, dh as data, vft FROM historico_ajustado_15min WHERE codigo = '" . $ativo . "' and dh::date <> now()::date ";
                $sql .= "UNION ";
                $sql .= "SELECT abertura, maxima, minima, ultima, volume, negocios, dh as data, vft
                          FROM historico_ajustado_15min_hoje
                          WHERE codigo = '" . $ativo . "'
                          AND dh::date = now()::date ";
                $sql .= "ORDER BY data DESC LIMIT " . $maxBarras;
            }
            else if( $periodo == 5 )
            {
                $sql  = "SELECT abertura, maxima, minima, ultima, volume, negocios, dh as data, vft
                          FROM historico_ajustado_5min
                          WHERE codigo = '" . $ativo . "'
                          AND dh::date <> now()::date ";
                $sql .= "UNION ";
                $sql .= "SELECT abertura, maxima, minima, ultima, volume, negocios, dh as data, vft
                          FROM historico_ajustado_5min_hoje
                          WHERE codigo = '" . $ativo . "'
                          AND dh::date = now()::date ";
                $sql .= "ORDER BY data DESC LIMIT " . $maxBarras;
            }
            else if( $periodo == 1 )
            {
                $sql  = "SELECT abertura, maxima, minima, ultima, volume, contratos as negocios, dh as data, vft
                          FROM intra_diario
                          WHERE codigo = '" . $ativo . "'
                          AND dh::date = now()::date ";
                $sql .= "UNION ";
                $sql .= "SELECT abertura, maxima, minima, ultima, volume, negocios, dh as data, vft
                          FROM historico_ajustado_1min
                          WHERE codigo = '" . $ativo . "' ";
                $sql .= "ORDER BY data DESC LIMIT " . $maxBarras;
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach($result as $rs)
            {
                $b = new Barra();

           		if( $periodo == 0 )
                {
                    $b->data = str_replace('-','',substr($rs[7],0,10));
                    $b->hora = 200000; //Integer.pa$rseInt(horaFimPregao);
                }
                else
                {
                    $b->data = str_replace('-','',substr($rs[7],0,10));
                    $b->hora = str_replace(':','',substr($rs[7],11,19));
                }

           		$b->abertura = $rs[1];
           		$b->maxima   = $rs[2];
           		$b->minima   = $rs[3];
           		$b->ultima   = $rs[4];
           		$b->volume   = $rs[5];
           		$b->negocios = $rs[6];
           		$b->vft      = $rs[8];

           		// faz data e hora como chave
           		$tmHistorico->put($b->data . ($b->hora < 1000 ? "000" : $b->hora < 10000 ? "00" : $b->hora < 100000 ? "0" : "") . $b->hora, $b);
           	}

           	//if( $tmHistorico.size() > 0 )
           		//mapHistoricos.put($ativo . ($periodo > 0 ? "." . String.valueOf($periodo) : ""), $tmHistorico);
		}
        catch(\PDOException $e)
		{
            //e.printStackTrace();
            echo "Erro ao tentar recuperar historico de ativo";
        }

		return $tmHistorico;
	}

    private function procuraHistoricosCorrigidos()
{
//echo "SERVIDOR=".$servidorLocal;
//		if( (servidorLocal.equals("localhost") && !conexaoBancoIntranetRemoto()) || !conexaoBancoIntranet() )
//        {
//            echo "Nao pude recuperar Ativos Corrigidos por nao conseguir conexao com o banco INTRANET";
//        }

		$rs = null;
		$statement = null;

		try
        {
            //statement = servidorLocal.equals("localhost") ? connectionIntranetRemoto.createStatement() : connectionIntranet.createStatement();

            //if( connectionIntranet != null && !connectionIntranet.isClosed() && statement != null )
            {
                $sql = "select codigo, corrigido FROM smartweb_cadastro_ativo WHERE corrigido is not null ";
				if( $this->ultDHAtivoCorrigido != null )
                    $sql .= "and corrigido > '" . $this->ultDHAtivoCorrigido . "' ";
				    $sql .= "order by corrigido asc";

                echo "$sql=".$sql;

                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchObject();

                foreach($result as $rs)
                {
                    $dh = 0 ;
					try
                    {
                        $ultDHAtivoCorrigido = $rs->corrigido;
                        $dh = date("Y-m-d H:m:s", strtotime($this->ultDHAtivoCorrigido));
                    }
                    catch(\PDOException $e)
					{ $e->getTraceAsString(); }

					if( count($listAC) == $tamanhoListAC ) // aumenta a capacidade em 10% se necessário
                    {
                        $tamanhoListAC += (tamanhoListAC / 10);
                        $listAC.ensureCapacity($tamanhoListAC);
                    }

					if( $mapAC->containsKey($rs->getString("codigo")) )
                    {
                        $listAC->set(mapAC.get($rs->getString("codigo")), new AtivoCorrigido($dh, $rs->getString("codigo")));
                    }
                    else
                    {
                        $listAC->add(new AtivoCorrigido($dh, $rs->getString("codigo")));
                        $mapAC->put($rs->getString("codigo"), $listAC.size()-1);
                    }
				}

				if( count($listAC) > 0 )
                {
                    Collections.sort($listAC);

                    // mapeia novamente os ativos para não repetirem na lista depois
                    $mapAC->clear();
                    for( $i = 0; $i < count($listAC); $i++ )
						$mapAC->put($listAC.get($i)->codigo, $i);

					echo "SizeAC:" . count($listAC);
					echo "Ativo:" . $listAC->get(0)->codigo . " DH:" . new SimpleDateFormat("yyyy-MM-dd H:m:s").format(new Date($listAC->get(0).$dh));
				}
			}
            //else
            //echo "Nao pude recuperar Ativos Corrigidos por nao estar conectado ao banco Intranet";
        }
        catch(\PDOException $e)
		{
            $e->getTraceAsString();
            echo "Erro ao tentar recuperar Ativos Corrigidos";
        }
	}
}