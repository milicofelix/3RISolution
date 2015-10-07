<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 07/10/2015
 * Time: 12:22
 */

namespace Classes;


use Classes\Config\Conexao;

class Negocios
{
    private $conn;

    public function __construct(){

        $this->conn         = Conexao::getInstance();
    }

    private function getNegocios($request)
{
    //Connection connectionCotacoes = conexaoBancoCotacoes();

if( !$this->conn )
{
    echo "Nao pude recuperar Negócios por nao conseguir conexao com o banco COTACOES");

    return "";
}

        $xml = "";
        $statementCotacoes = null;
		$rs = null;

		try
        {
            //if( connectionCotacoes != null && !connectionCotacoes.isClosed() /*&& statementCotacoes != null*/ )
            {
                $ativo = strtoupper($request->getParameter("ativo"));
				$bolsa = $request->getParameter("bolsa");
				$delay = $request->getParameter("delay");
				$data  = $request->getParameter("data");

				String sql = "SELECT dh, preco, qtd, cd_corr_compra, cd_corr_venda, seq, vft " +
                "FROM " + ($bolsa.equals("2") ? "NEGOCIO_BMF" : "NEGOCIO_BOVESPA") + " " +
                "WHERE codigo = '" + ativo + "' AND " +
                "dh::date = '" + $data + "' " +
                ($delay.equals("1") ? "AND dh < now() - interval '00:15:00' " : "") +
                "ORDER BY seq DESC";

				statementCotacoes = connectionCotacoes.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);

				rs = statementCotacoes.executeQuery(sql);

				if( !rs.next() )
                {
                    sql = "SELECT dh, preco, qtd, cd_corr_compra, cd_corr_venda, seq, vft " +
                        "FROM " + ($bolsa.equals("2") ? "NEGOCIO_BMF_PERIODO" : "NEGOCIO_BOVESPA_PERIODO") + " " +
                        "WHERE codigo = '" + ativo + "' AND " +
                        "dh::date = '" + $data + "' " +
                        ($delay.equals("1") ? "and dh < now() - interval '00:15:00' " : "") +
                        "ORDER BY seq DESC";
                    rs = statementCotacoes.executeQuery(sql);
                }
                else
                    rs.beforeFirst();

				sb.append("<negocios>");

				while( rs.next() )
                {
                    sb.append("<negocio>");
                    sb.append("<d>" + rs.getString("dh") + "</d>");
                    sb.append("<p>" + rs.getString("preco") + "</p>");
                    sb.append("<q>" + rs.getString("qtd") + "</q>");
                    sb.append("<c>" + rs.getString("cd_corr_compra") + "</c>");
                    sb.append("<v>" + rs.getString("cd_corr_venda")  + "</v>");
                    sb.append("<s>" + rs.getString("seq") + "</s>");
                    sb.append("<t>" + rs.getString("vft") + "</t>");
                    sb.append("</negocio>");
                }

				sb.append("</negocios>");

				xml = sb.toString();
			}
            //else
            //	echo"Não pude recuperar negócios por não estar conectado ao banco Cotações");
        }
        catch(SQLException e)
		{
            //e.printStackTrace();
            echo"Erro ao tentar recuperar negocios");
        }
		finally
		{
            try
            {
                rs.close();
            }
            catch(Exception e)
			{
                e.printStackTrace();
            }

			try
            {
                statementCotacoes.close();
            }
            catch(Exception e)
			{
                e.printStackTrace();
            }

			//try
			//{
			//	connectionCotacoes.close();
			//}
			//catch(Exception e)
			//{
			//	e.printStackTrace();
			//}
		}

		return xml;
	}

    private String get$datasNegocios(HttpServletRequest request)
	{
        //Connection connectionCotacoes = conexaoBancoCotacoes();

        if( !conexaoBancoCotacoes() )
        {
            echo"Nao pude recuperar Negócios por nao conseguir conexao com o banco COTACOES");
            return "";
        }

        String xml = "";
		StringBuilder sb = new StringBuilder();

		Statement statementCotacoes = null;
		ResultSet rs = null;

		try
        {
            //if( connectionCotacoes != null && !connectionCotacoes.isClosed() /*&& statementCotacoes != null*/ )
            {
                Set $datas = new TreeSet<String>();

				String sql = "SELECT $data FROM negocio_$data ORDER BY $data DESC ";
				statementCotacoes = connectionCotacoes.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);
				rs = statementCotacoes.executeQuery(sql);
				while( rs.next() )
                    $datas.add(rs.getString("$data"));

				sql = "SELECT dh::date AS $data FROM negocio_bovespa ORDER BY $data DESC ";
				rs = statementCotacoes.executeQuery(sql);
				while( rs.next() )
                    $datas.add(rs.getString("$data"));

				sb.append("<$datas>");

				for( Iterator i = $datas.iterator(); i.hasNext(); )
				{
                    sb.append("<$data>");
                    sb.append(i.next());
                    sb.append("</$data>");
                }

				sb.append("</$datas>");

				xml = sb.toString();
			}
            //else
            //	echo"Não pude recuperar $datas de negócios por não estar conectado ao banco Cotações");
        }
        catch(SQLException e)
		{
            //e.printStackTrace();
            echo"Erro ao tentar recuperar $datas de negocios");
        }
		finally
		{
            try
            {
                rs.close();
            }
            catch(Exception e)
			{
                e.printStackTrace();
            }

			try
            {
                statementCotacoes.close();
            }
            catch(Exception e)
			{
                e.printStackTrace();
            }

			//try
			//{
			//	connectionCotacoes.close();
			//}
			//catch(Exception e)
			//{
			//	e.printStackTrace();
			//}
		}

		return xml;
	}

}