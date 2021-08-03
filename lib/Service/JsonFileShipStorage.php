<?php

/**
 * This class is to fetch data from JSON File
 * 
 */

//class JsonFileShipStorage extends AbstractShipStorage
class JsonFileShipStorage implements ShipStorageInterface
{
  private $filename;

  public function __construct($jsonFilePath)
  {
    $this->filename = $jsonFilePath;
  }

  public function fetchAllShipsData()
  {
    $jsonContents = file_get_contents($this->filename);

    return json_decode($jsonContents, true);
  }

  public function fetchSingleShipData($id)
  {
    $ships = $this->fetchAllShipsData($id);

    foreach ($ships as $ship) {
      if ($ship['id'] == $id) {
        return $ship;
      }
    }
  }
}