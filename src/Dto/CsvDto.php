<?php

namespace src\Dto;

readonly class CsvDto
{
    public function __construct(
        private int $year,
        private string $age,
        private string $name,
        private string $move,
    )
    {
    }

    public function getYear(): string
    {
        return $this->year;
    }

    public function getAge(): string
    {
        return $this->age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMove(): string
    {
        return $this->move;
    }


}