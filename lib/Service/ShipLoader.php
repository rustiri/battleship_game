<?php

namespace Service;

use Model\RebelShip;
use Model\Ship;
use Model\AbstractShip;
use Model\BountyHunterShip;
use Model\ShipCollection;

/**
 * This class is for calling method on the shipStorage
 * Its job is to create the object from the data whereever the data came from
 * Goal: to load data from database or json file 
 */


class ShipLoader
{
  private $shipStorage;

  /*
  public function __construct(PdoShipStorage $shipStorage)
  {
    $this->shipStorage = $shipStorage;
  }
  
  public function __construct(AbstractShipStorage $shipStorage)
  {
    $this->shipStorage = $shipStorage;
  }
  */
  public function __construct(ShipStorageInterface $shipStorage)
  {
    $this->shipStorage = $shipStorage;
  }

  /**
   * @return ShipCollection
   */
  public function getShips()
  {
    // Try and catch if something goes wrong
    try {
      //$shipsData = $this->queryForShips();
      $shipsData = $this->shipStorage->fetchAllShipsData();
    } catch (\PDOException $e) {
      trigger_error('Database Exception! '.$e->getMessage());
      $shipsData = [];
    }

    $ships = array(); //create empty array to hold ships data

    //iterate shipsData to get new ship
    foreach($shipsData as $shipData) {
      $ships[] = $this->createShipFromData($shipData); //put ship into the ship array
    }

    // Add new BountyHunter to ShipCollection
    $ships[] = new BountyHunterShip('Slave I');

    //return $ships;
    return new ShipCollection($ships);

  }

  /**
   * @param $id
   * @return null/AbstractShip
   */
  public function findOneById($id)
  {

    $shipArray = $this->shipStorage->fetchSingleShipData($id);

    /*
    $pdo = $pdo = $this->getPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare('SELECT * FROM ship WHERE id = :id');
    $statement->execute(array('id' => $id));
    $shipArray = $statement->fetch(PDO::FETCH_ASSOC);

    //check if ship id is valid, return null if not valid
    if(!$shipArray) {
      return null;
    }
    */

    return $this->createShipFromData($shipArray);
  }

  private function createShipFromData(array $shipData)
  {
    if($shipData['team'] == 'rebel') {
      $ship = new RebelShip($shipData['name']);
    } else {
      $ship = new Ship($shipData['name']);
      $ship->setJediFactor($shipData['jedi_factor']); //get data from DB
    }

    $ship->setId($shipData['id']);
    $ship->setWeaponPower($shipData['weapon_power']);
    $ship->setStrength($shipData['strength']);

    return $ship;
  }

  /**
   * @return PDO
   */
  /*
  private function getPDO()
  {
    /*
    //check to prevent db connection being created so many times
    if($this->pdo === null) {
      $pdo = new PDO($this->dbDSN, $this->dbUser, $this->dbPass);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $this->pdo = $pdo;
    }
    */
    /*return $this->pdo;
  }
  */
}