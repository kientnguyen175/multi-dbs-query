<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class SqlController extends Controller
{
    public function execute(Request $request)
    {
        $response = [
            'status' => 'successfully',
        ];
        $connections = [];
        $failedConnection = null;
        $sql = trim($request->sql);
        $selectSql = stripos($sql, 'select');
        foreach ($request->rdbmss as $rdbms) {
            try {
                DB::connection($rdbms)->beginTransaction();
                if ($selectSql === 0) {
                    $result = DB::connection($rdbms)->select($sql);
                    $response['data'][config("rdbmss.$rdbms")] = $result;
                } else {
                    DB::connection($rdbms)->statement($sql);
                }
                DB::connection($rdbms)->commit();
                array_push($connections, $rdbms);
            } catch (Exception $e) {
                $response = [
                    'status' => 'failed',
                    'error_in_database' => config("rdbmss.$rdbms"),
                    'error_message' => $e->getMessage()
                ];
                $failedConnection = $rdbms;
                array_push($connections, $rdbms);
                break;
            }
        }
        if ($failedConnection) {
            foreach ($connections as $connection) {
                DB::connection($connection)->rollback();
            }
        }
        
        return response()->json($response);
    }
}
