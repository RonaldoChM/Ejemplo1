<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teachers';

    protected $fillable = ['full_name','profession','grade_academy','cell_phone'];

    public function grades()
    {
        return $this->hasMany(grade::class);
    }
}
