<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 06/10/2015
 * Time: 09:24
 */

namespace Classes;


use Classes\Config\Conexao;

class Cadastro
{
    private $conn;

    public function __construct(){
        $this->conn = Conexao::getInstance();
    }

    private function getCadastro()
{
if( !$this->conn )
{
    echo "Nao pude recuperar Cadastro por nao conseguir conexao com o banco INTRANET";

    return "";
}

        $xml = "";

		$rs = null;

		try
        {
            if( $this->conn )
            {
                $sql = "SELECT tira_acento(codigo) AS codigo,
                               tira_acento(nm_ativo) AS nm_ativo,
                               tira_acento(indices) AS indices,
                               tira_acento(segmento) AS segmento,
                               cd_bolsa, 
                               periodos, 
                               cd_tipo, 
                               vol_anterior, 
                               neg_anterior, 
                               clientes, 
                               decimais 
                          FROM smartweb_cadastro_ativo ";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchObject();

				$xml .= "<cadastro>";

                foreach($result as $rs)
                {
                    //$xml .="<ativo>");

                    if( $rs->codigo != null )
                        $xml .= $rs->codigo;
                    $xml .=";";

                    if( $rs->nm_ativo != null )
                        $xml .=$rs ->nm_ativo;
                    $xml .=";";

                    if( $rs->indices != null )
                        $xml .= str_replace(";","&",$rs->indices);
                    $xml .=";";

                    if( $rs->segmento != null )
                        $xml .=$rs ->segmento;
                    $xml .=";";

                    if( $rs->cd_bolsa != null )
                        $xml .=$rs ->cd_bolsa;
                    $xml .=";";

                    if( $rs->periodos != null )
                        $xml .=$rs ->periodos;
                    $xml .=";";

                    if( $rs->cd_tipo != null )
                        $xml .=$rs ->cd_tipo;
                    $xml .=";";

                    if( $rs->vol_anterior != null )
                        $xml .=$rs ->vol_anterior;
                    $xml .=";";

                    if( $rs->neg_anterior != null )
                        $xml .=$rs ->neg_anterior;
                    $xml .=";";

                    $xml .="0,";
                    if( $rs->clientes != null )
                        $xml .=$rs ->clientes;
                    $xml .=";";

                    if( $rs->decimais != null )
                        $xml .=$rs ->decimais;
                    $xml .="\n";

                }

				$xml .="</cadastro>";

			}
            else
                echo "N�o pude recuperar Cadastro por n�o estar conectado ao banco Intranet";
        }
        catch(\PDOException $e)
		{
            //e.printStackTrace();
            echo "Erro ao tentar recuperar cadastro";
        }
		
		return $xml;
	}

}