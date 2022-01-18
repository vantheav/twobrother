<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'java',
        'javascript',
        'python',
        'htmlcss',
        'pl',
        'english',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
