# Oscars

Vítejte v aplikaci pro zobrazení výherců Oscarů v ženské a mužské kategorii.
Aplikace zobrazuje dvě tabulky s výsledky soutěže. V první tabulce jsou výsledky seřazeny podle roku, tabulka obsahuje tři sloupce, Rok, Ženy, Muži.
Ve sloupcích ženy a muži je uvedeno jméno herce, věk a název filmu.

Druhá tabulka zobrazuje filmy které obdržely cenu za mužskou i ženskou roli.
Tabulka obsahuje čtyři sloupce, Název filmu, Rok Herečka a Herec, filmy jsou seřazeny abecedně.

## Instalace

Je nutné mít nainstalovaný **Docker** a **Docker Compose** pro fungování aplikace.
Pokud máte Docker a Docker Compose nainstalovaný spusťte následující příkaz:

````shell
docker compose up -d --build
````

## Jak pracovat s aplikací

Do prohlížeče zadejte URL adresu **localhost**, zobrazí se vám hlavní stránka s možností nahrát soubory, nebo zobrazit výsledky.
Nejdprve vyberte možnost nahrát soubory. Nahrajte CSV soubr pro obě kategorie a stiskněte tlačítko **Nahrát soubory**.

>
> Pozor soubory musí mít mít konkrétí název:
> 
> Soubor výherců v ženské kategorii musí mít název **oscar_age_female.csv**
> 
> Soubor výherců v mužské kategorii musí mít název **oscar_age_male.csv**
> 

>
>   Nahrávejte pouze soubory ve formátu CSV.
> 
 

Poté klikněte na tlačítko **Zobrazit výsledky** se zobrazí tabulky se seznamem výherců.