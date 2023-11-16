<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> Home | Online Lecture Scheduling Module </title>

        <!-- Link directly to the CSS file -->
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    </head>

    <body>
    <nav class="nav-links">
        <ul class=" flex">
            <li class="hover-link">Home</li>
            <li class="hover-link">Instructors</li>
            <li class="hover-link">Courses</li>
        </ul>
    </nav>


    <section class="container">
        <h1>Admin Panel</h1>
        <a href="{{url('/add_course')}}" class="hover-link"><button class="primary-button">Add Course</button></a>
    </section>

    <section class="container">
        <h2>List of all Instructors</h2>
        @if(count($instructors) > 0)
            <div class="card">
                @foreach($instructors as $instructor)
                    <div>
                        <p> {{ $instructor->name }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p>No Instructors available.</p>
        @endif
    </section>
    </body>
</html>
