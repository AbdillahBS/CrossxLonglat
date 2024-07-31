<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DynamicImport implements ToCollection, WithHeadingRow
{
    protected $sheet;
    protected $table;
    protected $cleanedHeaders;

    public function __construct($sheet, $table, $cleanedHeaders)
    {
        $this->sheet = $sheet;
        $this->table = $table;
        $this->cleanedHeaders = $cleanedHeaders;
    }

    public function collection(Collection $rows)
    {
        Log::info('Cleaned Headers: ' . json_encode($this->cleanedHeaders));

        // Get and log original headers from the first row
        $originalHeaders = $rows->first()->keys()->toArray();
        Log::info('Original Headers: ' . json_encode($originalHeaders));

        foreach ($rows as $row) {
            // Skip row if any column has null or empty value
            if ($this->hasNullOrEmptyValue($row)) {
                Log::info('Skipping row with null or empty values: ' . json_encode($row));
                continue;
            }

            $data = [];
            Log::info('Processing row: ' . json_encode($row));

            $isValidRow = true;
            foreach ($this->cleanedHeaders as $originalHeader => $cleanedHeader) {
                $found = false;
                foreach ($row as $key => $value) {
                    // Normalize the original header to match cleaned headers
                    $normalizedKey = strtoupper(preg_replace('/[^a-zA-Z0-9_]/', '_', $key));
                    if ($normalizedKey === strtoupper($cleanedHeader)) {
                        $cleanedValue = $this->cleanValue($value);

                        // Convert Excel serial number to date if the header indicates a date column
                        if (str_contains(strtolower($cleanedHeader), 'tanggal')) {
                            $cleanedValue = $this->excelSerialNumberToDate($cleanedValue);
                        }

                        if ($cleanedValue !== null && $cleanedValue !== '') {
                            $data[$cleanedHeader] = $cleanedValue;
                        }
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    Log::warning("Column not found: $originalHeader");
                    $isValidRow = false;
                }
            }

            // Skip the row if it is not valid
            if (!$isValidRow) {
                Log::info('Skipping invalid row: ' . json_encode($row));
                continue;
            }

            Log::info('Inserting data: ' . json_encode($data));
            if (!empty($data)) {
                try {
                    DB::table($this->table)->insert($data);
                } catch (\Exception $e) {
                    Log::error('Error inserting data: ' . $e->getMessage());
                }
            }
        }
    }

    public function sheets(): array
    {
        return [
            $this->sheet => $this,
        ];
    }

    private function cleanValue($value)
    {
        if (is_string($value)) {
            $value = trim($value);
            $value = $value !== '' ? str_replace(',', '', $value) : null;
        }
        return $value === '' ? null : $value;
    }

    private function hasNullOrEmptyValue($row)
    {
        foreach ($row as $value) {
            if (is_null($value) || trim($value) === '') {
                return true;
            }
        }
        return false;
    }

    private function excelSerialNumberToDate($serialNumber)
    {
        if (is_numeric($serialNumber)) {
            $unixDate = ($serialNumber - 25569) * 86400;
            return gmdate("Y-m-d", $unixDate);
        }
        return $serialNumber;
    }
}
