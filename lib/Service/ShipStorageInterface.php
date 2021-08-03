<?php

/**
 * This class only contains abstract function, it doesn't have any functionatility.
 * It allows the code to be generic.
 * 
 */

interface ShipStorageInterface
{
  /**
   * Returns an array of ship arrays, with keys id, name, weaponPower, defense.
   * 
   * @return array
   */
  function fetchAllShipsData();

  /**
   * @param interger id
   * @return array()
   */
  function fetchSingleShipData($id);
}