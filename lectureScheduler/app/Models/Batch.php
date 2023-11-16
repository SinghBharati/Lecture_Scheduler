<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'instructor_id', 'start_date'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

}
