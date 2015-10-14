<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 05/10/2015
 * Time: 15:13
 */

namespace Classes;


class Analise
{
    public $usuario = "";
    public $licenca;
    public $empresa = 1;

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
     * @return mixed
     */
    public function getLicenca()
    {
        return $this->licenca;
    }

    /**
     * @param mixed $licenca
     */
    public function setLicenca($licenca)
    {
        $this->licenca = $licenca;
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
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * @param string $perfil
     */
    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
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
     * @return string
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * @param string $periodo
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;
    }

    /**
     * @return mixed
     */
    public function getDh()
    {
        return $this->dh;
    }

    /**
     * @param mixed $dh
     */
    public function setDh($dh)
    {
        $this->dh = $dh;
    }

    /**
     * @return boolean
     */
    public function isCompartilhar()
    {
        return $this->compartilhar;
    }

    /**
     * @param boolean $compartilhar
     */
    public function setCompartilhar($compartilhar)
    {
        $this->compartilhar = $compartilhar;
    }

    /**
     * @return boolean
     */
    public function isGratuita()
    {
        return $this->gratuita;
    }

    /**
     * @param boolean $gratuita
     */
    public function setGratuita($gratuita)
    {
        $this->gratuita = $gratuita;
    }

    /**
     * @return string
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    /**
     * @param string $grupos
     */
    public function setGrupos($grupos)
    {
        $this->grupos = $grupos;
    }

    public $perfil = "";
    public $ativo = "";
    public $periodo = "";

    public $dh;
    public $compartilhar = false;
    public $gratuita = false;

    public $grupos = "";
}