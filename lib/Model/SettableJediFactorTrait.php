<?php

namespace Model;

/**
 * This trait is for sharing code, cannot be instantiated like class
 */

trait SettableJediFactorTrait
{
  private $jediFactor = 0;

  public function getJediFactor()
  {
      return $this->jediFactor;
  }

  public function setJediFactor($jediFactor)
  {
      $this->jediFactor = $jediFactor;
  }
}