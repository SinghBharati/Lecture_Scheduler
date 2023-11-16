<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $instructors = Instructor::all();
        $course = Course::find($id);
        //dd($course);
        $batches = Batch::where('course_id', $id)->get();
        return view('addbatch', ['instructors' => $instructors ,'batches' => $batches, 'course' => $course]);
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
    public function store(Request $request , $id)
    {
        $request->validate([
            'instructor' => 'required',
            'start_date' => 'required'
        ]);

//        // Check if the instructor is already assigned on the specified date
//        $existingBatch = Batch::where('instructor_id', $request->instructor)
//            ->where('start_date', $request->start_date)
//            ->where('course_id', $id)
//            ->orWhere(function ($query) use ($request, $id) {
//                $query->where('instructor_id', $request->instructor);
//            })
//            ->first();
//
//        if ($existingBatch) {
//            return back()->withErrors(['instructor' => 'This instructor is already assigned on the selected date.']);
//        }

        // Check for existing batch with the same instructor and date
        $existingBatch = Batch::where('instructor_id', $request->instructor)
            ->where('start_date', $request->start_date)
            ->first();

        // If an existing batch is found, display an error
        if ($existingBatch) {
            return back()->withErrors(['start_date' => 'Instructor is already assigned to a course on this date.']);
        }

        // Create a new batch
        $batch = Batch::create([
            'course_id' => $id,  // Use the $id parameter for the course ID
            'instructor_id' => $request->instructor,
            'start_date' => $request->start_date,
        ]);

        $batch->save();

        return back();
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
