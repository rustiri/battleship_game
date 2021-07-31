<?php

class Ship 
{
  private $id;
  private $name;
  private $weaponPower = 0;
  private $jediFactor = 0;
  private $strength = 0;

  private $underRepair;

  public function __construct($name)
  {
    $this->name = $name;

    //this gives each ship 30% chances of being broken or under repair
    $this->underRepair = mt_rand(1, 100) < 30;
  }

  public function isFunctional()
  {
    //if ship is under repair then it's not functional
    return !$this->underRepair;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getNameAndSpecs($useShortFormat = false)
  {
    if($useShortFormat) {
      return sprintf(
        '%s: %s/%s/%s',
        $this->name,
        $this->weaponPower,
        $this->jediFactor,
        $this->strength
      );
    } else {
      return sprintf(
        '%s: w:%s, j:%s, s:%s',
        $this->name,
        $this->weaponPower,
        $this->jediFactor,
        $this->strength
      );
    }
  }

  public function doesGivenShipHaveMoreStrength($givenShip)
  {
    return $givenShip->strength > $this->strength;
  }

  public function setStrength($strength)
  {
    //check if strength is number or integer, if not throw error
    if(!is_numeric($strength)) {
      throw new Exception('Invalid strength passed '.$strength);
    }
    $this->strength = $strength;
  }

  public function getStrength()
  {
    return $this->strength;
  }

  /**
   * Get the value of weaponPower
   */ 
  public function getWeaponPower()
  {
    return $this->weaponPower;
  }

  /**
   * Set the value of weaponPower
   *
   * @return  self
   */ 
  public function setWeaponPower($weaponPower)
  {
    $this->weaponPower = $weaponPower;

    return $this;
  }

  /**
   * Get the value of jediFactor
   */ 
  public function getJediFactor()
  {
    return $this->jediFactor;
  }

  /**
   * Set the value of jediFactor
   *
   * @return  self
   */ 
  public function setJediFactor($jediFactor)
  {
    $this->jediFactor = $jediFactor;

    return $this;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */ 
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * @return integer $id
   */ 
  public function getId()
  {
    return $this->id;
  }

  /**
   *
   * @return integer $id
   */ 
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }
}