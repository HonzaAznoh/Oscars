<?php

use src\Service\Db;
use src\Service\WinnersService;

mb_internal_encoding("UTF-8");

function autoload(string $class): void
{
    $path = str_replace('\\', '/', $class);
    require_once sprintf('%s%s', $path, '.php');
}

spl_autoload_register('autoload');
Db::connect('db', 'root', 'pass', 'oscars');

$winnersService = new WinnersService();
$resultListByYear = $winnersService->getRecordsByYear();
$resultListByMove = $winnersService->getRecordsByMove();
?>

<!DOCTYPE html>
<html lang="cs-cz">
<head>
    <base href="/localhost" />
    <meta charset="UTF-8" />
    <title>Výpis výherců</title>
    <meta name="description" content="Aplikace pro zobrazení výherců Oscarů" />
    <meta name="keywords" content="Aplikace pro zobrazení výherců Oscarů" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="src/css/style.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <header>
        <h1 class="text-center">Aplikace pro zobrazení výherců Oscarů</h1>
    </header>

    <?php
    if (empty($resultListByYear) || empty($resultListByMove)) {
        echo '<h2 class="m-5 text-center" style="color: red;">Záznamy neobsahují žádná validní data. Ujistěte se prosím že jsou soubory výherců nahrány. </h2>';
    } else {
    ?>
    <section>
        <h3 class="text-center">Tabulka s přehledem Oscarů podle roku</h3>

        <table class="table m-5 table-striped">
            <thead>
            <tr>
                <th scope="col">Rok</th>
                <th scope="col">Ženy</th>
                <th scope="col">Muži</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($resultListByYear as $result): ?>
                <tr>
                    <td><?= ($result['year']) ?> </td>
                    <td>
                        <?= (sprintf('%s (%s let) <br>%s',
                            htmlspecialchars($result['female_name']),
                            htmlspecialchars($result['female_age']),
                            htmlspecialchars($result['female_move'])))
                        ?>
                    </td>
                    <td>
                        <?= (sprintf('%s (%s let) <br>%s',
                            htmlspecialchars($result['name']),
                            htmlspecialchars($result['age']),
                            htmlspecialchars($result['move'])))
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <section>
        <h3 class="text-center">Tabulka s přehledem Oscarů podle roku</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Nazev Filmu</th>
                <th scope="col">Rok</th>
                <th scope="col">Herečka</th>
                <th scope="col">Herec</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($resultListByMove as $result): ?>
                <tr>
                    <td><?= htmlspecialchars($result['move']) ?> </td>
                    <td><?= htmlspecialchars($result['year']) ?> </td>
                    <td><?= htmlspecialchars($result['female_name']) ?> </td>
                    <td><?= htmlspecialchars($result['name']) ?> </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <?php
        }
    ?>
    <div class="text-center">
        <a class="btn btn-lg btn-primary mt-3" href="http://localhost/index.php">Zpět</a>
    </div>

    <footer>
        <p class="text-center m-3">Aplikace pro zobrazení výherců Oscarů</p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
