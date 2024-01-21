<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetDataController extends Controller
{

public function GetData(Request $request)
{
dd($request->all());
    $district = $request->input('district');

        $data = DB::table('addresss')->where('district', $district)->pluck('upazila')->toArray();
        return response()->json($data);
}


}

