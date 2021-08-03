<?php
require_once __DIR__.'/bootstrap.php';

$container = new Container($configuration);
$pdo = $container->getPDO();

$shipLoader = $container->getShipLoader();
$ships = $shipLoader->getShips();

$rebelShip = new RebelShip('My new rebel ship');
$ships[] = $rebelShip; //add to the ship array

$brokenShip = new BrokenShip('I am so broken ship');
$ships[] = $brokenShip;


$errorMessage = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'missing_data':
            $errorMessage = 'Don\'t forget to select some ships to battle!';
            break;
        case 'bad_ships':
            $errorMessage = 'You\'re trying to fight with a ship that\'s unknown to the galaxy?';
            break;
        case 'bad_quantities':
            $errorMessage = 'You pick strange numbers of ships to battle - try again.';
            break;
        default:
            $errorMessage = 'There was a disturbance in the force. Try again.';
    }
}
?>

<html>
  <head>
      <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>OO Battleships</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/6b3e774d9d.js" crossorigin="anonymous"></script>
  </head>

  <?php if ($errorMessage): ?>
      <div>
          <?php echo $errorMessage; ?>
      </div>
  <?php endif; ?>

  <body>
    <div class="container">
      <div class="page-header">
        <h1>OO Battleships of Space</h1>
      </div>
      <table class="table table-hover">
        <caption><i class="fas fa-rocket"></i> These ships are ready for their next Mission</caption>
        <thead>
            <tr>
              <th>Ship</th>
              <th>Weapon Power</th>
              <th>Jedi Factor</th>
              <th>Strength</th>
              <th>Status</th>
              <th>Type</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach ($ships as $ship): ?>
            <tr>
                <td><?php echo $ship->getName(); ?></td>
                <td><?php echo $ship->getWeaponPower(); ?></td>
                <td><?php echo $ship->getJediFactor(); ?></td>
                <td><?php echo $ship->getStrength(); ?></td>
                <td>
                  <?php if($ship->isFunctional()): ?>
                    <i class="fas fa-sun"></i>
                  <?php else: ?>
                    <i class="fas fa-cloud"></i>
                   <?php endif; ?>
                </td>
                <td><?php echo $ship->getType(); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="battle-box mx-auto border">
        <div>
          <form method="POST" action="/battle.php">
            <h2 class="text-center">The Mission</h2>
            <input class="mx-auto form-control text-field" type="text" name="ship1_quantity" placeholder="Enter Number of Ships" />
            <select class="mx-auto form-select btn drp-dwn-width btn-default btn-lg dropdown-toggle" name="ship1_id" style="background-color:white;display:flex;">
                <option value="">Choose a Ship</option>
                <?php foreach ($ships as $ship): ?>
                    <?php if ($ship->isFunctional()): ?>
                        <option value="<?php echo $ship->getId(); ?>"><?php echo $ship->getNameAndSpecs(); ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <br>
            <p class="text-center">AGAINST</p>
            <br>
            <input class="mx-auto form-control text-field" type="text" name="ship2_quantity" placeholder="Enter Number of Ships" />
            <select class="mx-auto form-select btn drp-dwn-width btn-default btn-lg dropdown-toggle" name="ship2_id" style="background-color:white;display:flex;">
                <option value="">Choose a Ship</option>
                <?php foreach ($ships as $ship): ?>
                    <?php if ($ship->isFunctional()): ?>
                        <option value="<?php echo $ship->getId(); ?>"><?php echo $ship->getNameAndSpecs(); ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <br>
            <button class="btn btn-md btn-danger mx-auto" type="submit">Engage</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>