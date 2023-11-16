<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Batch to Course | Online Lecture Scheduling Module</title>

    <!-- Link directly to the CSS file -->
    <link href="{{ asset('css/addbatch.css') }}" rel="stylesheet">

</head>
<body>
<!-- Navigation Bar -->
<nav class="navbar">
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Instructors</a></li>
        <li><a href="#">Courses</a></li>
    </ul>
</nav>


<section class="container">
    <h1>Add Batch</h1>
    <h2>Course Name : {{$course->course_name}}</h2>
    <form method="POST" action="{{url('/add_batch', $course->id)}}">

        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    {{--    @dd($course->id)--}}
        <div class="form-group">
            <label for="instructor" class="form-label">Instructor</label>
            <select class="form-control" id="instructor" name="instructor">
                @foreach ($instructors as $instructor)
                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <p><label for="start_date">Date of Batch</label></p>
            <input type="date" id="start_date" name="start_date">
        </div>

        <button type="submit" class="primary-button">Submit</button>
    </form>
</section>


<section class="container">
    <h2>List of Batches to {{$course->course_name}} Course</h2>

{{--    @dd($batches)--}}

    <div class="batch-list">
        @if(count($batches) > 0)

            @foreach($batches as $batch)
                <ul>
                    <li>Instructor: {{ $batch->instructor->name }}</li>
                    <li>Date Of Instruction: {{ $batch->start_date }}</li>
                </ul>
            @endforeach

        @else
            <p>No Batches available.</p>
        @endif
    </div>
</section>

</body>
</html>
