<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Course | Online Lecture Scheduling Module</title>


    <!-- Link directly to the CSS file -->
    <link href="{{ asset('css/addcourse.css') }}" rel="stylesheet">

{{--</head>--}}
{{--<body>--}}
{{--<h1>Add Course</h1>--}}
{{--    <form method="POST" action="/add_course" enctype="multipart/form-data">--}}
{{--        @csrf--}}
{{--        @if ($errors->any())--}}
{{--            <div class="alert alert-danger">--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <div class="form-group">--}}
{{--            <label for="course_name" class="form-label">Course Name</label>--}}
{{--            <input type="text" class="form-control" id="course_name" name="course_name" >--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label for="level" class="form-label">Level</label>--}}
{{--            <select class="form-control" id="level" name="level">--}}
{{--                <option value="beginner">Beginner</option>--}}
{{--                <option value="intermediate">Intermediate</option>--}}
{{--                <option value="advance">Advance</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <p><label for="desc">Course Description</label></p>--}}
{{--            <textarea id="desc" name="desc" placeholder="Course Description" rows="4" cols="50"></textarea>--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label for="course_image" class="form-label">Course Image</label>--}}
{{--            <input type="file" class="form-control-file" id="course_image" name="course_image">--}}
{{--        </div>--}}

{{--        <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--    </form>--}}

{{--    <div>--}}
{{--        <h2>List of Courses</h2>--}}

{{--        @if(count($courses) > 0)--}}
{{--            <ul>--}}
{{--                @foreach($courses as $course)--}}
{{--                    <li><img src="storage/images/{{$course->course_image}}" alt="" height="100px" width="100px"></li>--}}
{{--                    <li>Course Name : {{ $course->course_name }}</li>--}}
{{--                    <li>Level: {{ $course->level }}</li>--}}
{{--                    <li>Description: {{ $course->desc }}</li>--}}
{{--                    <li><a href="{{url('/add_batch', $course->id)}}"><button>Add Batch</button></a></li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        @else--}}
{{--            <p>No courses available.</p>--}}
{{--        @endif--}}

{{--    </div>--}}
{{--</body>--}}


<body>

<!-- Navigation Bar -->
<nav class="navbar">
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Instructors</a></li>
        <li><a href="#">Courses</a></li>
    </ul>
</nav>

<!-- Add Course Form -->
<section class="container">
    <h1>Add Course</h1>
    <form method="POST" action="/add_course" enctype="multipart/form-data">
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

        <div class="form-group">
            <label for="course_name" class="form-label">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name"  placeholder="Course Name">
        </div>

        <div class="form-group">
            <label for="level" class="form-label">Level</label>
            <select class="form-control" id="level" name="level">
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advance">Advance</option>
            </select>
        </div>

        <div class="form-group">
            <label for="desc" class="form-label">Course Description</label>
            <textarea id="desc" name="desc" placeholder="Course Description" rows="4" cols="50"></textarea>
        </div>

        <div class="form-group">
            <label for="course_image" class="form-label">Course Image</label>
            <input type="file" class="form-control-file" id="course_image" name="course_image">
        </div>


        <button type="submit" class="primary-button">Submit</button>
</form>
</section>

<!-- List of Courses -->
<section class="container">
    <h2>List of Courses</h2>

    <div class="course-list">
        @if(count($courses) > 0)
                @foreach($courses as $course)
                <ul>
                    <li>
                        <img src="storage/images/{{$course->course_image}}" alt="" height="100px" width="100px">
                    </li>
                    <li>Course Name: {{ $course->course_name }}</li>
                    <li>Level: {{ $course->level }}</li>
                    <li>Description: {{ $course->desc }}</li>
                    <li><a href="{{url('/add_batch', $course->id)}}"><button class="primary-button">Add Batch</button></a></li>
                 </ul>
                @endforeach

        @else
            <p>No courses available.</p>
        @endif
    </div>

</section>
</body>
</html>
