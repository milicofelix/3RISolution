<?php
/**
 * Created by PhpStorm.
 * User: milic
 * Date: 11/10/2015
 * Time: 19:14
 */

namespace Classes;


class Temperatura
{
    private $temperatura;

    /**
     * @return mixed
     */
    public function getTemperatura()
    {
        return $this->temperatura;
    }

    /**
     * @param mixed $temperatura
     */
    public function setTemperatura($temperatura)
    {
        $this->temperatura = $temperatura;
    }

}