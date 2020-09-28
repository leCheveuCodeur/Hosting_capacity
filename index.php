<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <title>Exo 1</title>
</head>

<body>
  <?php
  class Office
  {
    protected $_NbNetworkSocket,
      $_NbMainsSocket,
      $_NbPhoneSocket,
      $_NbChairs,
      $_NbTables,
      $_NbStaff = 0,
      $_AvailableSpace = 0;

    //GETTERS
    public function getNbNetworkSocket()
    {
      return $this->_NbNetworkSocket;
    }
    public function getNbMainsSocket()
    {
      return $this->_NbMainsSocket;
    }
    public function getNbPhoneSocket()
    {
      return $this->_NbPhoneSocket;
    }
    public function getNbChairs()
    {
      return $this->_NbChairs;
    }
    public function getNbTables()
    {
      return $this->_NbTables;
    }
    public function getNbStaff()
    {
      return $this->_NbStaff;
    }
    public function getAvailablePlace()
    {
      return $this->_AvailableSpace;
    }
    //SETTERS
    public function setNbNetworkSocket($NbNetworkSocket)
    {
      if (!is_int($NbNetworkSocket)) {
        trigger_error('You need an integer', E_USER_WARNING);
        return;
      }
      $this->_NbNetworkSocket = $NbNetworkSocket;
    }
    public function setNbMainsSocket($NbMainsSocket)
    {
      if (!is_int($NbMainsSocket)) {
        trigger_error('You need an integer', E_USER_WARNING);
        return;
      }
      $this->_NbMainsSocket = $NbMainsSocket;
    }
    public function setNbPhoneSocket($NbPhoneSocket)
    {
      if (!is_int($NbPhoneSocket)) {
        trigger_error('You need an integer', E_USER_WARNING);
        return;
      }
      $this->_NbPhoneSocket = $NbPhoneSocket;
    }
    public function setNbChairs($NbChairs)
    {
      if (!is_int($NbChairs)) {
        trigger_error('You need an integer', E_USER_WARNING);
        return;
      }
      $this->_NbChairs = $NbChairs;
    }
    public function setNbTables($NbTables)
    {
      if (!is_int($NbTables)) {
        trigger_error('You need an integer', E_USER_WARNING);
        return;
      }
      $this->_NbTables = $NbTables;
    }
    public function setNbStaff($NbStaff)
    {
      $this->_NbStaff = $NbStaff;
    }

    public function setAvailableSpace($AvailableSpace)
    {
      $this->_AvailableSpace = $AvailableSpace;
    }


    public function __construct($NbNetworkSocket, $NbMainsSocket, $NbPhoneSocket, $NbChairs, $NbTables)
    {
      $this->setNbNetworkSocket($NbNetworkSocket);
      $this->setNbMainsSocket($NbMainsSocket);
      $this->setNbPhoneSocket($NbPhoneSocket);
      $this->setNbChairs($NbChairs);
      $this->setNbTables($NbTables);
      $this->setAvailableSpace($this->avSpaceRate());
    }


    public function avSpaceRate()
    {
      if ($this->_NbNetworkSocket <= 0 || $this->_NbMainsSocket <= 0 || $this->_NbPhoneSocket <= 0 || $this->_NbChairs <= 0 || $this->_NbTables <= 0) {
        return 0;
      } else { //researchs the limitant factor
        return min($this->_NbNetworkSocket, $this->_NbMainsSocket, $this->_NbPhoneSocket, $this->_NbChairs, $this->_NbTables);
      }
    }
  }

  class SalesOffice extends Office
  {
    public function avSpaceRate()
    {
      if ($this->_NbNetworkSocket <= 0 || $this->_NbMainsSocket <= 0 || $this->_NbPhoneSocket < 2 || $this->_NbChairs < 2 || $this->_NbTables <= 0) {
        return 0;
      } else {
        return round(min($this->_NbNetworkSocket, $this->_NbMainsSocket, $this->_NbPhoneSocket / 2, $this->_NbChairs / 2, $this->_NbTables), 0, PHP_ROUND_HALF_DOWN);
      }
    }
  }

  class DevOffice extends Office
  {
    public function avSpaceRate()
    {
      if ($this->_NbNetworkSocket < 3 || $this->_NbMainsSocket < 3 || $this->_NbPhoneSocket <= 0 || $this->_NbChairs < 1.5 || $this->_NbTables <= 0) {
        return 0;
      } else {
        return round(min($this->_NbNetworkSocket / 3, $this->_NbMainsSocket / 3, $this->_NbPhoneSocket, $this->_NbChairs / 1.5, $this->_NbTables), 0, PHP_ROUND_HALF_DOWN);
      }
    }
  }

  class Society
  {
    public $office1, $office2, $office3, $office4, $office5, $availablePlaceInSale = 0, $availablePlaceInDev = 0;

    public function setAvailablePlaceInSale()
    {
      $this->availablePlaceInSale = $this->office1->getAvailablePlace() + $this->office2->getAvailablePlace() + $this->office3->getAvailablePlace();
    }
    public function setAvailablePlaceInDev()
    {
      $this->availablePlaceInDev = $this->office4->getAvailablePlace() + $this->office5->getAvailablePlace();
    }
  }

  //init office
  $society = new Society;
  $society->office1 = new SalesOffice(31, 51, 21, 21, 61);
  $society->office2 = new SalesOffice(51, 41, 41, 31, 21);
  $society->office3 = new SalesOffice(71, 31, 61, 91, 41);
  $society->office4 = new DevOffice(41, 31, 61, 91, 51);
  $society->office5 = new DevOffice(51, 81, 71, 61, 31);
  $society->setAvailablePlaceInDev();
  $society->setAvailablePlaceInSale();
  ?>

  <section>
    <h2>Equipment and office capacity</h2>
    <div class="officesList">
      <?php
      for ($i = 1, $stop = false; $stop !== true; $i++) { // iterate on offices
        $office_i = 'office' . $i;
        if (isset($society->$office_i)) {
          echo '<div class="office">';
          $target = $society->$office_i;
          if (get_class($target) == 'SalesOffice') {
            echo '<h3>Salesmen\'s Office ' . $i . '</h3>';
          } else {
            echo '<h3>Developers\'s Office ' . $i . '</h3>';
          }
          echo
            '<table>
            <tr>
              <td>Network Socket</td>
              <td>' . $target->getNbNetworkSocket() . '</td>
            </tr>
            <tr>
              <td>Mains Socket</td>
              <td>' . $target->getNbMainsSocket() . '<td>
            </tr>
            <tr>
              <td>Phone Socket</td>
              <td>' . $target->getNbPhoneSocket() . '</td>
            </tr>
            <tr>
              <td>Chairs</td>
              <td>' . $target->getNbChairs() . '</td>
            </tr>
            <tr>
              <td>Tables</td>
              <td>' . $target->getNbTables() . '</td>
            </tr>
          </table>
          ';
          if (get_class($target) == 'SalesOffice') {
            echo '<p>Capacity : ' . $target->getAvailablePlace() . ' Salesmen</p>';
          } else {
            echo '<p>Capacity : ' . $target->getAvailablePlace() . ' Developers</p>';
          }
          echo '</div>';
        } else {
          $office_bis = 'office' . ($i + 1);
          if (!isset($society->$office_bis)) {
            $stop = true;
          }
        }
      }
      ?>
    </div>
  </section>
  <section>
    <h2>Monitoring of office occupancy</h2>
    <table class="monitor">
      <thead>
        <tr>
          <th>New Arrivant</th>
          <th>Nb of Salesmen</th>
          <th>Nb of Developers</th>
          <th>Available space in Salesmen's Office 1</th>
          <th>Available space in Salesmen's Office 2</th>
          <th>Available space in Salesmen's Office 3</th>
          <th>Available space in Developers's Office 1</th>
          <th>Available space in Developers's Office 2</th>
          <th>Available space in the Society</th>
        </tr>
      </thead>
      <tbody>

        <?php
        function displayLoop($varRand, $object)
        {
          if ($varRand == 0) { // is Salesman
            for ($i = 1, $stop = false; $stop !== true; $i++) { // iterate on offices
              $office_i = 'office' . $i;
              if (isset($object->$office_i) && get_class($object->$office_i) == 'SalesOffice' && $object->$office_i->getAvailablePlace() > 0) {
                $target = $object->$office_i;
                $target->setAvailableSpace($target->getAvailablePlace() - 1);
                $target->setNbStaff($target->getNbStaff() + 1);
                $varRand = 'Salesman in Office' . $i;
                $stop = true;
              } else {
                $office_bis = 'office' . ($i + 1);
                if (!isset($object->$office_bis)) {
                  $stop = true;
                }
              }
            }
          } else { // is Developer
            for ($i = 1, $stop = false; $stop !== true; $i++) { // iterate on offices
              $office_i = 'office' . $i;
              if (isset($object->$office_i) && get_class($object->$office_i) == 'DevOffice' && $object->$office_i->getAvailablePlace() > 0) {
                $target = $object->$office_i;
                $target->setAvailableSpace($target->getAvailablePlace() - 1);
                $target->setNbStaff($target->getNbStaff() + 1);
                $varRand = 'Developer in Office' . $i;
                $stop = true;
              } else {
                $office_bis = 'office' . ($i + 1);
                if (!isset($object->$office_bis)) {
                  $stop = true;
                }
              }
            }
          }

          //compute
          $nbSalesmen = $object->office1->getNbStaff() + $object->office2->getNbStaff() + $object->office3->getNbStaff();
          $nbDevelopers = $object->office4->getNbStaff() + $object->office5->getNbStaff();
          $availableSpaceOff1 = $object->office1->getAvailablePlace();
          $availableSpaceOff2 = $object->office2->getAvailablePlace();
          $availableSpaceOff3 = $object->office3->getAvailablePlace();
          $availableSpaceOff4 = $object->office4->getAvailablePlace();
          $availableSpaceOff5 = $object->office5->getAvailablePlace();
          $availableSpaceSociety = $availableSpaceOff1 + $availableSpaceOff2 + $availableSpaceOff3 + $availableSpaceOff4 + $availableSpaceOff5;
          $object->setAvailablePlaceInDev();
          $object->setAvailablePlaceInSale();

          //display
          echo '<tr>
                    <td title="New Arrivant">' . $varRand . '</td>
                    <td title="Nb of Salesmen">' . $nbSalesmen . '</td>
                    <td title="Nb of Developers">' . $nbDevelopers . '</td>
                    <td title="Available space in Salesmen\'s Office 1">' . $availableSpaceOff1 . '</td>
                    <td title="Available space in Salesmen\'s Office 2">' . $availableSpaceOff2 . '</td>
                    <td title="Available space in Salesmen\'s Office 3">' . $availableSpaceOff3 . '</td>
                    <td title="Available space in Developers\'s Office 1">' . $availableSpaceOff4 . '</td>
                    <td title="Available space in Developers\'s Office 2">' . $availableSpaceOff5 . '</td>
                    <td title="Available space in the Society">' . $availableSpaceSociety . '</td>
                    </tr>';
        }

        while ($society->availablePlaceInDev > 0 || $society->availablePlaceInSale > 0) {
          if ($society->availablePlaceInDev > 0 && $society->availablePlaceInSale > 0) {
            $typePerso = rand(0, 1);
            displayLoop($typePerso, $society);
          } elseif ($society->availablePlaceInDev == 0 && $society->availablePlaceInSale > 0) {
            $typePerso = 0;
            displayLoop($typePerso, $society);
          } elseif ($society->availablePlaceInSale == 0 && $society->availablePlaceInDev > 0) {
            $typePerso = 1;
            displayLoop($typePerso, $society);
          }
        }

        ?>
      </tbody>
  </section>
</body>

</html>