<?php

use src\Service\CsvService;
use src\Service\Db;
use src\Service\FileUploadService;
use src\Service\WinnersService;

mb_internal_encoding("UTF-8");
function autoload(string $class): void
{
    $path = str_replace('\\', '/', $class);
    require_once sprintf('%s%s', $path, '.php');
}

spl_autoload_register('autoload');
Db::connect('db', 'root', 'pass', 'oscars');

if ($_FILES) {
    try {
        $fileUploadService = new FileUploadService();
        $fileUploadService->validateFile();
        $fileUploadService->uploadFiles();

        $winnersDBService = new WinnersService();
        $csvService = new CsvService($winnersDBService);
        $csvService->save();
    } catch (RuntimeException $e) {
       $error = sprintf('Error occurred: %s', $e->getMessage());
    } catch (\Exception $e) {
       $error = sprintf('Unexpected error occurred: %s', $e->getMessage());
    }

    $success = 'Nahrání soublrů proběhlo v pořádku.';

}
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
</head>

<body>
<div class="container">
<header>
    <h1 class="text-center">Aplikace pro zobrazení výherců Oscarů</h1>
</header>

    <?php 
        if (isset($error)) {
            echo sprintf('<div class="alert alert-danger" role="alert">%s</div>', $error);
        } elseif (isset($success)) {
            echo sprintf('<div class="alert alert-success" role="alert">%s</div>', $success);
        }
    ?>

<section>
        <form action="form.php" method="post" enctype="multipart/form-data" id="upload-form">
            <div class="form-group" id="female-div">
                <label for="female">Zde nahrajte soubor pro výherce v kategorii žen</label>
                <input type="file" class="form-control" name="female" id="female" aria-describedby="femaleInput" accept="text/csv" required>
                <small id="femaleHelp" class="form-text text-muted">Nahrávejte prosím soubory jen ve formátu CSV</small>
            </div>
            <div class="form-group mt-2" id="male-div">
                <label for="male">Zde nahrajte soubor pro výherce v kategorii muži</label>
                <input type="file" class="form-control" name="male" id="male" accept="text/csv" required>
                <small id="maleHelp" class="form-text text-muted">Nahrávejte prosím soubory jen ve formátu CSV</small>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-primary mt-3">Nahrát soubory</button>
                <a class="btn btn-lg btn-success mt-3" href="http://localhost/list.php">Zobrazit výsledky</a>
            </div>
        </form>

</section>

<footer class="mt-5">
    <p class="text-center">Aplikace pro zobrazení výherců Oscarů</p>
</footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
