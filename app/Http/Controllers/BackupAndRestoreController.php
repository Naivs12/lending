<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackupAndRestoreController extends Controller
{
    public function index()
    {
        $tables = DB::select('SHOW TABLES');
        $tableNames = array_map('current', $tables);

        $excludedTables = [
            'migrations'
        ];

        $tableNames = array_filter($tableNames, function ($table) use ($excludedTables) {
            return !in_array($table, $excludedTables);
        });

        $tableArr = [];

        foreach($tableNames as $table) {

            $tableArr[] = [
                'table' => $table
            ];
        }

        return view('system-admin.maintenance.backupandrestore', compact('tableArr'));
    }

    public function backUp($table)
    {
        $tableData = DB::table($table)->get();

        $sqlFile = '';
        foreach ($tableData as $row) {
            $columns = implode('`, `', array_keys((array)$row));
            $values = implode("', '", array_values((array)$row));
            $sqlFile .= "INSERT INTO `$table` (`$columns`) VALUES ('$values');\n";
        }

        $fileName = "$table.sql";
        Storage::disk('local')->put("exports/$fileName", $sqlFile);

        return Storage::disk('local')->download("exports/$fileName");
    }

    public function restore(Request $request)
    {
        $file = $request->file('file');
        $table = $request->table;

        $sql = file_get_contents($file->getRealPath());

        $queries = array_filter(array_map('trim', explode(';', $sql)));

        $existing = DB::table($table)->get();

        if(count($existing) > 0) {
            DB::table($table)->delete();
        }

        foreach ($queries as $query) {
            if (!empty($query)) {
                try {
                    DB::statement($query);
                } catch (\Exception $e) {
                    return response()->json(['error' => 'Failed to execute query: ' . $e->getMessage()], 500);
                }
            }
        }

        return $queries;
    }
}
