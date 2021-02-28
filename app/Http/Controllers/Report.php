<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class Report extends Controller
{
    public function save_report_controller(Request $request)
    {
        $data = $request->all();
        // $data['id'];
        $mytime = Carbon::now();
        $time = $mytime->toDateString();
        DB::table('Rajavithi_tr_report')->insert([
            'date' => $time,
            'data_1' => $data['ans_1'],
            'data_2' => $data['ans_2'],
            'data_3' => $data['ans_3'],
        ]);
        return true;
    }

    public function get_report_controller()
    {
        $users = DB::table('Rajavithi_tr_report')
            ->select('*')
            ->get();

        return json_encode($users);
    }
}
