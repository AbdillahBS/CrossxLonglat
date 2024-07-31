<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DynamicImport;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;

class ExcelController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $path = $request->file('file')->store('temp');
        $file = storage_path('app/' . $path);
        $spreadsheet = IOFactory::load($file);
        $sheets = $spreadsheet->getSheetNames();

        $tables = DB::getDoctrineSchemaManager()->listTableNames();

        return response()->json(['sheets' => $sheets, 'file' => $path, 'tables' => $tables]);
    }

    public function getColumns(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|string',
                'sheet' => 'required|string',
            ]);

            $file = storage_path('app/' . $request->input('file'));
            Log::info('File path: ' . $file);

            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getSheetByName($request->input('sheet'));
            Log::info('Sheet name: ' . $request->input('sheet'));

            $headers = $sheet->rangeToArray('A1:' . $sheet->getHighestColumn() . '1', null, true, true, true)[1];
            Log::info('Headers: ' . json_encode($headers));

            $cleanedHeaders = [];
            foreach ($headers as $header) {
                if (!empty($header)) {
                    $cleanedHeaders[] = $header;
                }
            }

            Log::info('Cleaned Headers: ' . json_encode($cleanedHeaders));

            return response()->json(['columns' => $cleanedHeaders]);
        } catch (\Exception $e) {
            Log::error('Error in getColumns: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while processing the columns.'], 500);
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|string',
            'sheet' => 'required|string',
            'columns' => 'required|array',
            'table_action' => 'required|string',
        ]);

        $file = storage_path('app/' . $request->input('file'));
        $sheetName = $request->input('sheet');
        $selectedColumns = $request->input('columns');
        $tableAction = $request->input('table_action');
        $table = null;

        // Load spreadsheet and select sheet
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getSheetByName($sheetName);

        // Clean headers
        $cleanedHeaders = [];
        foreach ($selectedColumns as $header) {
            $cleanedHeader = preg_replace('/[^a-zA-Z0-9_]/', '_', $header);
            $cleanedHeaders[$header] = $cleanedHeader;
        }

        Log::info('Selected Columns: ' . json_encode($selectedColumns));
        Log::info('Cleaned Headers: ' . json_encode($cleanedHeaders));

        if ($tableAction == 'create_new') {
            $request->validate(['new_table_name' => 'required|string']);
            $table = $request->input('new_table_name');
            if (Schema::hasTable($table)) {
                return back()->with('error', 'Table name already exists');
            }
            Schema::create($table, function (Blueprint $table) use ($cleanedHeaders) {
                foreach ($cleanedHeaders as $cleanedHeader) {
                    $table->string($cleanedHeader)->nullable();
                }
            });
        } elseif ($tableAction == 'replace_existing') {
            $request->validate(['existing_table' => 'required|string']);
            $table = $request->input('existing_table');
            Schema::dropIfExists($table);
            Schema::create($table, function (Blueprint $table) use ($cleanedHeaders) {
                foreach ($cleanedHeaders as $cleanedHeader) {
                    $table->string($cleanedHeader)->nullable();
                }
            });
        }

        Log::info('Sheet Name: ' . $sheetName);
        Log::info('Table: ' . $table);

        Excel::import(new DynamicImport($sheetName, $table, $cleanedHeaders), $file);

        return back()->with('success', 'Data Imported Successfully');
    }
}
