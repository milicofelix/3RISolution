<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 08/10/2015
 * Time: 09:17
 */

namespace tresrisolution\Classes;


class Retas
{
	private $conn;

	public function __construct(){

		$this->conn         = Conexao::getInstance();
	}

	public function getRetas($request)
{

	if( !$this->conn )
{
		echo "Nao pude recuperar Retas por nao conseguir conexao com o banco INTRANET";
		return "";
}

		$xml = "";
		$rs = null;

		try
        {
            if( $this->conn )
            {
                $usuario = $request->getParameter("u");
				$empresa = $request->getParameter("e");
				$ativo   = $request->getParameter("ativo");
				$periodo = $request->getParameter("periodo");

				$sql = "SELECT data1, data2, hora1, hora2, val1, val2, texto, tipo, alerta, acionado, estudo, posicao_texto, id_anotacao".
						"FROM retas_java".
						"WHERE cd_empresa 	= ?".
						" AND lower(ativo) 	= ?".
						" AND periodo 		= ?".
						" AND usuario 		= ?";

				$stmt = $this->conn->prepare($sql);
				$stmt->bindValue(1,$empresa);
				$stmt->bindValue(2,$ativo);
				$stmt->bindValue(3,$periodo);
				$stmt->bindValue(4,$usuario);
				$stmt->execute();
				$result = $stmt->fetchObject();

				$xml .= "<retas>";

				$xml .= "<u>" . $usuario . "</u>";
				$xml .= "<a>" . $ativo . "</a>";
				$xml .= "<p>" . $periodo . "</p>";

				foreach($result as $rs)
                {
                    $xml .= "<reta>";
                    $xml .= "<d1>" . $rs->data1 . "</d1>";
                    $xml .= "<d2>" . $rs->data2 . "</d2>";
                    $xml .= "<h1>" . $rs->hora1 . "</h1>";
                    $xml .= "<h2>" . $rs->hora2 . "</h2>";
                    $xml .= "<v1>" . $rs->val1  . "</v1>";
                    $xml .= "<v2>" . $rs->val2  . "</v2>";

                    $texto = $rs->texto;
					if( preg_match('/</',$texto) )
                        $texto = preg_replace("/</", "abretag", $texto);
					$xml .= "<te>" . $texto . "</te>";

					$xml .= "<ti>" . $rs->tipo  . "</ti>";
					$xml .= "<al>" . $rs->alerta  . "</al>";
					$xml .= "<ac>" . $rs->acionado  . "</ac>";
					$xml .= "<es>" . $rs->estudo  . "</es>";

					$xml .= "<pt>" . $rs->posicao_texto  . "</pt>";
					$xml .= "<ia>" . $rs->id_anotacao  . "</ia>";

					$xml .= "</reta>";
				}

				$xml .= "</retas>";

			}
            else
                echo "Não pude recuperar retas por não estar conectado ao banco Intranet";
        }
        catch(\PDOException $e)
		{
            echo "Erro ao tentar recuperar retas";
            $e->getTraceAs();
        }

		return $xml;
	}

