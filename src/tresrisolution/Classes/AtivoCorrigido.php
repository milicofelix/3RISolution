<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 05/10/2015
 * Time: 13:23
 */

namespace tresrisolution\Classes;

use tresrisolution\Entidades\AtivoCorrigidoEntity;
use tresrisolution\Interfaces\AtivoCorrigidoInterface;

class AtivoCorrigido implements AtivoCorrigidoInterface
{
        protected $dh;
		protected $codigo;

public function __construct($l, $s)
    {
        $this->dh       = $l;
        $this->codigo   = $s;
    }

/**
 * @param \tresrisolution\Entidades\AtivoCorrigidoEntity $ac
 * @return int
 */
public function compareTo(AtivoCorrigidoEntity $ac)
    {
        return $ac->dh - $this->dh;
    }
}
