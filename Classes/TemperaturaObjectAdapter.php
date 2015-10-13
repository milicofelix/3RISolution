<?php
/**
 * Created by PhpStorm.
 * User: milic
 * Date: 11/10/2015
 * Time: 19:12
 */

namespace Classes;


class TemperaturaObjectAdapter
{
    private $temperatura;

    public function __construct(Temperatura $t){

        $this->temperatura = $t;
    }

    /**
     * @return mixed
     */
    public function getTemperatura()
    {
        return ($this->temperatura->getTemperatura()-32)*5/9;
    }
    public function setTemperatura($vlr)
    {
        $this->temperatura->setTemperatura($vlr *9/5+32);
    }

}