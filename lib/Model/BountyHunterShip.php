<?php

namespace Model;

/**
 * Class BountyHunterShip
 */

class BountyHunterShip extends AbstractShip
{
  use SettableJediFactorTrait;

  public function getType()
  {
    return 'Bounty Hunter';
  }

  public function isFunctional()
  {
    return true;
  }

  
}