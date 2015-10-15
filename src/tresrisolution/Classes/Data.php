<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 07/10/2015
 * Time: 12:56
 */

namespace tresrisolution\Classes;


class Data extends \DateTime
{
    private $hora;
    private $minuto;
    private $segundo;

    /**
     * @return mixed
     */
    public function getHora()
    {
        $this->hora = $this->format('H');
        return $this->hora;
    }

    /**
     * @return mixed
     */
    public function getMinuto()
    {
        $this->minuto = $this->format('i');
        return $this->minuto;
    }

    /**
     * @return mixed
     */
    public function getSegundo()
    {
        $this->segundo = $this->format('s');
        return $this->segundo;
    }

}