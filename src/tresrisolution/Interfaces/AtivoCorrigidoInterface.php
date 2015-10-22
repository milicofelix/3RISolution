<?php
/**
 * Created by PhpStorm.
 * User: milic
 * Date: 05/10/2015
 * Time: 12:59
 */

namespace tresrisolution\Interfaces;
use tresrisolution\Entidades\AtivoCorrigidoEntity;

interface AtivoCorrigidoInterface
{

    public function compareTo(AtivoCorrigidoEntity $ac);

}