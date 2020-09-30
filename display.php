<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Exo 1</title>
</head>

<body>
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