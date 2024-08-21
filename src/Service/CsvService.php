<?php

namespace src\Service;

use RuntimeException;
use src\Dto\CsvDto;
use src\Dto\CsvListDto;

class CsvService
{
    private const string UPLOAD_DIR = 'uploads';
    private const string CSV_SEPARATOR = ',';
    private const string TABLE_FEMALE = 'oscar_female_winners';
    private const string TABLE_MALE = 'oscar_male_winners';

    public function __construct(
        private readonly WinnersService $winnersDbService
    )
    {
    }
    private function readSources(): CsvListDto
    {
        $csvList = [];

        $dir = dir(self::UPLOAD_DIR);
        while (false !== ($entry = $dir->read())) {
            if (preg_match('/\.csv$/', $entry)) {
                $csvList[] = $entry;
            }
        }
        $dir->close();

        return new CsvListDto($csvList);
    }

    public function save(): void
    {
        $csvListDto = $this->readSources();
        $fileToProcess = count($csvListDto->getList());
        $iteration = 0;
        foreach ($csvListDto->getList() as $csvFile) {
            if (($handle = fopen(sprintf('%s/%s', self::UPLOAD_DIR, $csvFile), 'r')) !== FALSE) {

                $targetTable = 'oscar_age_female.csv' === $csvFile ? self::TABLE_FEMALE : self::TABLE_MALE;
                $csvSize = filesize(sprintf('%s/%s', self::UPLOAD_DIR, $csvFile));
                $row = 1;

                while (($data = fgetcsv($handle, $csvSize, self::CSV_SEPARATOR)) !== FALSE) {
                    if (1 === $row) {
                        $row++;
                        continue;
                    }

                    if (null !== $data[0]) {
                        $csvDto = new CsvDto((int)$data[1], $data[2], $data[3], $data[4]);
                        $this->winnersDbService->saveRecord($csvDto->getYear(), $csvDto->getAge(), $csvDto->getName(), $csvDto->getMove(), $targetTable);
                    }

                    $row++;
                }
                fclose($handle);
            }
        $iteration++;
        }
        if ($iteration !== $fileToProcess) {
            throw new RuntimeException('Došlo k chybě při zpracování CSV souborů.');
        }
    }
}