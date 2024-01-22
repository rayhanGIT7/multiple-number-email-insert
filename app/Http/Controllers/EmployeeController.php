<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
{

    public function create()
    {
        $data = DB::table('employees')->get();
        $district=DB::table('addresss')->get();
       //  dd($data);
        return view('index', compact('data', 'district'));



    }
    public function store(Request $request)
    {


        // $request->validate([
        //     'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z ]*$/'],
        //     'emails' => ['required', 'email', 'max:255', 'unique:employees,emails', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
        //     'numbers' => ['required', 'regex:/^[0-9]{11}$/', 'unique:employees,numbers'],
        //     'department' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z ]*$/'],
        //     'district' => ['string', 'max:255', 'regex:/^[a-zA-Z ]*$/'],
        //     'upazila' => ['string', 'max:255', 'regex:/^[a-zA-Z ]*$/'],
        //     'date' => ['required', 'date', 'max:255'],
        //     'gender' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z ]*$/'],
        //     'image' => ['required', 'image', 'mimes:jpeg,png,jpg'],
        // ]);


        $image = $request->file('image');
        $encodedImage = base64_encode(file_get_contents($image->getPathname()));

        // $image = $request->file('image');
        // $imageName = time() . '.' . $image->getClientOriginalExtension();
        // $image->move(public_path('images'), $imageName);

        $inserted = DB::table('employees')->insert([
            'name' => $request->name,
            'emails' => json_encode($request->emails), // Convert array to JSON
            'numbers' => json_encode($request->numbers), // Convert array to JSON
            'department' => $request->department,
            'district' => $request->district,
            'upazila' => $request->upazila,
            'date' => $request->date,
            'gender' => $request->gender,
            'image' => $encodedImage
        ]);


        if ($inserted) {
            return redirect()->route('index')->with('success', 'Employee created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create employee');
        }
    }

}
