<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 07/10/2015
 * Time: 09:43
 */

namespace tresrisolution\Classes;


class Horas
{
    public function getHoraInt()
{
    $dh = new Data();

    $hora = $dh->getHora();

    if( $dh->getMinuto() < 10 )
        $hora += "0" + $dh->getMinuto();
    else
        $hora += $dh->getMinuto();

    if( $dh->getSegundo() < 10 )
        $hora += "0" + $dh->getSegundo();
    else
        $hora += $dh->getSegundo();

    return $hora;
}

}