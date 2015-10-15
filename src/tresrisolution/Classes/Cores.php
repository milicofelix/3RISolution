<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 06/10/2015
 * Time: 10:26
 */

namespace tresrisolution\Classes;


class Cores
{
    private $conn;

    public function __construct(){
        $this->conn = Conexao::getInstance();
    }

    public function getCores($request)
{

    if( $request->getParameter("u") == null || trim($request->getParameter("u")) =="")

        return "<cores></cores>";

    if( !$this->conn )
{
    echo "Nao pude recuperar Cores por nao conseguir conexao com o banco INTRANET";

    return "";
}

        $xml = "";

		$rs = null;

		try
        {
                $usuario = $request->getParameter("u");
				$empresa = $request->getParameter("e");

				$sql = "SELECT * FROM smartweb_cor_grafico WHERE nm_usuario = ? AND cd_empresa = ? ";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1,$usuario);
                $stmt->bindValue(2,$empresa);
                $stmt->execute();

				$xml .= "<cores>";

				if( $rs = $stmt->nextRowset())
                {
                    $xml .= "<fb>"  . $rs->fundo_barras . "</fb>";
                    $xml .= "<bg>"  . $rs->borda_grafico . "</bg>";
                    $xml .= "<fj>"  . $rs->fundo_janela . "</fj>";
                    $xml .= "<g>"   . $rs->grid . "</g>";
                    $xml .= "<ca>"  . $rs->candle_alta . "</ca>";
                    $xml .= "<cb>"  . $rs->candle_baixa . "</cb>";
                    $xml .= "<cd>"  . $rs->candle_doji . "</cd>";
                    $xml .= "<cao>" . $rs->candle_alta_on . "</cao>";
                    $xml .= "<cbo>" . $rs->candle_baixa_on . "</cbo>";
                    $xml .= "<ba>"  . $rs->barra_alta . "</ba>";
                    $xml .= "<bb>"  . $rs->barra_baixa . "</bb>";
                    $xml .= "<bao>" . $rs->barra_alta_on . "</bao>";
                    $xml .= "<bbo>" . $rs->barra_baixa_on . "</bbo>";
                    $xml .= "<ma>"  . $rs->marca_abe . "</ma>";
                    $xml .= "<mf>"  . $rs->marca_fec . "</mf>";
                    $xml .= "<l>"   . $rs->linha . "</l>";
                    $xml .= "<m>"   . $rs->montanha . "</m>";
                    $xml .= "<va>"  . $rs->volume_alta . "</va>";
                    $xml .= "<vb>"  . $rs->volume_baixa . "</vb>";
                    $xml .= "<ve>"  . $rs->volume_estavel . "</ve>";
                    $xml .= "<obv>" . $rs->obv . "</obv>";
                    $xml .= "<fv>"  . $rs->fundo_volume . "</fv>";
                    $xml .= "<cua>" . $rs->cursor_ultima_alta . "</cua>";
                    $xml .= "<cub>" . $rs->cursor_ultima_baixa . "</cub>";
                    $xml .= "<cy>"  . $rs->cursor_y . "</cy>";
                    $xml .= "<uca>" . $rs->ultima_cursor_alta . "</uca>";
                    $xml .= "<ucb>" . $rs->ultima_cursor_baixa . "</ucb>";
                    $xml .= "<cab>" . $rs->cabecalho . "</cab>";
                    $xml .= "<ep>"  . $rs->escala_preco . "</ep>";
                    $xml .= "<fua>" . $rs->fundo_ultima_alta . "</fua>";
                    $xml .= "<fub>" . $rs->fundo_ultima_baixa . "</fub>";
                    $xml .= "<fue>" . $rs->fundo_ultima_estavel . "</fue>";
                    $xml .= "<tua>" . $rs->texto_ultima_alta . "</tua>";
                    $xml .= "<tub>" . $rs->texto_ultima_baixa . "</tub>";
                    $xml .= "<tue>" . $rs->texto_ultima_estavel . "</tue>";
                    $xml .= "<ea>"  . $rs->escala_ano . "</ea>";
                    $xml .= "<em1>" . $rs->escala_mes1 . "</em1>";
                    $xml .= "<em2>" . $rs->escala_mes2 . "</em2>";
                    $xml .= "<em>"  . $rs->escala_mes . "</em>";
                    $xml .= "<ed1>" . $rs->escala_dia1 . "</ed1>";
                    $xml .= "<ed2>" . $rs->escala_dia2 . "</ed2>";
                }


				// aba Overlay
				$sql = "SELECT * FROM smartweb_cor_overlay WHERE nm_usuario = ? AND cd_empresa = ? ";
				$stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1,$usuario);
                $stmt->bindValue(2,$empresa);
                $stmt->execute();

