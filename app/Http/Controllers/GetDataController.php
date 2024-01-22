<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetDataController extends Controller
{

    public function GetData(Request $request)
    {
        $district = $request->input('district');

    //  dd($district );
        $data = DB::table('addresss')->where('district', $district)->distinct()->pluck('upazila')->toArray();


        // dd($data);

        return response()->json($data);
    }



}

