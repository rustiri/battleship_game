<?php

class ShipLoader
{
  private $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  /**
   * @return Ship[]
   */
  public function getShips()
  {
    $shipsData = $this->queryForShips();

    $ships = array(); //create empty array to hold ships data

    //iterate shipsData to get new ship
    foreach($shipsData as $shipData) {
      $ships[] = $this->createShipFromData($shipData); //put ship into the ship array
    }

    return $ships;

  }

  /**
   * @param $id
   * @return null/Ship
   */
  public function findOneById($id)
  {
    $pdo = $pdo = $this->getPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare('SELECT * FROM ship WHERE id = :id');
    $statement->execute(array('id' => $id));
    $shipsArray = $statement->fetch(PDO::FETCH_ASSOC);

    //check if ship id is valid, return null if not valid
    if(!$shipsArray) {
      return null;
    }

    return $this->createShipFromData($shipsArray);
  }

  private function createShipFromData(array $shipData)
  {
    $ship = new Ship($shipData['name']);
    $ship->setId($shipData['id']);
    $ship->setWeaponPower($shipData['weapon_power']);
    $ship->setJediFactor($shipData['jedi_factor']);
    $ship->setStrength($shipData['strength']);

    return $ship;
  }

  private function queryForShips()
  {
    $pdo = $this->getPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare('SELECT * FROM ship');
    $statement->execute();
    $shipsArray = $statement->fetchAll((PDO::FETCH_ASSOC));

    return $shipsArray;
  }

  /**
   * @return PDO
   */
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
    return $this->pdo;
  }
}