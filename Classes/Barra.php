<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 05/10/2015
 * Time: 15:10
 */

namespace Classes;


class Barra
{
   public $data;
   public $hora;
   public $abertura;
   public $maxima;
   public $minima;

   /**
    * @return mixed
    */
   public function getData()
   {
      return $this->data;
   }

   /**
    * @param mixed $data
    */
   public function setData($data)
   {
      $this->data = $data;
   }

   /**
    * @return mixed
    */
   public function getHora()
   {
      return $this->hora;
   }

   /**
    * @param mixed $hora
    */
   public function setHora($hora)
   {
      $this->hora = $hora;
   }

   /**
    * @return mixed
    */
   public function getAbertura()
   {
      return $this->abertura;
   }

   /**
    * @param mixed $abertura
    */
   public function setAbertura($abertura)
   {
      $this->abertura = $abertura;
   }

   /**
    * @return mixed
    */
   public function getMaxima()
   {
      return $this->maxima;
   }

   /**
    * @param mixed $maxima
    */
   public function setMaxima($maxima)
   {
      $this->maxima = $maxima;
   }

   /**
    * @return mixed
    */
   public function getMinima()
   {
      return $this->minima;
   }

   /**
    * @param mixed $minima
    */
   public function setMinima($minima)
   {
      $this->minima = $minima;
   }

   /**
    * @return mixed
    */
   public function getUltima()
   {
      return $this->ultima;
   }

   /**
    * @param mixed $ultima
    */
   public function setUltima($ultima)
   {
      $this->ultima = $ultima;
   }

   /**
    * @return mixed
    */
   public function getVolume()
   {
      return $this->volume;
   }

   /**
    * @param mixed $volume
    */
   public function setVolume($volume)
   {
      $this->volume = $volume;
   }

   /**
    * @return mixed
    */
   public function getNegocios()
   {
      return $this->negocios;
   }

   /**
    * @param mixed $negocios
    */
   public function setNegocios($negocios)
   {
      $this->negocios = $negocios;
   }

   /**
    * @return mixed
    */
   public function getVft()
   {
      return $this->vft;
   }

   /**
    * @param mixed $vft
    */
   public function setVft($vft)
   {
      $this->vft = $vft;
   }
   public $ultima;
   public $volume;
   public $negocios;
   public $vft;
}		