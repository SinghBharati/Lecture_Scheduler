<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instructor Panel</title>

    <!-- Link directly to the CSS file -->
    <link href="{{ asset('css/instructorpanel.css') }}" rel="stylesheet">

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
    <h1>Instructor Panel</h1>
    <h2>List of Batches to {{$instructor->name}}</h2>

    {{--    @dd($batches)--}}
    <div class="batch-list">
        @if(count($batches) > 0)
            @foreach($batches as $batch)
                <ul>
                    <li>Course Name: {{ $batch->course->course_name }}</li>
                    <li>Date Of Instruction: {{ $batch->start_date }}</li>
                </ul>
            @endforeach

        @else
            <p>No courses available.</p>
        @endif
    </div>
</section>

</body>
</html>