				if( $rs = $stmt->nextRowset() )
                {
                    $xml .= "<mm1>" . $rs->media_movel1 . "</mm1>";
                    $xml .= "<mm2>" . $rs->media_movel2 . "</mm2>";
                    $xml .= "<mm3>" . $rs->media_movel3 . "</mm3>";
                    $xml .= "<mm4>" . $rs->media_movel4 . "</mm4>";
                    $xml .= "<mm5>" . $rs->media_movel5 . "</mm5>";
                    $xml .= "<bs>" . $rs->bol_superior . "</bs>";
                    $xml .= "<bc>" . $rs->bol_central . "</bc>";
                    $xml .= "<bi>" . $rs->bol_inferior . "</bi>";
                    $xml .= "<bf>" . $rs->bol_fundo . "</bf>";
                    $xml .= "<hla>" . $rs->highlow_activator . "</hla>";
                    $xml .= "<k1>" . $rs->keltner1 . "</k1>";
                    $xml .= "<k2>" . $rs->keltner2 . "</k2>";
                    $xml .= "<k3>" . $rs->keltner3 . "</k3>";
                    $xml .= "<tf>" . $rs->toposfuntos . "</tf>";
                    $xml .= "<s1>" . $rs->sobreposto1 . "</s1>";
                    $xml .= "<s2>" . $rs->sobreposto2 . "</s2>";
                    $xml .= "<s3>" . $rs->sobreposto3 . "</s3>";
                    $xml .= "<s4>" . $rs->sobreposto4 . "</s4>";
                    $xml .= "<s5>" . $rs->sobreposto5 . "</s5>";
                    $xml .= "<sar>" . $rs->sar . "</sar>";
                    $xml .= "<e1>" . $rs->envelope1 . "</e1>";
                    $xml .= "<e2>" . $rs->envelope2 . "</e2>";
                    $xml .= "<e3>" . $rs->envelope3 . "</e3>";
                    $xml .= "<hl1>" . $rs->highlow1 . "</hl1>";
                    $xml .= "<hl2>" . $rs->highlow2 . "</hl2>";
                    $xml .= "<pv>" . $rs->pivot . "</pv>";
                    $xml .= "<ps1>" . $rs->pivot_sup1 . "</ps1>";
                    $xml .= "<ps2>" . $rs->pivot_sup2 . "</ps2>";
                    $xml .= "<ps3>" . $rs->pivot_sup3 . "</ps3>";
                    $xml .= "<pr1>" . $rs->pivot_res1 . "</pr1>";
                    $xml .= "<pr2>" . $rs->pivot_res2 . "</pr2>";
                    $xml .= "<pr3>" . $rs->pivot_res3 . "</pr3>";
                    $xml .= "<c1>" . $rs->comparativo1 . "</c1>";
                    $xml .= "<c2>" . $rs->comparativo2 . "</c2>";
                    $xml .= "<c3>" . $rs->comparativo3 . "</c3>";
                    $xml .= "<c4>" . $rs->comparativo4 . "</c4>";
                    $xml .= "<c5>" . $rs->comparativo5 . "</c5>";
                    $xml .= "<c6>" . $rs->comparativo6 . "</c6>";
                    $xml .= "<p>" . $rs->provento . "</p>";
                }

