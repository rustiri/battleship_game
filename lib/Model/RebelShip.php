<?php

namespace Model;

class RebelShip extends AbstractShip
{
  public function getFavoriteJedi()
  {
    // contains cooljedis array
    $coolJedis = array('Yoda', 'Ben Kenobi');
    //use array_rand to select one of those
    $key = array_rand($coolJedis);

    return $coolJedis($key);
  }

  public function getType()
  {
    return 'Rebel';
  }

  public function isFunctional()
  {
    return true; //rebel ship never broken
  }

  public function getNameAndSpecs($useShortFormat = false)
  {
    $val = parent::getNameAndSpecs($useShortFormat);
    $val .= ' Rebel';

    return $val;
  }

  public function getJediFactor()
  {
    return rand(10,30);
  }
}