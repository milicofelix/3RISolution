<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 05/10/2015
 * Time: 15:31
 */

namespace tresrisolution\Classes;
use \PDO;

class Conexao
{
    public static $instance;

    private function __construct() {}

    public static function getInstance($ambiente)
        {
            if (!isset(self::$instance))
            {
                try {
                    self::$instance = new PDO("pgsql:".self::ambienteInit($ambiente));
                    self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
//                    echo "Conectou no ".$ambiente;
                }catch (\PDOException $e){
                    echo "Erro com a conexão: ".$e->getTraceAsString();exit();
                }
            }
            return self::$instance;
        }
    public static function ambienteInit($ambiente){

        switch($ambiente){
            case 'local':
                return self::getcfg('localhost.cfg');
                break;

            case 'cotacoes':
                return self::getcfg('cotacoes_brt.cfg');
                break;

            case 'intranet':
                return self::getcfg('intranet_brt.cfg');
                break;

            case 'intranetremoto':
                return self::getcfg('intranet_remoto.cfg');
                break;
        }
    }

    public static function getcfg($nome)
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