				// aba Retas
				$sql = "SELECT * FROM smartweb_cor_ferramenta WHERE nm_usuario = ? AND cd_empresa = ? ";
				$stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1,$usuario);
                $stmt->bindValue(2,$empresa);
                $stmt->execute();

				if( $rs = $stmt->nextRowset() )
                {
                    $xml .= "<ms>" . $rs->magnetica_sup . "</ms>";
                    $xml .= "<mr>" . $rs->magnetica_res . "</mr>";
                    $xml .= "<mfs>" . $rs->magnetica_fec_sup . "</mfs>";
                    $xml .= "<mfr>" . $rs->magnetica_fec_res . "</mfr>";
                    $xml .= "<ps>" . $rs->projetada_sup . "</ps>";
                    $xml .= "<pr>" . $rs->projetada_res . "</pr>";
                    $xml .= "<fs>" . $rs->fixa_sup . "</fs>";
                    $xml .= "<fr>" . $rs->fixa_res . "</fr>";
                    $xml .= "<es>" . $rs->evolucao_sup . "</es>";
                    $xml .= "<er>" . $rs->evolucao_res . "</er>";
                    $xml .= "<f>" . $rs->fibonacci . "</f>";
                    $xml .= "<r>" . $rs->retracement . "</r>";
                    $xml .= "<fbr>" . $rs->fibo_retracement . "</fbr>";
                    $xml .= "<fe>" . $rs->fibo_extension . "</fe>";
                    $xml .= "<t>" . $rs->texto . "</t>";
                    $xml .= "<td>" . $rs->texto_deslocado . "</td>";
                    $xml .= "<dh>" . $rs->data_hora . "</dh>";
                    $xml .= "<dhd>" . $rs->data_hora_deslocada . "</dhd>";
                    $xml .= "<hs>" . $rs->horizontal_sup . "</hs>";
                    $xml .= "<hr>" . $rs->horizontal_res . "</hr>";
                    $xml .= "<hms>" . $rs->horizontal_mag_sup . "</hms>";
                    $xml .= "<hmr>" . $rs->horizontal_mag_res . "</hmr>";
                    $xml .= "<hmfs>" . $rs->horizontal_mag_fec_sup . "</hmfs>";
                    $xml .= "<hmfr>" . $rs->horizontal_mag_fec_res . "</hmfr>";
                    $xml .= "<hvus>" . $rs->horizontal_var_ult_sup . "</hvus>";
                    $xml .= "<hvur>" . $rs->horizontal_var_ult_res . "</hvur>";
                    $xml .= "<shs>" . $rs->stop_horizontal_sup . "</shs>";
                    $xml .= "<shr>" . $rs->stop_horizontal_res . "</shr>";
                    $xml .= "<ns>" . $rs->reta_nivel_sup . "</ns>";
                    $xml .= "<nr>" . $rs->reta_nivel_res . "</nr>";
                    $xml .= "<vy>" . $rs->valor_y . "</vy>";
                    $xml .= "<vyd>" . $rs->valor_y_deslocado . "</vyd>";
                    $xml .= "<el>" . $rs->elipse . "</el>";
                    $xml .= "<re>" . $rs->retangulo . "</re>";
                }

				// aba Estudos
				$sql = "SELECT * FROM smartweb_cor_estudo WHERE nm_usuario = ? AND cd_empresa = ? ";
				$stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1,$usuario);
                $stmt->bindValue(2,$empresa);
                $stmt->execute();

				if( $rs = $stmt->nextRowset() )
                {
                    $xml .= "<l1>" . $rs->linha1 . "</l1>";
                    $xml .= "<l2>" . $rs->linha2 . "</l2>";
                    $xml .= "<l3>" . $rs->linha3 . "</l3>";
                    $xml .= "<l4>" . $rs->linha4 . "</l4>";
                    $xml .= "<l5>" . $rs->linha5 . "</l5>";
                    $xml .= "<hp>" . $rs->histograma_positivo . "</hp>";
                    $xml .= "<hn>" . $rs->histograma_negativo . "</hn>";
                    $xml .= "<n1>" . $rs->nivel1 . "</n1>";
                    $xml .= "<n2>" . $rs->nivel2 . "</n2>";
                    $xml .= "<n3>" . $rs->nivel3 . "</n3>";
                    $xml .= "<f1>" . $rs->fundo1 . "</f1>";
                    $xml .= "<f2>" . $rs->fundo2 . "</f2>";
                }

				$xml .= "</cores>";

		}
        catch(\PDOException $e)
		{
            echo "Erro ao tentar recuperar cores: ". $e->getMessage();
        }

		return $xml;
	}

    public function salvaCores($request)
	{
        if( $request->getParameter("u") == null || trim($request->getParameter("u")) == "" )
            return "<retorno>0</retorno>";


        if( !$this->conn )
        {
            echo "Nao pude salvar Cores por nao conseguir conexao com o banco INTRANET";
            return "";
        }

        $xml = "";
		$rs = null;

		try
        {
            $usuario = $request->getParameter("u");
			$empresa = $request->getParameter("e");

				$bExiste = false;

				$sql = "SELECT nm_usuario FROM smartweb_cor_grafico WHERE nm_usuario = ? AND cd_empresa = ? ";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1,$usuario);
                $stmt->bindValue(2,$empresa);
                $stmt->execute();

            if( $rs = $stmt->nextRowset() )
                    $bExiste = true;

				if( !$bExiste )
                {
                    

                    $xml .= "INSERT INTO smartweb_cor_grafico VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $stmt->bindValue(1,$usuario, \PDO::PARAM_STR);
                    $stmt->bindValue(2,$empresa, \PDO::PARAM_STR);
                    $stmt->bindValue(3,$request->getParameter("fb"), \PDO::PARAM_STR);
                    $stmt->bindValue(4, $request->getParameter("bg") , \PDO::PARAM_STR);
                    $stmt->bindValue(5, $request->getParameter("fj") , \PDO::PARAM_STR);
                    $stmt->bindValue(6, $request->getParameter("g") , \PDO::PARAM_STR);
                    $stmt->bindValue(7, $request->getParameter("ca") , \PDO::PARAM_STR);
                    $stmt->bindValue(8, $request->getParameter("cb") , \PDO::PARAM_STR);
                    $stmt->bindValue(9, $request->getParameter("cd") , \PDO::PARAM_STR);
                    $stmt->bindValue(10, $request->getParameter("cao") , \PDO::PARAM_STR);
                    $stmt->bindValue(11, $request->getParameter("cbo") , \PDO::PARAM_STR);
                    $stmt->bindValue(12, $request->getParameter("ba") , \PDO::PARAM_STR);
                    $stmt->bindValue(13, $request->getParameter("bb") , \PDO::PARAM_STR);
                    $stmt->bindValue(14, $request->getParameter("bao") , \PDO::PARAM_STR);
                    $stmt->bindValue(15, $request->getParameter("bbo") , \PDO::PARAM_STR);
                    $stmt->bindValue(16, $request->getParameter("ma") , \PDO::PARAM_STR);
                    $stmt->bindValue(17, $request->getParameter("mf") , \PDO::PARAM_STR);
                    $stmt->bindValue(18, $request->getParameter("l") , \PDO::PARAM_STR);
                    $stmt->bindValue(19, $request->getParameter("m") , \PDO::PARAM_STR);
                    $stmt->bindValue(20, $request->getParameter("va") , \PDO::PARAM_STR);
                    $stmt->bindValue(21, $request->getParameter("vb") , \PDO::PARAM_STR);
                    $stmt->bindValue(22, $request->getParameter("ve") , \PDO::PARAM_STR);
                    $stmt->bindValue(23, $request->getParameter("obv") , \PDO::PARAM_STR);
                    $stmt->bindValue(24, $request->getParameter("fv") , \PDO::PARAM_STR);
                    $stmt->bindValue(25, $request->getParameter("cua") , \PDO::PARAM_STR);
                    $stmt->bindValue(26, $request->getParameter("cub") , \PDO::PARAM_STR);
                    $stmt->bindValue(27, $request->getParameter("cy") , \PDO::PARAM_STR);
                    $stmt->bindValue(28, $request->getParameter("uca") , \PDO::PARAM_STR);
                    $stmt->bindValue(29, $request->getParameter("ucb") , \PDO::PARAM_STR);
                    $stmt->bindValue(30, $request->getParameter("cab") , \PDO::PARAM_STR);
                    $stmt->bindValue(31, $request->getParameter("ep") , \PDO::PARAM_STR);
                    $stmt->bindValue(32, $request->getParameter("fua") , \PDO::PARAM_STR);
                    $stmt->bindValue(33, $request->getParameter("fub") , \PDO::PARAM_STR);
                    $stmt->bindValue(34, $request->getParameter("fue") , \PDO::PARAM_STR);
                    $stmt->bindValue(35, $request->getParameter("tua") , \PDO::PARAM_STR);
                    $stmt->bindValue(36, $request->getParameter("tub") , \PDO::PARAM_STR);
                    $stmt->bindValue(37, $request->getParameter("tue") , \PDO::PARAM_STR);
                    $stmt->bindValue(38, $request->getParameter("ea") , \PDO::PARAM_STR);
                    $stmt->bindValue(39, $request->getParameter("em1") , \PDO::PARAM_STR);
                    $stmt->bindValue(40, $request->getParameter("em2") , \PDO::PARAM_STR);
                    $stmt->bindValue(41, $request->getParameter("em") , \PDO::PARAM_STR);
                    $stmt->bindValue(42, $request->getParameter("ed1") , \PDO::PARAM_STR);
                    $stmt->bindValue(43, $request->getParameter("ed2") , \PDO::PARAM_STR);
                }
                else
                {

                    $xml .= "UPDATE smartweb_cor_grafico SET dh = ?, fundo_barras = ?, borda_grafico = ?, fundo_janela = ?, grid = ?, candle_alta = ?, candle_baixa = ?, candle_doji = ?, candle_alta_on = ?
                                                             ,candle_baixa_on = ?, barra_alta = ?, barra_baixa = ?, barra_alta_on = ?, barra_baixa_on = ?, marca_abe = ?, marca_fec = ?, linha = ?, montanha = ?
                                                             ,volume_alta = ?, volume_baixa = ?, volume_estavel = ?, obv = ?, fundo_volume = ?, cursor_ultima_alta = ?, cursor_ultima_baixa = ?, cursor_y = ?
                                                             ,ultima_cursor_alta = ?, ultima_cursor_baixa = ?, cabecalho = ?, escala_preco = ?, fundo_ultima_alta = ?, fundo_ultima_baixa = ?, fundo_ultima_estavel = ?
                                                             ,texto_ultima_alta = ?, texto_ultima_baixa = ?, texto_ultima_estavel = ?, escala_ano = ?, escala_mes1 = ?, escala_mes2 = ?, escala_mes = ?, escala_dia1 = ?
                                                             ,escala_dia2 = ? WHERE nm_usuario = ? AND cd_empresa = ?";
                }

                    $stmt->bindValue(1, 'now()', \PDO::PARAM_STR);
                    $stmt->bindValue(2, $request->getParameter("fb"), \PDO::PARAM_STR);
                    $stmt->bindValue(3, $request->getParameter("bg") , \PDO::PARAM_STR);
                    $stmt->bindValue(4, $request->getParameter("fj") , \PDO::PARAM_STR);
                    $stmt->bindValue(5, $request->getParameter("g") , \PDO::PARAM_STR);
                    $stmt->bindValue(6, $request->getParameter("ca") , \PDO::PARAM_STR);
                    $stmt->bindValue(7, $request->getParameter("cb") , \PDO::PARAM_STR);
                    $stmt->bindValue(8, $request->getParameter("cd") , \PDO::PARAM_STR);
                    $stmt->bindValue(9, $request->getParameter("cao") , \PDO::PARAM_STR);
                    $stmt->bindValue(10, $request->getParameter("cbo") , \PDO::PARAM_STR);
                    $stmt->bindValue(11, $request->getParameter("ba") , \PDO::PARAM_STR);
                    $stmt->bindValue(12, $request->getParameter("bb") , \PDO::PARAM_STR);
                    $stmt->bindValue(13, $request->getParameter("bao") , \PDO::PARAM_STR);
                    $stmt->bindValue(14, $request->getParameter("bbo") , \PDO::PARAM_STR);
                    $stmt->bindValue(15, $request->getParameter("ma") , \PDO::PARAM_STR);
                    $stmt->bindValue(16, $request->getParameter("mf") , \PDO::PARAM_STR);
                    $stmt->bindValue(17, $request->getParameter("l") , \PDO::PARAM_STR);
                    $stmt->bindValue(18, $request->getParameter("m") , \PDO::PARAM_STR);
                    $stmt->bindValue(19, $request->getParameter("va") , \PDO::PARAM_STR);
                    $stmt->bindValue(20, $request->getParameter("vb") , \PDO::PARAM_STR);
                    $stmt->bindValue(21, $request->getParameter("ve") , \PDO::PARAM_STR);
                    $stmt->bindValue(22, $request->getParameter("obv") , \PDO::PARAM_STR);
                    $stmt->bindValue(23, $request->getParameter("fv") , \PDO::PARAM_STR);
                    $stmt->bindValue(24, $request->getParameter("cua") , \PDO::PARAM_STR);
                    $stmt->bindValue(25, $request->getParameter("cub") , \PDO::PARAM_STR);
                    $stmt->bindValue(26, $request->getParameter("cy") , \PDO::PARAM_STR);
                    $stmt->bindValue(27, $request->getParameter("uca") , \PDO::PARAM_STR);
                    $stmt->bindValue(28, $request->getParameter("ucb") , \PDO::PARAM_STR);
                    $stmt->bindValue(29, $request->getParameter("cab") , \PDO::PARAM_STR);
                    $stmt->bindValue(30, $request->getParameter("ep") , \PDO::PARAM_STR);
                    $stmt->bindValue(31, $request->getParameter("fua") , \PDO::PARAM_STR);
                    $stmt->bindValue(32, $request->getParameter("fub") , \PDO::PARAM_STR);
                    $stmt->bindValue(33, $request->getParameter("fue") , \PDO::PARAM_STR);
                    $stmt->bindValue(34, $request->getParameter("tua") , \PDO::PARAM_STR);
                    $stmt->bindValue(35, $request->getParameter("tub") , \PDO::PARAM_STR);
                    $stmt->bindValue(36, $request->getParameter("tue") , \PDO::PARAM_STR);
                    $stmt->bindValue(37, $request->getParameter("ea") , \PDO::PARAM_STR);
                    $stmt->bindValue(38, $request->getParameter("em1") , \PDO::PARAM_STR);
                    $stmt->bindValue(39, $request->getParameter("em2") , \PDO::PARAM_STR);
                    $stmt->bindValue(40, $request->getParameter("em") , \PDO::PARAM_STR);
                    $stmt->bindValue(41, $request->getParameter("ed1") , \PDO::PARAM_STR);
                    $stmt->bindValue(42, $request->getParameter("ed2") , \PDO::PARAM_STR);
                    $stmt->bindValue(43,$usuario, \PDO::PARAM_STR);
                    $stmt->bindValue(44,$empresa, \PDO::PARAM_STR);

                    $retorno = $stmt->execute();

  				// aba Overlay
				$bExiste = false;

				$xml .= "SELECT nm_usuario FROM smartweb_cor_overlay WHERE nm_usuario = ? AND cd_empresa = ? ";
                $stmt = $this->conn->prepare($xml);
                $stmt->bindValue(1,$usuario);
                $stmt->bindValue(2,$empresa);
                $stmt->execute();

            if( $rs = $stmt->nextRowset() )
                    $bExiste = true;

				if( !$bExiste )
                {
                    $xml .= "INSERT INTO smartweb_cor_overlay VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                    $stmt->bindValue(1,$usuario, \PDO::PARAM_STR);
                    $stmt->bindValue(2,$empresa, \PDO::PARAM_STR);
                    $stmt->bindValue(3,'now()', \PDO::PARAM_STR);
                    $stmt->bindValue(4, $request->getParameter("mm1") , \PDO::PARAM_STR);
                    $stmt->bindValue(5, $request->getParameter("mm2") , \PDO::PARAM_STR);
                    $stmt->bindValue(6, $request->getParameter("mm3") , \PDO::PARAM_STR);
                    $stmt->bindValue(7, $request->getParameter("mm4") , \PDO::PARAM_STR);
                    $stmt->bindValue(8, $request->getParameter("mm5") , \PDO::PARAM_STR);
                    $stmt->bindValue(9, $request->getParameter("bs") , \PDO::PARAM_STR);
                    $stmt->bindValue(10, $request->getParameter("bc") , \PDO::PARAM_STR);
                    $stmt->bindValue(11, $request->getParameter("bi") , \PDO::PARAM_STR);
                    $stmt->bindValue(12, $request->getParameter("bf") , \PDO::PARAM_STR);
                    $stmt->bindValue(13, $request->getParameter("hla") , \PDO::PARAM_STR);
                    $stmt->bindValue(14, $request->getParameter("k1") , \PDO::PARAM_STR);
                    $stmt->bindValue(15, $request->getParameter("k2") , \PDO::PARAM_STR);
                    $stmt->bindValue(16, $request->getParameter("k3") , \PDO::PARAM_STR);
                    $stmt->bindValue(17, $request->getParameter("tf") , \PDO::PARAM_STR);
                    $stmt->bindValue(18, $request->getParameter("s1") , \PDO::PARAM_STR);
                    $stmt->bindValue(19, $request->getParameter("s2") , \PDO::PARAM_STR);
                    $stmt->bindValue(20, $request->getParameter("s3") , \PDO::PARAM_STR);
                    $stmt->bindValue(21, $request->getParameter("s4") , \PDO::PARAM_STR);
                    $stmt->bindValue(22, $request->getParameter("s5") , \PDO::PARAM_STR);
                    $stmt->bindValue(23, $request->getParameter("sar") , \PDO::PARAM_STR);
                    $stmt->bindValue(24, $request->getParameter("e1") , \PDO::PARAM_STR);
                    $stmt->bindValue(25, $request->getParameter("e2") , \PDO::PARAM_STR);
                    $stmt->bindValue(26, $request->getParameter("e3") , \PDO::PARAM_STR);
                    $stmt->bindValue(27, $request->getParameter("hl1") , \PDO::PARAM_STR);
                    $stmt->bindValue(28, $request->getParameter("hl2") , \PDO::PARAM_STR);
                    $stmt->bindValue(29, $request->getParameter("pv") , \PDO::PARAM_STR);
                    $stmt->bindValue(30, $request->getParameter("ps1") , \PDO::PARAM_STR);
                    $stmt->bindValue(31, $request->getParameter("ps2") , \PDO::PARAM_STR);
                    $stmt->bindValue(32, $request->getParameter("ps3") , \PDO::PARAM_STR);
                    $stmt->bindValue(33, $request->getParameter("pr1") , \PDO::PARAM_STR);
                    $stmt->bindValue(34, $request->getParameter("pr2") , \PDO::PARAM_STR);
                    $stmt->bindValue(35, $request->getParameter("pr3") , \PDO::PARAM_STR);
                    $stmt->bindValue(36, $request->getParameter("c1") , \PDO::PARAM_STR);
                    $stmt->bindValue(37, $request->getParameter("c2") , \PDO::PARAM_STR);
                    $stmt->bindValue(38, $request->getParameter("c3") , \PDO::PARAM_STR);
                    $stmt->bindValue(39, $request->getParameter("c4") , \PDO::PARAM_STR);
                    $stmt->bindValue(40, $request->getParameter("c5") , \PDO::PARAM_STR);
                    $stmt->bindValue(41, $request->getParameter("c6") , \PDO::PARAM_STR);
                    $stmt->bindValue(42, $request->getParameter("p") , \PDO::PARAM_STR);

                }
                else
                {
                    $xml .= "UPDATE smartweb_cor_overlay SET dh = ?, media_movel1 = ?, media_movel2 = ?, media_movel3 = ?, media_movel4 = ?, media_movel5 = ?, bol_superior = ?, bol_central = ? ,bol_inferior = ?
                                                             ,bol_fundo = ?, highlow_activator = ?, keltner1 = ?, keltner2 = ?, keltner3 = ?, toposfuntos = ?, sobreposto1 = ?, sobreposto2 = ?, sobreposto3 = ?
                                                             ,sobreposto4 = ?, sobreposto5 = ?, sar = ?, envelope1 = ?, envelope2 = ?, envelope3 = ?, highlow1 ?, highlow2 = ?, pivot = ?, pivot_sup1 = ?, pivot_sup2 = ?
                                                             ,pivot_sup3 = ?, pivot_res1 = ?, pivot_res2 = ?, pivot_res3 = ?, comparativo1 = ?, comparativo2 = ?, comparativo3 = ? ,comparativo4 = ?, comparativo5 = ?
                                                             ,comparativo6 = ? ,provento = ? WHERE nm_usuario = ? AND cd_empresa = ?";
                }


                    $stmt->bindValue(1,'now()', \PDO::PARAM_STR);
                    $stmt->bindValue(2, $request->getParameter("mm1") , \PDO::PARAM_STR);
                    $stmt->bindValue(3, $request->getParameter("mm2") , \PDO::PARAM_STR);
                    $stmt->bindValue(4, $request->getParameter("mm3") , \PDO::PARAM_STR);
                    $stmt->bindValue(5, $request->getParameter("mm4") , \PDO::PARAM_STR);
                    $stmt->bindValue(6, $request->getParameter("mm5") , \PDO::PARAM_STR);
                    $stmt->bindValue(7, $request->getParameter("bs") , \PDO::PARAM_STR);
                    $stmt->bindValue(8, $request->getParameter("bc") , \PDO::PARAM_STR);
                    $stmt->bindValue(9, $request->getParameter("bi") , \PDO::PARAM_STR);
                    $stmt->bindValue(10, $request->getParameter("bf") , \PDO::PARAM_STR);
                    $stmt->bindValue(11, $request->getParameter("hla") , \PDO::PARAM_STR);
                    $stmt->bindValue(12, $request->getParameter("k1") , \PDO::PARAM_STR);
                    $stmt->bindValue(13, $request->getParameter("k2") , \PDO::PARAM_STR);
                    $stmt->bindValue(14, $request->getParameter("k3") , \PDO::PARAM_STR);
                    $stmt->bindValue(15, $request->getParameter("tf") , \PDO::PARAM_STR);
                    $stmt->bindValue(16, $request->getParameter("s1") , \PDO::PARAM_STR);
                    $stmt->bindValue(17, $request->getParameter("s2") , \PDO::PARAM_STR);
                    $stmt->bindValue(18, $request->getParameter("s3") , \PDO::PARAM_STR);
                    $stmt->bindValue(19, $request->getParameter("s4") , \PDO::PARAM_STR);
                    $stmt->bindValue(20, $request->getParameter("s5") , \PDO::PARAM_STR);
                    $stmt->bindValue(21, $request->getParameter("sar") , \PDO::PARAM_STR);
                    $stmt->bindValue(22, $request->getParameter("e1") , \PDO::PARAM_STR);
                    $stmt->bindValue(23, $request->getParameter("e2") , \PDO::PARAM_STR);
                    $stmt->bindValue(24, $request->getParameter("e3") , \PDO::PARAM_STR);
                    $stmt->bindValue(25, $request->getParameter("hl1") , \PDO::PARAM_STR);
                    $stmt->bindValue(26, $request->getParameter("hl2") , \PDO::PARAM_STR);
                    $stmt->bindValue(27, $request->getParameter("pv") , \PDO::PARAM_STR);
                    $stmt->bindValue(28, $request->getParameter("ps1") , \PDO::PARAM_STR);
                    $stmt->bindValue(29, $request->getParameter("ps2") , \PDO::PARAM_STR);
                    $stmt->bindValue(30, $request->getParameter("ps3") , \PDO::PARAM_STR);
                    $stmt->bindValue(31, $request->getParameter("pr1") , \PDO::PARAM_STR);
                    $stmt->bindValue(32, $request->getParameter("pr2") , \PDO::PARAM_STR);
                    $stmt->bindValue(33, $request->getParameter("pr3") , \PDO::PARAM_STR);
                    $stmt->bindValue(34, $request->getParameter("c1") , \PDO::PARAM_STR);
                    $stmt->bindValue(35, $request->getParameter("c2") , \PDO::PARAM_STR);
                    $stmt->bindValue(36, $request->getParameter("c3") , \PDO::PARAM_STR);
                    $stmt->bindValue(37, $request->getParameter("c4") , \PDO::PARAM_STR);
                    $stmt->bindValue(38, $request->getParameter("c5") , \PDO::PARAM_STR);
                    $stmt->bindValue(39, $request->getParameter("c6") , \PDO::PARAM_STR);
                    $stmt->bindValue(40, $request->getParameter("p") , \PDO::PARAM_STR);
                    $stmt->bindValue(1,$usuario, \PDO::PARAM_STR);
                    $stmt->bindValue(2,$empresa, \PDO::PARAM_STR);

            $retorno = $stmt->execute();


            // aba Retas
            $bExiste = false;

            $xml .= "SELECT nm_usuario
                        FROM smartweb_cor_ferramenta
                        WHERE nm_usuario = ?
                        AND cd_empresa = ?";

            $stmt = $this->conn->prepare($xml);
            $stmt->bindValue(1,$usuario);
            $stmt->bindValue(2,$empresa);
            $stmt->execute();

            if( $rs = $stmt->nextRowset() )
                    $bExiste = true;

				if( !$bExiste )
                {


                    $xml .= "INSERT INTO smartweb_cor_ferramenta VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                    $stmt->bindValue(1, $usuario, \PDO::PARAM_STR);
                    $stmt->bindValue(2, $empresa, \PDO::PARAM_STR);
                    $stmt->bindValue(3, 'now()' , \PDO::PARAM_STR);
                    $stmt->bindValue(4, $request->getParameter("ms") , \PDO::PARAM_STR);
                    $stmt->bindValue(5, $request->getParameter("mr") , \PDO::PARAM_STR);
                    $stmt->bindValue(6, $request->getParameter("mfs") , \PDO::PARAM_STR);
                    $stmt->bindValue(7, $request->getParameter("mfr") , \PDO::PARAM_STR);
                    $stmt->bindValue(8, $request->getParameter("ps") , \PDO::PARAM_STR);
                    $stmt->bindValue(9, $request->getParameter("pr") , \PDO::PARAM_STR);
                    $stmt->bindValue(10, $request->getParameter("fs") , \PDO::PARAM_STR);
                    $stmt->bindValue(11, $request->getParameter("fr") , \PDO::PARAM_STR);
                    $stmt->bindValue(12, $request->getParameter("es") , \PDO::PARAM_STR);
                    $stmt->bindValue(13, $request->getParameter("er") , \PDO::PARAM_STR);
                    $stmt->bindValue(14, $request->getParameter("f") , \PDO::PARAM_STR);
                    $stmt->bindValue(15, $request->getParameter("r") , \PDO::PARAM_STR);
                    $stmt->bindValue(16, $request->getParameter("fbr") , \PDO::PARAM_STR);
                    $stmt->bindValue(17, $request->getParameter("fe") , \PDO::PARAM_STR);
                    $stmt->bindValue(18, $request->getParameter("t") , \PDO::PARAM_STR);
                    $stmt->bindValue(19, $request->getParameter("td") , \PDO::PARAM_STR);
                    $stmt->bindValue(20, $request->getParameter("dh") , \PDO::PARAM_STR);
                    $stmt->bindValue(21, $request->getParameter("dhd") , \PDO::PARAM_STR);
                    $stmt->bindValue(22, $request->getParameter("hs") , \PDO::PARAM_STR);
                    $stmt->bindValue(23, $request->getParameter("hr") , \PDO::PARAM_STR);
                    $stmt->bindValue(24, $request->getParameter("hms") , \PDO::PARAM_STR);
                    $stmt->bindValue(25, $request->getParameter("hmr") , \PDO::PARAM_STR);
                    $stmt->bindValue(26, $request->getParameter("hmfs") , \PDO::PARAM_STR);
                    $stmt->bindValue(27, $request->getParameter("hmfr") , \PDO::PARAM_STR);
                    $stmt->bindValue(28, $request->getParameter("hvus") , \PDO::PARAM_STR);
                    $stmt->bindValue(29,$request->getParameter("hvur") , \PDO::PARAM_STR);
                    $stmt->bindValue(30, $request->getParameter("shs") , \PDO::PARAM_STR);
                    $stmt->bindValue(31, $request->getParameter("shr") , \PDO::PARAM_STR);
                    $stmt->bindValue(32, $request->getParameter("ns") , \PDO::PARAM_STR);
                    $stmt->bindValue(33, $request->getParameter("nr") , \PDO::PARAM_STR);
                    $stmt->bindValue(34, $request->getParameter("vy") , \PDO::PARAM_STR);
                    $stmt->bindValue(35, $request->getParameter("vyd") , \PDO::PARAM_STR);
                    $stmt->bindValue(36, $request->getParameter("el") , \PDO::PARAM_STR);
                    $stmt->bindValue(37, $request->getParameter("re") , \PDO::PARAM_STR);

                }
                else
                {

                    $xml .= "UPDATE smartweb_cor_ferramenta SET dh = ?, magnetica_sup = ?, magnetica_res = ?, magnetica_fec_sup = ?, magnetica_fec_res = ?, projetada_sup = ?, projetada_res = ?, fixa_sup = ?
                                                                ,fixa_res = ?, evolucao_sup = ?, evolucao_res = ?, fibonacci = ?, retracement = ?, fibo_retracement = ?, fibo_extension = ?, texto = ?, texto_deslocado = ?
                                                                ,data_hora = ?, data_hora_deslocada = ?, horizontal_sup = ?, horizontal_res = ?, horizontal_mag_sup = ?, horizontal_mag_res = ?, horizontal_mag_fec_sup = ?
                                                                ,horizontal_mag_fec_res	 = ?, horizontal_var_ult_sup = ?, horizontal_var_ult_res = ?, stop_horizontal_sup = ?, stop_horizontal_res = ?, reta_nivel_sup = ?
                                                                ,reta_nivel_res = ?, valor_y = ?, valor_y_deslocado = ?, elipse = ?, retangulo = ?
                                                            WHERE nm_usuario = ? AND cd_empresa = ?";
                }

                    $stmt->bindValue(1, 'now()' , \PDO::PARAM_STR);
                    $stmt->bindValue(2, $request->getParameter("ms") , \PDO::PARAM_STR);
                    $stmt->bindValue(3, $request->getParameter("mr") , \PDO::PARAM_STR);
                    $stmt->bindValue(4, $request->getParameter("mfs") , \PDO::PARAM_STR);
                    $stmt->bindValue(5, $request->getParameter("mfr") , \PDO::PARAM_STR);
                    $stmt->bindValue(6, $request->getParameter("ps") , \PDO::PARAM_STR);
                    $stmt->bindValue(7, $request->getParameter("pr") , \PDO::PARAM_STR);
                    $stmt->bindValue(8, $request->getParameter("fs") , \PDO::PARAM_STR);
                    $stmt->bindValue(9, $request->getParameter("fr") , \PDO::PARAM_STR);
                    $stmt->bindValue(10, $request->getParameter("es") , \PDO::PARAM_STR);
                    $stmt->bindValue(11, $request->getParameter("er") , \PDO::PARAM_STR);
                    $stmt->bindValue(12, $request->getParameter("f") , \PDO::PARAM_STR);
                    $stmt->bindValue(13, $request->getParameter("r") , \PDO::PARAM_STR);
                    $stmt->bindValue(14, $request->getParameter("fbr") , \PDO::PARAM_STR);
                    $stmt->bindValue(15, $request->getParameter("fe") , \PDO::PARAM_STR);
                    $stmt->bindValue(16, $request->getParameter("t") , \PDO::PARAM_STR);
                    $stmt->bindValue(17, $request->getParameter("td") , \PDO::PARAM_STR);
                    $stmt->bindValue(18, $request->getParameter("dh") , \PDO::PARAM_STR);
                    $stmt->bindValue(19, $request->getParameter("dhd") , \PDO::PARAM_STR);
                    $stmt->bindValue(20, $request->getParameter("hs") , \PDO::PARAM_STR);
                    $stmt->bindValue(21, $request->getParameter("hr") , \PDO::PARAM_STR);
                    $stmt->bindValue(22, $request->getParameter("hms") , \PDO::PARAM_STR);
                    $stmt->bindValue(23, $request->getParameter("hmr") , \PDO::PARAM_STR);
                    $stmt->bindValue(24, $request->getParameter("hmfs") , \PDO::PARAM_STR);
                    $stmt->bindValue(25, $request->getParameter("hmfr") , \PDO::PARAM_STR);
                    $stmt->bindValue(26, $request->getParameter("hvus") , \PDO::PARAM_STR);
                    $stmt->bindValue(27,$request->getParameter("hvur") , \PDO::PARAM_STR);
                    $stmt->bindValue(28, $request->getParameter("shs") , \PDO::PARAM_STR);
                    $stmt->bindValue(29, $request->getParameter("shr") , \PDO::PARAM_STR);
                    $stmt->bindValue(30, $request->getParameter("ns") , \PDO::PARAM_STR);
                    $stmt->bindValue(31, $request->getParameter("nr") , \PDO::PARAM_STR);
                    $stmt->bindValue(32, $request->getParameter("vy") , \PDO::PARAM_STR);
                    $stmt->bindValue(33, $request->getParameter("vyd") , \PDO::PARAM_STR);
                    $stmt->bindValue(34, $request->getParameter("el") , \PDO::PARAM_STR);
                    $stmt->bindValue(35, $request->getParameter("re") , \PDO::PARAM_STR);
                    $stmt->bindValue(1, $usuario, \PDO::PARAM_STR);
                    $stmt->bindValue(2, $empresa, \PDO::PARAM_STR);

            $retorno = $stmt->execute();

  			// aba Estudos
            $bExiste = false;

				$xml .= "SELECT nm_usuario FROM smartweb_cor_estudo WHERE nm_usuario = ? AND cd_empresa = ? ";
                $stmt = $this->conn->prepare($xml);
                $stmt->bindValue(1,$usuario);
                $stmt->bindValue(2,$empresa);
                $stmt->execute();

                if( $rs = $stmt->nextRowset() )
                    $bExiste = true;

				if( !$bExiste )
                {
                    $xml .= "INSERT INTO smartweb_cor_estudo VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                    $stmt->bindValue(1, $usuario, \PDO::PARAM_STR);
                    $stmt->bindValue(2, $empresa, \PDO::PARAM_STR);
                    $stmt->bindValue(3, 'now()' , \PDO::PARAM_STR);
                    $stmt->bindValue(4, $request->getParameter("linha1"), \PDO::PARAM_STR);
                    $stmt->bindValue(5, $request->getParameter("linha2"), \PDO::PARAM_STR);
                    $stmt->bindValue(6, $request->getParameter("linha3"), \PDO::PARAM_STR);
                    $stmt->bindValue(7, $request->getParameter("linha4"), \PDO::PARAM_STR);
                    $stmt->bindValue(8, $request->getParameter("linha5"), \PDO::PARAM_STR);
                    $stmt->bindValue(9,  $request->getParameter("histograma_positivo"), \PDO::PARAM_STR);
                    $stmt->bindValue(10, $request->getParameter("histograma_negativo"), \PDO::PARAM_STR);
                    $stmt->bindValue(11, $request->getParameter("nivel1"), \PDO::PARAM_STR);
                    $stmt->bindValue(12, $request->getParameter("nivel2"), \PDO::PARAM_STR);
                    $stmt->bindValue(13, $request->getParameter("nivel3"), \PDO::PARAM_STR);
                    $stmt->bindValue(14, $request->getParameter("fundo1"), \PDO::PARAM_STR);
                    $stmt->bindValue(15, $request->getParameter("fundo2"), \PDO::PARAM_STR);

                }
                else
                {

                    $xml .= "UPDATE smartweb_cor_estudo SET dh = now(), linha1 = ?, linha2 = ?, linha3 = ?, linha4 = ?, linha5 = ?, histograma_positivo = ?, histograma_negativo = ?, nivel1 = ?, nivel2 = ?, nivel3 = ?
                                                            ,fundo1 = ?, fundo2 = ? WHERE nm_usuario = ? AND cd_empresa = ?";
                }

                $retorno = $stmt->execute();

  				$xml = "<retorno>" . $retorno . "</retorno>";
		}
        catch(\PDOException $e)
		{
            echo $e->getTraceAsString();
        }

		return $xml;
	}

}