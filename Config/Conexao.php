<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 05/10/2015
 * Time: 15:31
 */

namespace Classes\Config;
use \PDO;

class Conexao
{
    public static $instance;
    public static $ambiente;
//    public static $host;
//    public static $user;
//    public static $pass;
//    public static $db;

    private function __construct() {}

    public static function getInstance()
        {
            if (!isset(self::$instance))
            {
//                if ((self::$host == 'localhost') || (self::$host == '127.0.0.1'))
//                {
//                    // para uso em ambiente de desenvolvimento
//                    self::$host = "localhost";
//                    self::$user = "postgres";
//                    self::$pass = "morango";
//                    self::$db   = "cotacoes";
//                }elseif(self::$host == '200.234.214.81'){
//                    // para uso no ambiente site_locaweb
//                    self::$host = "200.234.214.81";
//                    self::$user = "apligraf1";
//                    self::$pass = "w@JfsP42q8";
//                    self::$db   = "apligraf1";
//                }elseif(self::$host == '200.234.202.112'){
//                    // para uso no ambiente cotacoes_locaweb
//                    self::$host = "200.234.202.112";
//                    self::$user = "apligraf1";
//                    self::$pass = "w@JfsP42q8";
//                    self::$db   = "apligraf1";
//                }elseif(self::$host == '200.234.214.74'){
//                    // para uso no ambiente fundamentalista_locaweb
//                    self::$host = "200.234.214.74";
//                    self::$user = "apligraf2";
//                    self::$pass = "w@JfsP42q8";
//                    self::$db   = "apligraf2";
//                }elseif(self::$host == '200.142.84.220'){
//                    // para uso no ambiente fundamentalista_brt
//                    self::$host = "200.142.84.220";
//                    self::$user = "postgres";
//                    self::$pass = "w@JfsP42q8";
//                    self::$db   = "fundamentalista";
//                }elseif(self::$host == '187.45.196.142'){
//                    // para uso no ambiente cvm_locaweb
//                    self::$host = "187.45.196.142";
//                    self::$user = "apligraf4";
//                    self::$pass = "u0vb5JKi";
//                    self::$db   = "apligraf4";
//                }elseif(self::$host == '187.45.196.142'){
//                    // para uso no ambiente cotacoes_brt
//                    self::$host = "200.142.84.220";
//                    self::$user = "postgres";
//                    self::$pass = "w@JfsP42q8";
//                    self::$db   = "cotacoes";
//                }elseif(self::$host == '187.45.196.142'){
//                    // para uso no ambiente intranet_brt
//                    self::$host = "200.142.84.220";
//                    self::$user = "postgres";
//                    self::$pass = "w@JfsP42q8";
//                    self::$db   = "intranet";
//                }elseif(self::$host == '187.45.196.142'){
//                    // para uso no ambiente site_brt
//                    self::$host = "200.142.84.220";
//                    self::$user = "postgres";
//                    self::$pass = "w@JfsP42q8";
//                    self::$db   = "site";
//                }

                self::$instance = new PDO("pgsql:".self::$ambiente);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
                echo "Conectou";
            }
            return self::$instance;
        }
    public static function ambienteInit($ambiente){

        switch($ambiente){
            case 'conexaoBancoIntranet':
                self::$ambiente = getcfg('site_locaweb.cfg');
                break;
            /*FALTANDO MAPEAR*/
        }
    }

    public function getcfg($nome)
    {
        if (($hf=fopen(ROOT.DS.'Config'.DS.$nome, 'r'))!=FALSE)
        {
            $linha=fgets($hf);
            fclose($hf);
            return $linha;
        }
        return '';
    }

}