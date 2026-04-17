<?php

namespace App\Http\Controllers;

use App\Models\Enrollee;
use App\Http\Requests\StoreEnrolleeRequest;
use Illuminate\Http\Request;

class EnrolleeController extends Controller
{
    public function index()
    {
        $laravel_enrollees = Enrollee::orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('laravel_enrollees'));
    }

    public function store(StoreEnrolleeRequest $request)
    {
        Enrollee::create($request->only([ 
            'student_id',
            'name',
            'course',
            'year',
            'block'
        ]));
        
        return redirect()->route('dashboard')->with( 
            'success', 
            'Enrollee added!'
            );
    }

}