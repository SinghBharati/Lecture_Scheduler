<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $courses = Course::all();
       return view('addcourse' , ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // Validation rules
        $request->validate([
            'course_name' => 'required|string|max:255',
            'level' => 'required|in:beginner,intermediate,advance',
            'desc' => 'required|string|max:255',
            'course_image' => 'required|image|mimes:jpg,jpeg,png',
        ]);

//        dd($request->all());

        if ($request->hasFile('course_image')) {
            $courseImage = $request->file('course_image');
            $extension = $courseImage->getClientOriginalExtension();
            $courseImageName = time(). "." . $extension;
            $courseImage->move('storage/images', $courseImageName);
        }
//        else{
//            dd($request->all());
//        }

        $course = Course::create([
            'course_name' => $request->course_name,
            'level' => $request->level,
            'desc' => $request->desc,
            'course_image' => $courseImageName,
        ]);

        $course->save();

        return redirect(route('addcourse'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
