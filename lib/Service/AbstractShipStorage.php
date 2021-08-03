<?php

abstract class AbstractShipStorage
{
  abstract function fetchAllShipsData();

  abstract function fetchSingleShipData($id);
}