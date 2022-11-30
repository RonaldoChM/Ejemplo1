<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeStudent extends Model
{
    use HasFactory;
    protected $table = 'grade_student';

    protected $fillable = ['grade_id','student_id'];
}
