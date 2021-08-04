<?php

namespace Model;

abstract class AbstractShip 
{
  private $id;
  private $name;
  private $weaponPower = 0;
  private $strength = 0;

  /**
   * @return integer
   */
  abstract public function getJediFactor();

  /**
   * @return string
   */
  abstract public function getType();

  /**
   * @return bool
   */
  abstract public function isFunctional();

  public function __construct($name)
  {
    $this->name = $name;

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
        $this->getJediFactor(),
        $this->strength
      );
    } else {
      return sprintf(
        '%s: w:%s, j:%s, s:%s',
        $this->name,
        $this->weaponPower,
        $this->getJediFactor(),
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