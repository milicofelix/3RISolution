<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 05/10/2015
 * Time: 15:28
 */

namespace Classes;


class Alerta
{
    public $usuario = "";
    public $empresa = 1;
    public $ativo = "";
    public $periodo = 0;
    public $dh = 0;
    public $data1 = "";
    public $data2 = "";

    /**
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param string $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return int
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * @param int $empresa
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }

    /**
     * @return string
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param string $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    /**
     * @return int
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * @param int $periodo
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;
    }

    /**
     * @return int
     */
    public function getDh()
    {
        return $this->dh;
    }

    /**
     * @param int $dh
     */
    public function setDh($dh)
    {
        $this->dh = $dh;
    }

    /**
     * @return string
     */
    public function getData1()
    {
        return $this->data1;
    }

    /**
     * @param string $data1
     */
    public function setData1($data1)
    {
        $this->data1 = $data1;
    }

    /**
     * @return string
     */
    public function getData2()
    {
        return $this->data2;
    }

    /**
     * @param string $data2
     */
    public function setData2($data2)
    {
        $this->data2 = $data2;
    }

    /**
     * @return string
     */
    public function getHora1()
    {
        return $this->hora1;
    }

    /**
     * @param string $hora1
     */
    public function setHora1($hora1)
    {
        $this->hora1 = $hora1;
    }

    /**
     * @return string
     */
    public function getHora2()
    {
        return $this->hora2;
    }

    /**
     * @param string $hora2
     */
    public function setHora2($hora2)
    {
        $this->hora2 = $hora2;
    }

    /**
     * @return float
     */
    public function getValor1()
    {
        return $this->valor1;
    }

    /**
     * @param float $valor1
     */
    public function setValor1($valor1)
    {
        $this->valor1 = $valor1;
    }

    /**
     * @return float
     */
    public function getValor2()
    {
        return $this->valor2;
    }

    /**
     * @param float $valor2
     */
    public function setValor2($valor2)
    {
        $this->valor2 = $valor2;
    }

    /**
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * @param string $texto
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    /**
     * @return int
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param int $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return int
     */
    public function getAlerta()
    {
        return $this->alerta;
    }

    /**
     * @param int $alerta
     */
    public function setAlerta($alerta)
    {
        $this->alerta = $alerta;
    }

    /**
     * @return boolean
     */
    public function isAcionado()
    {
        return $this->acionado;
    }

    /**
     * @param boolean $acionado
     */
    public function setAcionado($acionado)
    {
        $this->acionado = $acionado;
    }
    public $hora1 = "";
    public $hora2 = "";
    public $valor1 = 0.0;
    public $valor2 = 0.0;
    public $texto = "";
    public $tipo = 0;
    public $alerta = 1;
    public $acionado = false;
}