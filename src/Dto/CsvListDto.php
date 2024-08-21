<?php

namespace src\Dto;

readonly class CsvListDto
{
    public function __construct(
        private array $list
    )
    {
    }

    public function getList(): array
    {
        return $this->list;
    }


}