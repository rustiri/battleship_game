<?php

namespace Model;

use Traversable;

/**
 * This class is a helper class to iterate object like array
 */

class ShipCollection implements \ArrayAccess, \IteratorAggregate
{
  /**
   * @var AbstractShip[]
   */
  private $ships; //this will an array of ship object

  public function __construct(array $ships)
  {
    $this->ships = $ships;
  }

  public function offsetExists($offset)
  {
    return array_key_exists($offset, $this->ships);
  }

  public function offsetGet($offset)
  {
    return $this->ships[$offset];
  }

  public function offsetSet($offset, $value)
  {
    return $this->ships[$offset] = $value;
  }

  public function offsetUnset($offset)
  {
    unset($this->ships[$offset]);
  }

  /**
   * Method to loop array property
   */
  public function getIterator()
  {
    return new \ArrayIterator($this->ships);
  }
}