	public function salvaRetas($request)
	{
		if( !$this->conn )
		{
			echo "Nao pude salvar Retas por nao conseguir conexao com o banco INTRANET";
			return "";
		}

		$xml = "";
		
		try
		{
			if( $this->conn )
			{

				$existe = false;

				 $usuario = $request->getParameter("u");
				 $empresa = $request->getParameter("e");
				 $ativo   = $request->getParameter("ativo");
				 $periodo = $request->getParameter("periodo");
				 $analista = $request->getParameter("analista")	!= null && $request->getParameter("analista") == "1";

				// salva $ativo anterior do gráfico
				 $ativoAnt   = $request->getParameter("ativoant");
				 $periodoAnt = $request->getParameter("periodoant");
				if( $ativoAnt != null && !$ativoAnt == "")
				{
					$ativo = $ativoAnt;
					$periodo = $periodoAnt;
				}

				$data1[] 	= $request->getParameter("d1") != null ? $request->getParameter("d1").split(";") : null;
				$hora1[] 	= $request->getParameter("h1") != null ? $request->getParameter("h1").split(";") : null;
				$val1[]  	= $request->getParameter("v1") != null ? $request->getParameter("v1").split(";") : null;
				$data2[] 	= $request->getParameter("d2") != null ? $request->getParameter("d2").split(";") : null;
				$hora2[] 	= $request->getParameter("h2") != null ? $request->getParameter("h2").split(";") : null;
				$val2[]  	= $request->getParameter("v2") != null ? $request->getParameter("v2").split(";") : null;
				$texto[] 	= $request->getParameter("tx") != null ? $request->getParameter("tx").split(";") : null;
				$tipo[]  	= $request->getParameter("tp") != null ? $request->getParameter("tp").split(";") : null;

				$alerta[]   = null;
				$acionado[] = null;

				$estudo[] = null;

				$posicao[] = null;
				$id[] = null;

				if( $request->getParameter("al") != null )
				{
					$alerta[]   = explode(";",$request->getParameter("al"));
					$acionado[] = explode(";",$request->getParameter("ac"));
				}

				if( $request->getParameter("es") != null )
					$estudo[]   = explode(";",$request->getParameter("es"));

				if( $request->getParameter("pt") != null )
				{
					$posicao 	= explode(";",$request->getParameter("pt"));
					$id[]      	= explode(";",$request->getParameter("ia"));
				}

				$xml .= "DELETE FROM retas_java WHERE usuario = ?" .
					" AND cd_empresa = ?".
					" AND ativo = ?"  .
					" AND periodo = ?";

				$stmt = $this->conn->prepare($xml);
				$stmt->bindValue(1,$usuario);
				$stmt->bindValue(2,$empresa);
				$stmt->bindValue(3,$ativo);
				$stmt->bindValue(4,$periodo);
  				$retorno = $stmt->execute();

				//Terá que executar em outro ambiente, ainda não foi implementado
				try{$stmt->execute();}catch(\PDOException $e){$e->getTraceAsString();}

  				for( $i = 0; $data1 != null && $i < count($data1); $i++ )
  				{
					$xml = "";
					$xml .= "INSERT INTO retas_java VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
					$stmt->bindValue(1, $usuario, \PDO::PARAM_STR);
					$stmt->bindValue(2, 'xxxxxxxx' , \PDO::PARAM_STR);
					$stmt->bindValue(3, $empresa , \PDO::PARAM_STR);
					$stmt->bindValue(4, $ativo, \PDO::PARAM_STR);
					$stmt->bindValue(5, $periodo, \PDO::PARAM_STR);
					$stmt->bindValue(6, 'now()', \PDO::PARAM_STR);
					$stmt->bindValue(7, $data1[$i], \PDO::PARAM_STR);
					$stmt->bindValue(8, $data2[$i], \PDO::PARAM_STR);
					$stmt->bindValue(9, $hora1[$i], \PDO::PARAM_STR);
					$stmt->bindValue(10,$hora2[$i], \PDO::PARAM_STR);
					$stmt->bindValue(11,$val1[$i], \PDO::PARAM_STR);
					$stmt->bindValue(12,$val2[$i], \PDO::PARAM_STR);
					$stmt->bindValue(13,$texto[$i], \PDO::PARAM_STR);
					$stmt->bindValue(14,$tipo[$i], \PDO::PARAM_STR);
					$stmt->bindValue(15,$alerta[$i], \PDO::PARAM_STR);
					$stmt->bindValue(16,($acionado[$i] == "1") ? "t" : "f" . "'", \PDO::PARAM_STR);
					$stmt->bindValue(17,(count($estudo) > $i) ? $estudo[$i] : "", \PDO::PARAM_STR);
					$stmt->bindValue(18, null, \PDO::PARAM_STR);
					$stmt->bindValue(19, null, \PDO::PARAM_STR);

  					if( $posicao != null && count($posicao) > $i )
					{
						$stmt->bindValue(18, $posicao[$i], \PDO::PARAM_STR);
						$stmt->bindValue(19, $id[$i], \PDO::PARAM_STR);
  					}
					else
					{
						$stmt->bindValue(18, '1', \PDO::PARAM_STR);
						$stmt->bindValue(19, '-1', \PDO::PARAM_STR);
					}

  					$retorno = $stmt->execute();


					if( $analista && $this->conn )
						//Terá que executar em outro ambiente, ainda não foi implementado
						try{$stmt->execute();}catch(\PDOException $e){$e->getTraceAsString();}
  				}

  				$xml = "<$retorno>" . $retorno . "</$retorno>";
  			}
			else
				echo "Não pude salvar retas por não estar conectado ao banco Intranet";
		}
		catch(\SQLiteException $e)
		{
			//echo "Erro ao tentar salvar retas: " . sb.to());
			$e->getTraceAsString();
		}

		return $xml;
	}

public function excluiRetas($request)
	{
		if( !$this->conn )
		{
			echo "Nao pude excluir Retas por nao conseguir conexao com o banco INTRANET";
			return "";
		}

		 $xml = "";

		try
		{
			if( $this->conn )
			{
				 $usuario = $request->getParameter("u");
				 $empresa = $request->getParameter("e");
				 $ativo   = $request->getParameter("ativo");
				 $periodo = $request->getParameter("periodo");
				 $analista = $request->getParameter("analista")	!= null && $request->getParameter("analista") == "1";

				// exclui retas do $ativo anterior do gráfico
				 $ativoAnt   = $request->getParameter("ativoant");
				 $periodoAnt = $request->getParameter("periodoant");
				if( $ativoAnt != null && !empty($ativoAnt ))
				{
					$ativo = $ativoAnt;
					$periodo = $periodoAnt;
				}

				 $sql = "DELETE FROM retas_java WHERE usuario = ?".
				" AND cd_empresa = ?" .
				" AND ativo = ?"  .
				" AND periodo = ?";

				$stmt = $this->conn->prepare($sql);
				$stmt->bindValue(1,$usuario);
				$stmt->bindValue(2,$empresa);
				$stmt->bindValue(3,$ativo);
				$stmt->bindValue(3,$periodo);


  				$retorno = $stmt->execute();

				//Terá que executar em outro ambiente, ainda não foi implementado
				try{$stmt->execute();}catch(\PDOException $e){$e->getTraceAsString();}

  				$xml = "<$retorno>" . $retorno . "</$retorno>";
  			}
			else
				echo "Não pude excluir retas por não estar conectado ao banco Intranet";
		}
		catch(\PDOException $e)
		{
			echo "Erro ao tentar excluir retas";
		}

		return $xml;
	}

}