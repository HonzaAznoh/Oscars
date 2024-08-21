<?php

namespace src\Service;

class WinnersService
{
    public function saveRecord($year, $age, $name, $move, $table): void
    {
        Db::setQuery(sprintf('
            INSERT INTO %s (year, age, name, move)
            VALUES (?, ?, ?, ?)',
            $table),
            [$year, $age, $name, $move]
        );
    }


    public function getRecordsByYear(): array
    {
        return Db::getQueries('
            SELECT 
                male.year,
                male.age,
                male.name,
                male.move,
                female.year as female_year,
                female.age as female_age,
                female.name as female_name,
                female.move as female_move
            FROM oscar_male_winners as male 
            JOIN oscar_female_winners as female 
            ON male.year = female.year
            ORDER BY male.year DESC
            ');
    }

    public function getRecordsByMove(): array
    {
        return Db::getQueries('
            SELECT 
                male.year,
                male.age,
                male.name,
                male.move,
                female.year as female_year,
                female.age as female_age,
                female.name as female_name,
                female.move as female_move
            FROM oscar_male_winners as male 
            JOIN oscar_female_winners as female 
            ON male.move = female.move 
            ORDER BY male.move  
            ');
    }
}