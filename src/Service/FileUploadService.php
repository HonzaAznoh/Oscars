<?php

namespace src\Service;

use RuntimeException;

class FileUploadService
{
    public function validateFile(): bool
    {
        if (!isset($_FILES['female'])) {
            throw new RuntimeException('File for female uploads missing!');
        }

        if (!isset($_FILES['male'])) {
            throw new RuntimeException('File for male uploads missing!');
        }

        if ($_FILES['female']['size'] > 1000000) {
            throw new RuntimeException('File for female uploads is too large!');
        }

        if ($_FILES['male']['size'] > 1000000) {
            throw new RuntimeException('File for female uploads is too large!');
        }

        if (
            !isset($_FILES['female']['error']) ||
            is_array($_FILES['female']['error'])
        ) {
            throw new RuntimeException('Invalid parameters.');
        }

        if (
            !isset($_FILES['male']['error']) ||
            is_array($_FILES['male']['error'])
        ) {
            throw new RuntimeException('Invalid parameters.');
        }

        if ($_FILES['female']['name'] !== 'oscar_age_female.csv') {
            throw new RuntimeException('Wrong file name for uploads female winners records. Use only name oscar_age_female.csv for CSV file.');
        }

        if ($_FILES['male']['name'] !== 'oscar_age_male.csv') {
            throw new RuntimeException('Wrong file name for uploads male winners records. Use only name oscar_age_male.csv for CSV file.');
        }

        $csvMimes = [
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain'
        ];

        $fileInfo = new \finfo(FILEINFO_MIME_TYPE);

        $femaleExtension = $fileInfo->file($_FILES['female']['tmp_name']);
        $femaleExtensionExists = in_array($femaleExtension, $csvMimes);

        if (false === $femaleExtensionExists) {
            throw new RuntimeException('Invalid file format.');
        }

        $maleExtension = $fileInfo->file($_FILES['male']['tmp_name']);
        $maleExtensionExists = in_array($maleExtension, $csvMimes);

        if (false === $maleExtensionExists) {
            throw new RuntimeException('Invalid file format.');
        }

        return true;
    }

    public function uploadFiles(): bool
    {
        $targetDir = "uploads/";
        $femaleTargetFile = $targetDir . basename($_FILES["female"]["name"]);
        $maleTargetFile = $targetDir . basename($_FILES["male"]["name"]);
        $femaleTempFile = $_FILES["female"]["tmp_name"];
        $maleTempFile =  $_FILES["male"]["tmp_name"];

        if (file_exists($femaleTargetFile)) {
            throw new RuntimeException(sprintf('File %s already exists.', $femaleTargetFile));
        }

        if (file_exists($maleTargetFile)) {
            throw new RuntimeException(sprintf('File %s already exists.', $maleTargetFile));
        }

        if (!move_uploaded_file($femaleTempFile, $femaleTargetFile)) {
            throw new RuntimeException(sprintf('Error during save file %s .', $maleTargetFile));
        }

        if (!move_uploaded_file($maleTempFile, $maleTargetFile)) {
            throw new RuntimeException(sprintf('Error during save file %s .', $femaleTargetFile));
        }

       return true;
    }
}