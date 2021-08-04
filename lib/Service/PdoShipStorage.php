<?php

namespace Service;

/**
 * This class is for the query logic
 */

//class PdoShipStorage extends AbstractShipStorage
class PdoShipStorage implements ShipStorageInterface
{
  private $pdo;

  //use dependency injection to access pdo
  public function __construct(\PDO $pdo)
  {
    //store as property
    $this->pdo = $pdo;
  }

  public function fetchAllShipsData()
  {
    $pdo = $this->pdo;
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare('SELECT * FROM ship');
    $statement->execute();
    $shipsArray = $statement->fetchAll((\PDO::FETCH_ASSOC));

    return $shipsArray;
  }

  public function fetchSingleShipData($id)
  {
    $pdo = $this->pdo;
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare('SELECT * FROM ship WHERE id = :id');
    $statement->execute(array('id' => $id));
    $shipArray = $statement->fetch(\PDO::FETCH_ASSOC);

    //check if ship id is valid, return null if not valid
    if(!$shipArray) {
      return null;
    }

    return $shipArray;
  }
}