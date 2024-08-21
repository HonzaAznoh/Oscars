<?php

mb_internal_encoding("UTF-8");

function autoload(string $class):void
{
    $path = str_replace('\\', '/', $class);
    require_once sprintf('%s%s', $path, '.php');
}

spl_autoload_register('autoload');
?>

<!DOCTYPE html>
<html lang="cs-cz">
<head>
    <base href="/localhost" />
    <meta charset="UTF-8" />
    <title>Aplikace pro zobrazení výherců Oscarů</title>
    <meta name="description" content="Aplikace pro zobrazení výherců Oscarů" />
    <meta name="keywords" content="Aplikace pro zobrazení výherců Oscarů" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<div class="container">
    <header>
        <h1 class="m-5 text-center">Aplikace pro zobrazení výherců Oscarů</h1>
    </header>

    <section>
        <div class="container">
            <div class="m-5 text-center">
                <a class="btn btn-lg btn-primary" href="http://localhost/form.php">Nahrát soubory</a>
                <a class="btn btn-lg btn-success" href="http://localhost/list.php">Zobrazit výsledky</a>
            </div>
        </div>
    </section>

    <footer>
        <p class="text-center">Aplikace pro nahrávání souborů</p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


