<?php

/**
 * This class is to combine/fetch all the data from PdoShipStorage and ShipLoader
 * 
 */

class Container 
{
  private $configuration;

  private $pdo;

  private $shipLoader;

  private $shipStorage;

  private $battleManager;

  public function __construct(array $configuration)
  {
    $this->configuration = $configuration;
  }

  /**
   * @return PDO
   */
  public function getPDO()
  {
    if($this->pdo === null) {
      $this->pdo = new PDO(
        $this->configuration['db_dsn'],
        $this->configuration['db_user'],
        $this->configuration['db_pass']
      );

      // set PDO exception if something goes wrong
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    return $this->pdo;
  }

  /**
   * @return ShipLoader
   */
  public function getShipLoader()
  {
    if($this->shipLoader === null) {
      //$this->shipLoader = new ShipLoader($this->getPDO());
      $this->shipLoader = new ShipLoader($this->getShipStorage());
    }

    return $this->shipLoader;
  }

  /**
   * @return AbstractShipStorage
   */
  public function getShipStorage()
  {
    if($this->shipStorage === null) {
      //If you want to fetch data from database, use this code
      //$this->shipStorage = new PdoShipStorage($this->getPDO());
      //Fetch data from json file, use this code
      $this->shipStorage = new JsonFileShipStorage(__DIR__.'/../../resources/ships.json');
    }

    return $this->shipStorage;
  }

  public function getBattleManager()
  {
    if($this->battleManager === null) {
      $this->battleManager = new BattleManager();
    }

    return $this->battleManager;
  }
}