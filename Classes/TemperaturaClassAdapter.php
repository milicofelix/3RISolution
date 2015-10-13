<?php
/**
 * Created by PhpStorm.
 * User: milic
 * Date: 11/10/2015
 * Time: 19:12
 */

namespace Classes;


class TemperaturaClassAdapter extends Temperatura
{
    private $temperatura;

    /**
     * @return mixed
     */
    public function getTemperatura()
    {
        return (parent::getTemperatura()-32)*5/9;
    }

    /**
     * @param mixed $temperatura
     */
    public function setTemperatura($temperatura)
    {
        parent::setTemperatura($temperatura *9/5+32);
        $this->temperatura = $temperatura;
    }

    public function getTemperaturaFa(){

        return parent::getTemperatura();
    }

}