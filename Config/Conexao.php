<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 05/10/2015
 * Time: 15:31
 */

namespace Classes;
use \PDO;

class Conexao
{
    public static $instance;
    public static $ambiente;

    private function __construct() {}

    public static function getInstance()
        {
            if (!isset(self::$instance))
            {
                try {
                    self::$instance = new PDO("pgsql:" . self::$ambiente);
                    self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
                    echo "Conectou";
                }catch (\PDOException $e){
                    echo "Erro com a conexão: ".$e->getMessage();
                }
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