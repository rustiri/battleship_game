<?php

namespace Model;

class Ship extends AbstractShip
{
  use SettableJediFactorTrait; // this is horizontal reuse
  //private $jediFactor = 0;

  private $underRepair;

  public function __construct($name)
  {
    parent::__construct($name);

    //this gives each ship 30% chances of being broken or under repair
    $this->underRepair = mt_rand(1, 100) < 30;
  }
  
  /**
   * Get the value of jediFactor
   */ 
  /* not used, see trait SettableJediFactorTrait
  public function getJediFactor()
  {
    return $this->jediFactor;
  }
  */

  /**
   * Set the value of jediFactor
   *
   * @return  self
   */ 
  /* not used, see trait SettableJediFactorTrait
  public function setJediFactor($jediFactor)
  {
    $this->jediFactor = $jediFactor;

    return $this;
  }
  */

  public function isFunctional()
  {
    //if ship is under repair then it's not functional
    return !$this->underRepair;
  }

  public function getType()
  {
    return 'Empire';
  }

  /*
  private function getSecretDoorCodeToTheDeathStar()
  {
    return 'Ra1nb0ws';
  }
  */
}