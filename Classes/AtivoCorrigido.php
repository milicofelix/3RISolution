<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 05/10/2015
 * Time: 13:23
 */

namespace Classes;

use Entidades\AtivoCorrigidoEntity;
use Interfaces\AtivoCorrigidoInterface;

class AtivoCorrigido implements AtivoCorrigidoInterface
{
        private $dh;
		private $codigo;

public function __construct($l, $s)
    {
        $this->dh       = $l;
        $this->codigo   = $s;
    }

/**
 * @param \Entidades\AtivoCorrigidoEntity $ac
 * @return int
 */
public function compareTo(AtivoCorrigidoEntity $ac)
    {
        return $ac->dh - $this->dh;
    }
}
