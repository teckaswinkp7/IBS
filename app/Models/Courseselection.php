<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courseselection extends Model
{
    use HasFactory;
    protected $table = 'courseselections';
    protected $fillable = [
        'stu_id', 'course_id', 'studentSelCid','offer_generated','defer_course','defer_date'
    ];
}
