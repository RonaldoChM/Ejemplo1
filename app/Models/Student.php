<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';

    protected $fillable = ['first_name','last_name','age','cell_phone','address'];

    public function grades()
    {
        return $this->belongsToMany(Grade::class);
    }

}
