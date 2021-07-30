<?php

require_once __DIR__.'/lib/Ship.php';

/**
 * @param Ship $someShip
 */
function printShipSummary($someShip)
{
  echo 'Ship name: '.$someShip->name;
  echo '<hr/>';
  echo $someShip->getName();
  echo '<hr/>';
  echo $someShip->getNameAndSpecs(false);
  echo '<hr/>';
  echo $someShip->getNameAndSpecs(true);
}

